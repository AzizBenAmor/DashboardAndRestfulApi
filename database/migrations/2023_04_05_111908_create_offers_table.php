<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description');
            $table->string('image');
            $table->string('adress');
            $table->integer('reduction');
            $table->string('prix');
            $table->date('dateDebut')->default(Carbon::today());
            $table->date('dateFin');
            $table->string('tel');
            $table->boolean('permanent');
            $table->integer('stat');
            $table->integer('type');
         
                $table->unsignedBigInteger('partenaire_id');
            $table->foreign('partenaire_id')->references('id')
                ->on('partenaires')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
