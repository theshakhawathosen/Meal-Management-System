<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Deposite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Notifications\SendUserNotification;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function login()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        $user = Socialite::driver('google')->user();
        $dbexistuser = User::where('email',$user->getEmail())->first();

        if(!$dbexistuser)
        {
            $dbuser = User::create([
                "name" => $user->getName(),
                "email" => $user->getEmail(),
                "photo" => $user->getAvatar(),
            ]);

            Auth::login($dbuser);
            $notification = [
                'stitle' => 'New User Added!',
                'title' =>  $user->getName()." added to mess",
                'messege' => $user->getName()." added today in your mess. Stay Connected!",
                'userurl' => route('user.dashboard'),
                'adminurl' => route('admin.pendingusers'),
                'newuser' => Auth::user(),
            ];

            $users = User::where('status', true)->get();
            Notification::send($users, new SendUserNotification($notification));

        }else
        {
            Auth::login($dbexistuser);
        }


        if(Auth::user()->role == 'user')
        {
            if(Auth::user()->status == 1)
            {
                return redirect()->route('user.dashboard')->withSuccess('Login Success!');
            }else
            {
                Auth::logout();
                return redirect()->route('homepage')->withError('Your Account not active. Please Contact with Admin');
            }
        }
        else{
            return redirect()->route('admin.dashboard')->withSuccess('Login Success!');
        }
    }
}
