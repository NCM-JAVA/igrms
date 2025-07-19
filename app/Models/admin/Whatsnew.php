<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whatsnew extends Model
{
    use HasFactory;
    protected $fillable=[
        'title','url','page_url','is_new','language','menutype','metakeyword','metadescription','description','txtuplode','txtweblink','txtstatus','admin_id','startdate','enddate'

];
}
