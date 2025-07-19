<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;
    protected $fillable =[
        'title',
        'language',
        'icons',
        'page_url',
        'titleType',
        'txtstatus',
        'admin_id'
    ];
}
