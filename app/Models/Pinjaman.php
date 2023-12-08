<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;

    protected $table = 'pinjaman';
    protected $fillable = [
        'rekening',
        'jumlah_pinjaman',
        'nama_diberi_pinjaman',
        'catatan_pinjaman',
        'tanggal_pinjaman',
        'jam_pinjaman',
        'tanggal_jatuh_tempo',
        'jam_jatuh_tempo',
        'status',
        'user_id', // Add user_id as a foreign key
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
