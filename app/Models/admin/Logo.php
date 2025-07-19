<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    use HasFactory;
    protected $fillable =[
        'title',
		'logo_url',
        'language',
        'txtuplode',
        'txtstatus',
        'admin_id'
    ];
}
