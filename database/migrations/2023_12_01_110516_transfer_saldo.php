<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_saldo', function (Blueprint $table) {
            $table->id();
            $table->string('sumber_rekening');
            $table->string('tujuan_transfer');
            $table->integer('jumlah_transfer');
            $table->date('tanggal');
            $table->string('jam');
            $table->integer('biaya_admin');
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
        Schema::dropIfExists('transfer_saldo');
    }
};
