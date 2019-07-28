<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'displayname','email', 'password','birth_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['birth_date' ];



    public function blogs(){
        return $this->hasMany(Blog::class);
    }

    public function getAgeAttribute(){ //normalde yaş diye bi alan yok ama onu okumak isteidğimde bu method bize yardımcı

      return $this->birth_date->age;
    }

    public function getRouteKeyName(){
      return 'name';
    }

    public function followers(){
      return $this->belongsToMany(User::class, 'followers', 'follower_id','followee_id')
    }

    public function followees(){
      return $this->belongsToMany(User::class, 'followers', 'followee_id','follower_id')
    }

    public function follow(User $user){
      if($this->isFollowing($user)) return true;//zaten takip ediyorsa true döndür.
      return $this->followees()->attach($user);
    }


    public function unfollow(User $user){
      if(!$this->isFollowing($user)) return true; //if not yap
      return $this->followees()->detach($user);
    }

    public function isFollowing(User $user){
      return $this->followees()->contains($user);
    }
/*
    public function comments(){
        return $this->hasMany(Comment::class);
    }
*/
//@TODO: profilecontroller da hasfile fonk altına profil foto varsa kaldır Validaiton hatalarını ekrana yaz.
//Closure middleware yaptığımızda bi sonraki kod bloguna geçmek için tanımlanır
//Closure $next dediğimde bi sonrakine gitmesi demek oluyo.
}
