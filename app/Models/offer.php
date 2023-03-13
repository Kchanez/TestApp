<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offer extends Model
{
    use HasFactory;

    //protected $table= "offers";
    protected $fillable = ['photo','name','price','details', 'created_at'];
    protected $hidden = ['created_at'];
}
