<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['name_user', 'name_tech', 'subject', 'description', 'created_at', 'product', 'email', 'phone', 'status', 'ticket_id', 'user_id'];
    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Adjust the foreign key if needed
    }

    public function messages()
    {
        return $this->hasMany(Chat::class, 'ticket_id');
    }
}

