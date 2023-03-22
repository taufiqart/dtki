<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengMasyarakatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peng_masyarakats', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('judul');
            // $table->string('slug')->unique();
            // $table->text('excerpt');
            // $table->text('body');
            $table->string('tempat')->nullable();
            $table->string('waktu')->nullable();
            $table->string('category');
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
        Schema::dropIfExists('peng_masyarakats');
    }
}
