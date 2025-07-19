<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanghralaya extends Model
{
    use HasFactory;
    protected $fillable =[
        'title',
        'description',
        'language',
        'txtuplode',
        'txtstatus',
        'admin_id'
    ];
}
