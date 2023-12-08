<?php

// Hutang.php (in App\Models)

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Hutang extends Model
{
    use HasFactory;

    protected $table = 'hutang';
    protected $fillable = [
        'rekening',
        'jumlah_hutang',
        'nama_pemberi_hutang',
        'catatan_hutang',
        'tanggal_hutang',
        'jam_hutang',
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
