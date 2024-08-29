<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trick extends Model
{
    public function category() {
        return $this->belongsTo('App\Category');
    }
    public function user() {
        return $this->belongsTo('App\User');
    }

    protected $fillable = ['name', 'link', 'description', 'like', 'dislike', 'category_id', 'user_id'];
}

