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

class FeeImport implements ToCollection,WithStartRow , WithChunkReading, ShouldQueue
{
    private $rows = 0;
    public function collection(Collection $rows)
    {

        foreach ($rows as  $key => $row) {
            try {
                DB::beginTransaction();
                $trans_date = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]))->toDateString();
                $academic_year = $row[2];
                $financial_year = $row[3];
                $entry_mode = $row[5];
                $voucher_no = $row[6];
                $roll_no = $row[7];
                $admission_no = $row[8];
                $fee_c = $row[10];
                $faculty_c = $row[11];
                $receipt_no = $row[15];
                $fee_head = $row[16];
                $due_amount = $row[17];
                $paid_amount = $row[18];
                $concession_amount = $row[19];
                $scholarship_amount = $row[20];
                $reverse_concession_amount = $row[21];
                $write_off_amount = $row[22];
                $adjusted_amount = $row[23];
                $refund_amount = $row[24];
                $fund_trancfer_amount = $row[25];
                $amount = 0;
                $common = true;
                if($due_amount > 0) {
                    $common = false;
                }
                if($paid_amount > 0 ){
                    $amount = $paid_amount;
                }
                if($concession_amount > 0 ){
                    $amount = $concession_amount;
                    $common = false;
                }
                if($scholarship_amount > 0 ){
                    $amount = $scholarship_amount;
                    $common = false;
                }
                if($reverse_concession_amount > 0 ){
                    $amount = $reverse_concession_amount;
                    $common = false;
                }
                if($write_off_amount > 0 ){
                    $amount = $write_off_amount;
                    $common = false;
                    
                }
                if($adjusted_amount > 0 ){
                    $amount = $adjusted_amount;
                }
                if($refund_amount > 0 ){
                    $amount = $refund_amount;
                }
                if($fund_trancfer_amount > 0 ){
                    $amount = $fund_trancfer_amount;
                }
                $fee_c = $this->format_string($fee_c);
                $module_name = "Academic";
                if (strpos(strtolower($fee_c), 'fine') !== false) {
                    $module_name = "Academic Misc";
                } else if (strpos(strtolower($fee_c), 'mess') !== false) {
                    $module_name = "Hostel";
                }
                $faculty_c = $this->format_string($faculty_c);
                $fee_head = $this->format_string($fee_head);
                $entry_mode = $this->format_string($entry_mode);
                #$fc_trans = ['rcpt','revrcpt','jv','revjv','pmt','revpmt','fundtransfer'];
                $inactive_fc = ['revrcpt','revjv','revpmt'];
                $active_fc = ['rcpt','jv','pmt'];
                $inactive = null;
                $fee_db = FeeCategory::whereRaw('LOWER(`name`) = ? ',strtolower($fee_c))->first();
                $faculty_db = Branch::whereRaw('LOWER(`name`) = ? ',strtolower($faculty_c))->first();
                $entry_mode_db = EntryMode::whereRaw('LOWER(`entry_mode_name`) = ? ',strtolower($entry_mode))->first();
                $entry_mode = $fee_head;
                $fee_category_id = null;
                $branch_id = null;
                $fee_type_id = null;
                $module_id = null;
                $entry_mode_db_id = null;
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
                            $fee_type_id = $fee_type_db->id;
                            $head_name   = $fee_type_db->name;
                            $module_id = $fee_type_db->fee_head_type_id;
                        }
                    }
                }
                if($this->in_arrayi($entry_mode ,$inactive_fc)){
                    $inactive = 1;
                }
                if($this->in_arrayi($entry_mode ,$active_fc)){
                    $inactive = 0;
                }
                $insert = false;
                if($common) {
                    if ($com = CommonFeeCollection::where('admin_no', '=', $admission_no)->where('academic_year',$academic_year)->first()) {
                        $ftran = $com->tran_id;
                        $receipt_id = $com->id;
                        $insert = true;
                    } else {
                        $ftran = $this->get_transaction_id();
                        $receipt_id = CommonFeeCollection::create([
                            "tran_id" => $ftran,
                            "module_id" => $module_id,
                            "amount" => $amount,
                            "roll_no" => $roll_no,
                            "admin_no" =>  $admission_no,
                            "financial_year" => $financial_year,
                            "academic_year" => $academic_year,
                            "entry_mode" => $entry_mode_db_id,
                            "branch_id" => $branch_id,
                            "receipt_no" => $receipt_no,
                            "paid_date" => $trans_date,
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
                    if ($fct = FinancialTransaction::where('admin_no', '=', $admission_no)->where('academic_year',$academic_year)->first()) {
                        $ftran = $fct->tran_id;
                        $f_t_id = $fct->id;
                        $insert = true;
                    } else {
                        $ftran = $this->get_transaction_id();
                        $f_t_id = FinancialTransaction::create([
                            "tran_id" => $ftran,
                            "amount" => $amount,
                            "admin_no" =>  $admission_no,
                            "trans_date" =>  $trans_date,
                            "financial_year" => $financial_year,
                            "academic_year" => $academic_year,
                            "entry_mode" => $entry_mode_db_id,
                            "voucher_no" => $voucher_no,
                            "branch_id" => $branch_id
                        ])->id;
                    }


                    FinancialTransactionDetail::create([
                        "financial_transaction_id" => $ftran,
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
