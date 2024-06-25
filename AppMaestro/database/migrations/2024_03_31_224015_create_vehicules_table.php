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
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->string('marque');
            $table->string('marque_picture');
            $table->string('modele');
            $table->string('modele_picture');
            $table->year('annee');

            $table->unsignedBigInteger('couleur');
            $table->foreign('couleur')->references('id')->on('colors')->onDelete('cascade');
            
            $table->unsignedBigInteger('reference');
            $table->foreign('reference')->references('id')->on('references')->onDelete('cascade');
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicules');
    }
};
