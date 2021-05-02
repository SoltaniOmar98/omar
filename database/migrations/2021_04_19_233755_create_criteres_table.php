<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriteresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criteres', function (Blueprint $table) {
            $table->id();
            $table->string('titre' , 255);
            $table->string('note_F' ,4)->nullable();
            $table->string('note_AE' , 4)->nullable();
            $table->text('remarque')->nullable();
            $table->unsignedBigInteger('reference_id');
            $table->foreign('reference_id')->references('id')->on('references')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('criteres');
    }
}
