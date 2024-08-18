<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class log_history extends Model
{
    use HasFactory;

    protected $table = 'log_history';

    protected $fillable = [
        'user_id',
        'peminjaman_id',
        'type',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function buku()
    {
        return $this->belongsTo(peminjaman::class, 'peminjaman', 'id');
    }
}
