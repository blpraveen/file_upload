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
        Schema::create('fee_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200);
            $table->string('fee_type_ledger',200);
            $table->integer('seq_id');
            $table->unsignedInteger('branch_id');
            $table->unsignedInteger('fee_head_type_id');
            $table->unsignedInteger('fee_category_id');
            $table->unsignedInteger('fee_collection_type_id');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('fee_head_type_id')->references('id')->on('modules');
            $table->foreign('fee_category_id')->references('id')->on('fee_categories');
            $table->foreign('fee_collection_type_id')->references('id')->on('fee_collection_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_types');
    }
};
