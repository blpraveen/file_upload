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
        Schema::create('financial_transaction_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('financial_transaction_id');
            $table->unsignedInteger('module_id');
            $table->double('amount', 8, 2);
            $table->integer('head_id');
            $table->string('crdr',2)->nullable();
            $table->string('head_name',200);
            $table->unsignedInteger('branch_id');
            $table->foreign('financial_transaction_id')->references('id')->on('financial_transactions');
            $table->foreign('module_id')->references('id')->on('modules');
            $table->foreign('branch_id')->references('id')->on('branches');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_transaction_details');
    }
};
