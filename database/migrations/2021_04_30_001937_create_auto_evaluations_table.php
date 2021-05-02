<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutoEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_evaluations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grille_id');
            $table->foreign('grille_id')->references('id')->on('grilles')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('etab_id');
            $table->foreign('etab_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('statut');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auto_evaluations');
    }
}
