<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //
    public function create(){
        return view('users.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => ['required','min:3'],
            'email' => ['required','email', Rule::unique('users','email')],
            'password' => ['required','min:6', 'confirmed'],
            // 'password_confirmation' => ['required'],
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        auth()->login($user);

        return redirect('/')->with('success', 'you are logged in successfully');
    }

    public function logout(Request $request){

        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'logged out successfully');;
    }


    public function login(Request $request){
        if ($request->isMethod('get')) {
            return view('users.login');
        }

        if ($request->isMethod('post')) {
            $validated = $request->validate([

                'email' => ['required','email'],
                'password' => ['required'],
                // 'password_confirmation' => ['required'],
            ]);

            if(auth()->attempt($validated)){
                $request->session()->regenerate();
                return redirect('/')->with('success','logged in successfully');
            }
            return back()->withErrors(['email' => 'invalid credentials'])->onlyInput('email');

        }

    }
}
