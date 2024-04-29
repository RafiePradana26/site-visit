<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteVisitModel extends Model
{
    use HasFactory;

    protected $table = 't_site_visit'; // Nama tabel yang sesuai dengan migrasi Anda

    protected $fillable = [
        'name',
        'email',
        'location',
        'clientName',
        'purpose',
        'visit_photo',
        'sign_photo',
        'sign_photo_client' 
    ];
}
