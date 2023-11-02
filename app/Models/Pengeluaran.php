<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'pengeluaran';
    protected $fillable = [
        'nama_kategori',
        'nama_pengeluaran',
        'tujuan_transaksi',
        'kuantitas',
        'harga_peritem',
        'tanggal',
        'jam'
    ];
}
