<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferSaldo extends Model
{
    use HasFactory;
    protected $table = 'transfer_saldo';
    protected $fillable = [
        'sumber_rekening',
        'tujuan_transfer',
        'jumlah_transfer',
        'tanggal',
        'jam',
        'biaya_admin',
        'user_id', // Add user_id as a foreign key
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
