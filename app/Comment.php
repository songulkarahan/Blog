<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public  function blog(){
        return $this->belongsTo(Blog::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function children(){
        return $this->hasMany(Comment::clas, 'parent_id');
    }


}
