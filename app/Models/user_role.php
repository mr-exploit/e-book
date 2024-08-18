<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class user_role extends Model
{
    use HasFactory;

    protected $table = 'user_roles';

    protected $fillable = [
        'rolename'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
