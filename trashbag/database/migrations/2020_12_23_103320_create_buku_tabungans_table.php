<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukuTabungansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku_tabungans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('jenis_id')->constrained('jenissampah')->nullable();
            $table->tinyInteger('keterangan')->nullable();
            $table->double('berat')->nullable();
            $table->integer('debit')->nullable();
            $table->integer('kredit')->nullable();
            $table->integer('saldo')->nullalble();
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
        Schema::dropIfExists('buku_tabungans');
    }
}
