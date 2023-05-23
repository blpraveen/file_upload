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
        Schema::create('entry_modes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('entry_mode_name', 200);
            $table->string('crdr',2)->nullable();
            $table->integer('entry_mode_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entry_modes');
    }
};
