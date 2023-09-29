<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){
        try{
            $user = Socialite::driver($provider)->user();

        }catch(\Exception $e){
            return redirect()->route('login');
        }

        $authUser = $this->checkLogin($user);

        Auth::login($authUser);

        return redirect()->route('home');
    }

    public function checkLogin($data){
        $authUser = User::where('provider_id',$data->id)->first();

        if($authUser){
            return $authUser;
        }

        $name_slug = Str::of($data->name)->slug('-');
        $counter = 0;
        while (User::where('name_slug', '=', $name_slug)->count() > 0) {
          if ($counter == 0) {
            $name_slug = $name_slug . '-' . rand(0, 9);
            $counter++;
          } else {
            $name_slug = $name_slug . rand(0, 9);
          }
        }

        return User::create([
            'name' => $data->name,
            'name_slug' => $name_slug,
            'email' => $data->email,
            'provider_id' => $data->id,
            'avatar' => $data->avatar
        ]);
    }
}
