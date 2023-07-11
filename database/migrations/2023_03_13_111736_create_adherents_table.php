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
        Schema::create('adherents', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('tel');
            $table->string('cin');
            $table->string('adress');
            $table->boolean('password_changed')->default(false);
            $table->unsignedBigInteger('gov_id');
            $table->unsignedBigInteger('ville_id');
            $table->foreign('ville_id')->references('id')
                ->on('villes');
            $table->foreign('gov_id')->references('id')
                ->on('gouvernorats')->onDelete('cascade');
            $table->unsignedBigInteger('amicale_id');
            $table->foreign('amicale_id')->references('id')
                ->on('amicales')->onDelete('cascade');
            $table->unsignedBigInteger('carte_id')->unique();
            $table->foreign('carte_id')->references('id')
                ->on('cartes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adherents');

    }
};
