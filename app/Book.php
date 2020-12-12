<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $table = "books";
    public $primaryKey = "id";
    public $timestamps = false;
    
    protected $fillable = [
        'book_name'
    ];
        
}
