<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'pemasukan';
    protected $fillable = [
        'nama_kategori',
        'rekening',
        'jumlah_pemasukan',
        'catatan_pemasukan',
        'tanggal',
        'jam'
    ];
}
