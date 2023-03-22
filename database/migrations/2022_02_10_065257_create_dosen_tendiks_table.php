<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenTendiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosen_tendiks', function (Blueprint $table) {
            $table->id();
            $table->text('nama');
            $table->string('nip')->unique();
            $table->string('email')->nullable();
            $table->string('jabatan')->nullable();
            $table->text('profil_sinta')->nullable();
            $table->text('profil_scholar')->nullable();
            $table->string('image')->nullable();
            $table->string('profil_file')->nullable();
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
        Schema::dropIfExists('dosen_tendiks');
    }
}
