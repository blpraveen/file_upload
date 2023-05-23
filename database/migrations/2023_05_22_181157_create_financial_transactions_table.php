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
        Schema::create('financial_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('module_id');
            $table->integer('tran_id');
            $table->string('admin_no',20);
            $table->double('amount', 8, 2);
            $table->string('crdr',2)->nullable();
            $table->date('trans_date');
            $table->string('academic_year',10);
            $table->string('financial_year',10);
            $table->integer('entry_mode');
            $table->integer('voucher_no');
            $table->unsignedInteger('branch_id');
            $table->longText('type_of_concession')->nullable();
            $table->foreign('module_id')->references('id')->on('modules');
            $table->foreign('branch_id')->references('id')->on('branches');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_transactions');
    }
};
