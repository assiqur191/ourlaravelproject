<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Laravel\Sanctum\HasApiTokens;
use app\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
         'username',
         'email',
         'password',
         'avatar',
         'isadmin'
    ];

    // protected function avatar():Attribute{
    //     return Attribute::make(get:function($value){
    //                   if($value == null){
    //                     return "fallback-avatar.jpg";
    //                   }      
    //                   return $value; 
    //     });

    // }

    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

	/**
	 * The attributes that are mass assignable.
	 * 
	 * @return array<int, string>
	 */
	public function getFillable() {
		return $this->fillable;
	}
	
	/**
	 * The attributes that are mass assignable.
	 * 
	 * @param array<int, string> $fillable The attributes that are mass assignable.
	 * @return self
	 */
	public function setFillable($fillable): self {
		$this->fillable = $fillable;
		return $this;
	}
    public function postFeed(){
        return $this->hasManyThrough(Post::class,Follow::class,'user_id','user_id','id','followeduser');
    }
    public function posts(){
        return $this->hasMany(Post::class, 'user_id');
    }

    public function followers(){
       return $this->hasMany(Follow::class,'followeduser');
    }
    public function followingTheseUser(){
       return $this->hasMany(Follow::class,'user_id');
    }
}
