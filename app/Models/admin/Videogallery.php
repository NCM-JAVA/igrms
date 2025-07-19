<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videogallery extends Model
{
    use HasFactory;
    protected $fillable =[
        'title',
        'language',
        'txtuplode',
        'txtstatus',
        'admin_id'

    ];
}
