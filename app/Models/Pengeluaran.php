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
        'jam',
        'user_id', // Add user_id as a foreign key
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
