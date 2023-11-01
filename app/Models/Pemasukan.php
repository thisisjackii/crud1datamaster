<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_kategori',
        'rekening',
        'jumlah_pemasukan',
        'catatan_pemasukan',
        'tanggal',
        'jam'
    ];
}
