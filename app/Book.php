<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'desc', 'img'
    ];

    public function Categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
