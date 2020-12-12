<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public $table = "people";
    public $primaryKey = "id";
    public $timestamps = false;
    
    protected $fillable = [
        'name'
    ];

   
}
