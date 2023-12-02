<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rekening');
            $table->decimal('jumlah_pinjaman', 10, 2);
            $table->string('nama_diberi_pinjaman');
            $table->text('catatan_pinjaman')->nullable();
            $table->string('tanggal_pinjaman');
            $table->string('jam_pinjaman');
            $table->string('tanggal_jatuh_tempo');
            $table->string('jam_jatuh_tempo');
            $table->enum('status', ['Sudah Lunas', 'Belum Lunas']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pinjaman');
    }
};
