<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExhibitionCategory extends Model
{
    use HasFactory;

    protected $fillable =[
        'category_id',
        'title',
        'description',
        'location',
        'category_txtuplode',
        'txtstatus'
    ];
}
