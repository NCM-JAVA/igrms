<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exhibition extends Model
{
    use HasFactory;

    protected $fillable =[
        'category',
        'language',
        'txtuplode',
        'txtstatus',
        'admin_id'
    ];
    
}
