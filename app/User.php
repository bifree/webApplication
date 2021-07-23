<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
        'name', 'email', 'password','profile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }
    
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    public function is_following($userId)
    {
        return $this->followings()->where('follow_id',$userId)->exists();
    }
    
    public function follow($userId)
    {
        //既にフォロー済みではないか
        $existing = $this->is_following($userId);
        //フォローする相手がユーザー自身ではないか？
        $myself = $this->id == $userId;
        
        //フォロー済みでない、かつ自身でない場合、フォロー
        if (!$existing && !$myself) {
            $this->followings()->attach($userId);
        }
    }
    
    public function unfollow($userId)
    {
        //既にフォロー済みでないか？
        $existing = $this->is_following($userId);
        //フォローする相手がユーザー自身ではないか？
        $myself = $this->id == $userId;
        
        //既にフォロー済みである場合、フォロー外す
        if ($existing && !$myself) {
            $this->followings()->detach($userId);
        }
    }
    
    
}
