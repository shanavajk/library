<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookIssue extends Model
{
    public $table = "book_issues";
    public $primaryKey = "id";
    public $timestamps = false;
    
    protected $fillable = [
        'book_id', 'person_id'
    ];

    public function books() {
        return $this->belongsTo('App\Book', 'book_id', 'id');
    }

    public function person() {
        return $this->belongsTo('App\Person', 'person_id', 'id');
    }
}
