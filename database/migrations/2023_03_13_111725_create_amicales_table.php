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
        Schema::create('amicales', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('nom_responsable');
            $table->string('email')->unique();
            $table->string('numero');
            $table->string('image');
            $table->string('cin')->unique();
            $table->unsignedBigInteger('gov_id');
            $table->unsignedBigInteger('ville_id');
            $table->foreign('ville_id')->references('id')
                ->on('villes');
            $table->foreign('gov_id')->references('id')
                ->on('gouvernorats')->onDelete('cascade');
                $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amicales');

    }
};
