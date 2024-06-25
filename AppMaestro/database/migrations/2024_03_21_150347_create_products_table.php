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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('marque');
            $table->foreign('marque')->references('id')->on('vehicules')->onDelete('cascade');
            
            $table->unsignedBigInteger('modele');
            $table->foreign('modele')->references('id')->on('vehicules')->onDelete('cascade');

            $table->unsignedBigInteger('couleur');
            $table->foreign('couleur')->references('id')->on('colors')->onDelete('cascade');

            $table->unsignedBigInteger('reference');
            $table->foreign('reference')->references('id')->on('references')->onDelete('cascade');

            $table->unsignedBigInteger('annee');
            $table->foreign('annee')->references('id')->on('vehicules')->onDelete('cascade');
            
            $table->unsignedBigInteger('creator');
            $table->foreign('creator')->references('id')->on('users')->onDelete('cascade');
            
            $table->text('composants');
            $table->integer('qtt_article');
            






            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
