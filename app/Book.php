<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function readers(){
        return $this->belongsToMany(User::class, 'user_book')->withTimestamps();
    }

}
