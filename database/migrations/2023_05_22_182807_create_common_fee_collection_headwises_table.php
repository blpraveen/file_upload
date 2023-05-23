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
        Schema::create('common_fee_collection_headwises', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('module_id');
            $table->unsignedInteger('receipt_id');
            $table->integer('head_id');
            $table->string('head_name',200);
            $table->unsignedInteger('branch_id');
            $table->double('amount', 8, 2);
            $table->foreign('module_id')->references('id')->on('modules');
            $table->foreign('receipt_id')->references('id')->on('common_fee_collections');
            $table->foreign('branch_id')->references('id')->on('branches');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('common_fee_collection_headwises');
    }
};
