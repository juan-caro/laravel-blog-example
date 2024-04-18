<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    //

    public function create(){
        return view('sessions.create');
    }

    public function store(){
        // we have to validate the request
        $attributes = request()->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        // attempt to authenticate and log in the user
        // based on the provided credentials

        if(! auth()->attempt($attributes)){
            // auth failed
            throw ValidationException::withMessages([
                'email'=> 'Your provided credentials could not be verified.'
            ]);


        }

        // redirect with a success flash message
        session()->regenerate();
        // session fixation es un tipo de ataque a web en el que el atacante trickea la sesión del user

        return redirect('/posts')->with('success','Welcome Back!');

        // return back()
        //     ->withInput()
        //     ->withErrors(['email'=> 'Your provided credentials could not be verified.']);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect("/posts")->with("success","Goodbye!");
    }


}
