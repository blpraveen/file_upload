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
        Schema::create('common_fee_collections', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('module_id');
            $table->integer('tran_id');
            $table->string('admin_no',20);
            $table->string('roll_no',50);
            $table->double('amount', 8, 2);
            $table->unsignedInteger('branch_id');
            $table->string('academic_year',10);
            $table->string('financial_year',10);
            $table->string('receipt_no',200);
            $table->integer('entry_mode');
            $table->date('paid_date');
            $table->tinyInteger('inactive')->nullable();
            $table->foreign('module_id')->references('id')->on('modules');
            $table->foreign('branch_id')->references('id')->on('branches');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('common_fee_collections');
    }
};
