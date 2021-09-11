<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertaWebinarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta_webinar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('webinar_id');
            $table->unsignedBigInteger('peserta_id');
            $table->timestamps();
            $table->foreign('webinar_id')->references('id')->on('webinar')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('peserta_id')->references('id')->on('peserta')
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peserta_webinar');
    }
}
