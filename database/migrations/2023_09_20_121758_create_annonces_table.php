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
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->string('titre',55);
            $table->dateTime('Date-creation');
            $table->unsignedBigInteger ('produit_id');
            $table->foreign('produit_id')->references('id')->on('produits');
            $table->unsignedBigInteger('localisation');
            $table->foreign('localisation')->references('id')->on('user');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('createur');
            $table->foreign('createur')->references('id')->on('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonces');
    }
};
