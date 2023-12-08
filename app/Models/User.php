<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Define a one-to-many relationship with Pemasukan model.
     */
    public function pemasukans()
    {
        return $this->hasMany(Pemasukan::class);
    }

    /**
     * Define a one-to-many relationship with Pengeluaran model.
     */
    public function pengeluarans()
    {
        return $this->hasMany(Pengeluaran::class);
    }

    /**
     * Define a one-to-many relationship with Hutang model.
     */
    public function hutangs()
    {
        return $this->hasMany(Hutang::class);
    }

    /**
     * Define a one-to-many relationship with Pinjaman model.
     */
    public function pinjamans()
    {
        return $this->hasMany(Pinjaman::class);
    }

    /**
     * Define a one-to-many relationship with TransferSaldo model.
     */
    public function transfersaldos()
    {
        return $this->hasMany(TransferSaldo::class);
    }
}
