<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return view('welcome',[
            'users' => $users,
            ]);
    }
    
    public function followings($id)
    {
        $user = User::find($id);
        $followings = $user->followings()->paginate(3);
        
        $data = [
            'user' => $user,
            'users' => $followings,
            ];
            
        $data += $this->counts($user);
        
        return view('users.followings', $data);
    }
    
    public function followers($id)
    {
        $user = User::find($id);
        $followers = $user->followers()->paginate(3);
        
        $data = [
            'user' => $user,
            'users' => $followers,
            ];
            
        $data += $this->counts($user);
        
        return view('users.followers', $data);
    }
}
