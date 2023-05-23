<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Carbon\Carbon;
use App\Models\FeeCategory;
use App\Models\Branch;
use App\Models\FeeCollectionType;
use App\Models\FeeType;
use App\Models\FinancialTransaction;
use App\Models\FinancialTransactionDetail;
use App\Models\EntryMode;
use App\Models\CommonFeeCollection;
use App\Models\CommonFeeCollectionHeadwise;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class FeeImport implements ToCollection,WithStartRow,WithChunkReading,ShouldQueue
{
    private $rows = 0;
    private $row_data = [];
    public function collection(Collection $rows)
    {

        foreach ($rows as  $key => $row) {
            try {
                DB::beginTransaction();

                $this->update_row_data($row);
                
                list($common,$amount) = $this->transaction_type();
                $module_name = $this->get_module_name();
                #$fc_trans = ['rcpt','revrcpt','jv','revjv','pmt','revpmt','fundtransfer'];

                $inactive_fc = ['revrcpt','revjv','revpmt'];
                $active_fc = ['rcpt','jv','pmt'];
                
                $fee_db = FeeCategory::whereRaw('LOWER(`name`) = ? ',strtolower($this->row_data['fee_c']))->first();
                $faculty_db = Branch::whereRaw('LOWER(`name`) = ? ',strtolower($this->row_data['faculty_c']))->first();
                $entry_mode_db = EntryMode::whereRaw('LOWER(`entry_mode_name`) = ? ',strtolower($this->row_data['entry_mode']))->first();

                
                $inactive = $fee_category_id = $branch_id =  $fee_type_id = $module_id = $entry_mode_db_id= null;
                $head_name = "";


                if($faculty_db){
                    $branch_id = $faculty_db['id'];
                }
                if($entry_mode_db) {
                    $entry_mode_db_id = $entry_mode_db['id'];
                }
                
                if($fee_db){
                    $fee_category_id = $fee_db['id'];
                    $fee_head_db = FeeCollectionType::whereRaw('LOWER(`name`) = ? ',strtolower($module_name))->whereRaw(' `branch_id` = ?',$branch_id)->first();
                    if($fee_head_db){
                        $fee_c_id = $fee_head_db['id'];
                        $fee_type_db = FeeType::where("branch_id",$branch_id)->where("fee_category_id",$fee_category_id)->where("fee_collection_type_id",$fee_c_id)->first();
                        if($fee_type_db){
                            $fee_type_id = $fee_type_db['id'];
                            $head_name   = $fee_type_db['name'];
                            $module_id = $fee_type_db['fee_head_type_id'];
                        }
                    }
                }
                if($this->in_arrayi($this->row_data['entry_mode'] ,$inactive_fc)){
                    $inactive = 1;
                }
                if($this->in_arrayi($this->row_data['entry_mode'] ,$active_fc)){
                    $inactive = 0;
                }
                $insert = false;
                if($common) {
                    if ($com = CommonFeeCollection::where('admin_no', '=', $this->row_data['admission_no'])->where('academic_year',$this->row_data['academic_year'])->first()) {
                        $ftran = $com['tran_id'];
                        $receipt_id = $com['id'];
                        $insert = true;
                    } else {
                        $ftran = $this->get_transaction_id();
                        $receipt_id = CommonFeeCollection::create([
                            "tran_id" => $ftran,
                            "module_id" => $module_id,
                            "amount" => $amount,
                            "roll_no" => $this->row_data['roll_no'],
                            "admin_no" =>  $this->row_data['admission_no'],
                            "financial_year" => $this->row_data['financial_year'],
                            "academic_year" => $this->row_data['academic_year'],
                            "entry_mode" => $entry_mode_db_id,
                            "branch_id" => $branch_id,
                            "receipt_no" => $this->row_data['receipt_no'],
                            "paid_date" => $this->row_data['trans_date'],
                            "inactive" => $inactive
                        ])->id;
                    }

                    CommonFeeCollectionHeadwise::create([
                        "receipt_id" => $receipt_id,
                        "amount" => $amount,
                        "module_id" =>  $module_id,
                        "head_id" =>  $fee_type_id,
                        "head_name" => $head_name,
                        "branch_id" => $branch_id
                    ]);
                    if($insert){
                        $result = DB::table('common_fee_collection_headwises')->selectRaw('sum(amount) as total')->where('receipt_id',$receipt_id)->get()->toArray();
                        $result = json_decode(json_encode($result), true);
                        $total_amount = $result[0]['total'];
                        CommonFeeCollectionHeadwise::where('receipt_id', $receipt_id)
                            ->update([
                                'amount' => $total_amount
                                ]);
                    }
                } else {
                    
                    if ($fct = FinancialTransaction::where('admin_no', '=', $this->row_data['admission_no'])->where('academic_year',$this->row_data['academic_year'])->first()) {
                        $ftran = $fct['tran_id'];
                        $f_t_id = $fct['id'];
                        $insert = true;
                    } else {
                        $ftran = $this->get_transaction_id();
                        $f_t_id = FinancialTransaction::create([
                            "tran_id" => $ftran,
                            "amount" => $amount,
                            "admin_no" =>  $this->row_data['admission_no'],
                            "trans_date" =>  $this->row_data['trans_date'],
                            "financial_year" => $this->row_data['financial_year'],
                            "academic_year" => $this->row_data['academic_year'],
                            "entry_mode" => $entry_mode_db_id,
                            "voucher_no" => $this->row_data['voucher_no'],
                            "branch_id" => $branch_id,
                            "module_id" => $module_id
                        ])->id;
                    }


                    FinancialTransactionDetail::create([
                        "financial_transaction_id" => $f_t_id,
                        "amount" => $amount,
                        "module_id" =>  $module_id,
                        "head_id" =>  $fee_type_id,
                        "head_name" => $head_name,
                        "branch_id" => $branch_id,
                    ]);
                    if($insert){
                        $result = DB::table('financial_transaction_details')->selectRaw('sum(amount) as total')->where('financial_transaction_id',$f_t_id)->get()->toArray();
                        $result = json_decode(json_encode($result), true);
                        $total_amount = $result[0]['total'];
                        FinancialTransaction::where('financial_transaction_id', $f_t_id)
                            ->update([
                                'amount' => $total_amount
                                ]);
                    }
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }
            
        }
    }

    function get_module_name(){
        $module_name = "Academic";
        if (strpos(strtolower($this->row_data['fee_c']), 'fine') !== false) {
            $module_name = "Academic Misc";
        } else if (strpos(strtolower($this->row_data['fee_c']), 'mess') !== false) {
            $module_name = "Hostel";
        }
        return $module_name;
    }
    function transaction_type(){
        $amount = 0;
        $common = true;
        if($this->row_data['due_amount'] != 0 || $this->row_data['concession_amount'] != 0  || $this->row_data['scholarship_amount'] != 0 || $this->row_data['write_off_amount'] != 0 || $this->row_data['reverse_concession_amount'] != 0) {
            $common = false;
        }
        if($this->row_data['paid_amount'] != 0  ){
            $amount = (int) $this->row_data['paid_amount'];
        }
        if($this->row_data['concession_amount'] != 0){
            $amount = (int) $this->row_data['concession_amount'];
        }

        if($this->row_data['scholarship_amount'] != 0 ){
            $amount = (int) $this->row_data['scholarship_amount'];
        }

        if($this->row_data['reverse_concession_amount'] != 0 ){
            $amount = (int) $this->row_data['reverse_concession_amount'];
        }

        if($this->row_data['write_off_amount'] != 0 ){
            $amount = (int) $this->row_data['write_off_amount']; 
        }

        if($this->row_data['adjusted_amount'] != 0 ){
            $amount = (int) $this->row_data['adjusted_amount'];
        }

        if($this->row_data['refund_amount'] != 0 ){
            $amount = (int) $this->row_data['refund_amount'];
        }

        if($this->row_data['fund_transfer_amount'] != 0 ){
            $amount = (int) $this->row_data['fund_transfer_amount'];
        }

        return [$common,$amount];
    }
    function update_row_data($row) {
        $this->row_data = [];
        $this->row_data['trans_date'] = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]))->toDateString();
        $this->row_data['academic_year'] = $row[2];
        $this->row_data['financial_year'] = $row[3];
        $this->row_data['entry_mode'] = $row[5];
        $this->row_data['voucher_no'] = $row[6];
        $this->row_data['roll_no'] = $row[7];
        $this->row_data['admission_no'] = $row[8];
        $this->row_data['fee_c'] = $row[10];
        $this->row_data['faculty_c'] = $row[11];
        $this->row_data['receipt_no'] = $row[15];
        $this->row_data['fee_head'] = $row[16];
        $this->row_data['due_amount'] = $row[17];
        $this->row_data['paid_amount'] = $row[18];
        $this->row_data['concession_amount'] = $row[19];
        $this->row_data['scholarship_amount'] = $row[20];
        $this->row_data['reverse_concession_amount'] = $row[21];
        $this->row_data['write_off_amount'] = $row[22];
        $this->row_data['adjusted_amount'] = $row[23];
        $this->row_data['refund_amount'] = $row[24];
        $this->row_data['fund_transfer_amount'] = $row[25];
        
        $this->row_data['faculty_c'] = $this->format_string($this->row_data['faculty_c']);
        $this->row_data['fee_head'] = $this->format_string($this->row_data['fee_head']);
        $this->row_data['entry_mode'] = $this->format_string($this->row_data['entry_mode']);
        $this->row_data['fee_c'] = $this->format_string($this->row_data['fee_c']);
    }

    function batchSize(): int
    {
        return 500;
    }

    function chunkSize(): int
    {
        return 1000;
    }

    function format_string($str) {
        return preg_replace("/_+/"," ", $str);
        
    }

    function get_transaction_id(){

        return sprintf("%06d", mt_rand(1, 999999));
    }
    
    function in_arrayi($needle, $haystack) {
        return in_array(strtolower($needle), array_map('strtolower', $haystack));
    }

    function startRow(): int
    {
        return 7;
    }
}
