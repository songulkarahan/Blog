<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['tag'];
    public function blogs(){
        return $this->belongsToMany(Blog::class);
    }

    public function getRouteKeyName(){
      return 'tag';//hangi sütunun değerine göre rotaya değer koyacak. BU rota anahatarına göre ekler.
    }
}
