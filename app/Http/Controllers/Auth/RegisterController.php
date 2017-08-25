<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\NewUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest');
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'cellphone' => 'required|number|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'gender' => $data['gender'],
            'cellphone' => $data['cellphone'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function edit($id)
    {
        $user =NewUser::where('id',$id)->first();
        return view ('users.edit',compact('user'));
    }
}
