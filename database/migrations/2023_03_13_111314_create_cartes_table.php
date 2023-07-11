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
        Schema::create('cartes', function (Blueprint $table) {
            $table->id();
            $table->string('codeBar')->unique();
            $table->boolean('is_active')->default(false);
            $table->Date('date')->default(Carbon::today());
            $table->unsignedBigInteger('cause_id')->nullable();           
            $table->foreign('cause_id')->references('id')
                ->on('causes');
            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartes');

    }
};
