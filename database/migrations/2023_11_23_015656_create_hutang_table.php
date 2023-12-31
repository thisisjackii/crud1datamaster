<?php

// CreateHutangTable.php (in database/migrations)

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hutang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rekening');
            $table->integer('jumlah_hutang');
            $table->string('nama_pemberi_hutang');
            $table->text('catatan_hutang')->nullable();
            $table->date('tanggal_hutang');
            $table->string('jam_hutang');
            $table->date('tanggal_jatuh_tempo');
            $table->string('jam_jatuh_tempo');
            $table->enum('status', ['Sudah Lunas', 'Belum Lunas']);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hutang');
    }
};

