<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Gallery extends Model
{
    public function pictures() {
        return $this->hasMany(Picture::class);
    }

    public function user() {
        return $this->belongsTo('App\User', 'author_id', 'id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }



}
