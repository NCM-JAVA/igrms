<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    use HasFactory;
    protected $fillable =['officers_name','url','designation','contents','language','txtuplode','txtstatus','admin_id','create_date','update_date'];

}
