<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'akses_halaman',
        'role',
        // Add other fillable fields as needed
    ];

    // Define relationships if any, for example:
        public function user()
        {
            return $this->belongsTo(User::class, 'user_id');
        }
}