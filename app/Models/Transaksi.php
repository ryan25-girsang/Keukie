<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected  $table = 'transaksi';

    protected $fillable = [
        'user_id',
        'jenis',
        'nominal',
        'metode',
        'tanggal',
        'catatan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}