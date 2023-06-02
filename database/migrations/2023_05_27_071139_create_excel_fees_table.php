<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('excel_fees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Date');
            $table->string('Academic_year');
            $table->string('Session');
            $table->string('Alloted_Category');
            $table->string('Voucher_Type');
            $table->string('Voucher_No');
            $table->string('Roll_No');
            $table->string('Admission_No');
            $table->string('Status');
            $table->string('Fee_Category');
            $table->string('Faculty');
            $table->string('Program');
            $table->string('Department');
            $table->string('Batch');
            $table->string('Receipt_No');
            $table->string('Fee_Head');
            $table->string('Due_Amount');
            $table->string('Paid_Amount');
            $table->string('Concession');
            $table->string('Scholarship');
            $table->string('Reverse_Concession');
            $table->string('Write_off');
            $table->string('Adjusted_Amount');
            $table->string('Refund_Amount');
            $table->string('Fund_Transfer');
            $table->string('Remarks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excel_fees');
    }
};
