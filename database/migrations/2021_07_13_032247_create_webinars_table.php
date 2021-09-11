<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebinarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webinar', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug');
            $table->longText('deskripsi');
            $table->date('tgl_acara');
           $table->string('waktu_mulai');
           $table->string('waktu_selesai');
           $table->string('zoom')->nullable()->default('Zoom Meeting');
           $table->string('poster_img');
           $table->unsignedBigInteger('user_id');
           $table->unsignedBigInteger('pembicara_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('pembicara_id')->references('id')->on('pembicara')
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
        Schema::dropIfExists('webinars');
    }
}
