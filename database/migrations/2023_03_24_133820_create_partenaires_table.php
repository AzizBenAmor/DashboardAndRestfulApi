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
        Schema::create('partenaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('nom_responsable');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('changed_password')->default(0);
            $table->string('cin')->unique();
            $table->rememberToken();
            $table->string('numero');
            $table->string('image');            
            $table->string('adress');
            $table->unsignedBigInteger('gov_id');
            $table->unsignedBigInteger('ville_id');
            $table->foreign('ville_id')->references('id')
                ->on('villes');
            $table->foreign('gov_id')->references('id')
                ->on('gouvernorats')->onDelete('cascade');
            $table->unsignedBigInteger('secteur_id');
            $table->foreign('secteur_id')->references('id')
                ->on('secteurs');
            $table->unsignedBigInteger('profession_id');
            $table->foreign('profession_id')->references('id')
                ->on('professions');
            $table->unsignedBigInteger('specialite_id');
            $table->foreign('specialite_id')->references('id')
                ->on('specialites');
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partenaires');
    }
};
