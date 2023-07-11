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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('lien');
            $table->text('description');
            $table->string('image');
            $table->boolean('post')->default(false);
            $table->unsignedBigInteger('partenaire_id');
            $table->foreign('partenaire_id')->references('id')
                ->on('partenaires')->onDelete('cascade');
            $table->date('dateDebut')->default(Carbon::today());
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
