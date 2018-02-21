<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Gallery;

class Comment extends Model
{
    public function gallery() {
        return $this->belongsTo('App\Gallery', 'gallery_id', 'id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }


}
