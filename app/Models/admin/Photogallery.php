<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photogallery extends Model
{
    use HasFactory;
    protected $fillable =['title','description','language','txtuplode','txtstatus','admin_id','create_date','update_date','category_id','type'];
}
