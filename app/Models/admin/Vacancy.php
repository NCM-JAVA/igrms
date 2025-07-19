<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;
    protected $fillable =[
        'title',
        'url',
        'page_url',
        'is_new',
        'language',
        'menutype',
        'vacancytype',
        'metakeyword',
        'metadescription',
        'description',
        'txtuplode',
        'txtweblink',
        'txtstatus',
        'admin_id',
        'startdate',
        'enddate'
   ];
}
