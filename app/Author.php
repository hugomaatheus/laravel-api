<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    function books() {
        return $this->hasMany('App\Book');
    }

    protected $fillable = ['name', 'age', 'email', 'password'];
}
