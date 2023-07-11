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
        Schema::table('cartes', function (Blueprint $table) {
            $table->unsignedBigInteger('amicale_id')->nullable();           
            $table->foreign('amicale_id')->references('id')
                    ->on('amicales');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cartes', function (Blueprint $table) {
            //
        });
    }
};
