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
            $table->string('localisation')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('createur')->nullable();
            $table->foreign('createur')->references('id')->on('user');
            $table->timestamps();
            $table->text('descriptif',550);
            $table->string('etat');
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
