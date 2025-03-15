<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuthenticateRequest;
use App\Http\Requests\UserRegistrationRequest;
use App\Interfaces\UserInterface;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{


    public function __construct(public UserInterface $userInterface)
    {
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(UserRegistrationRequest $request)
    {

        try {

            $this->userInterface->register($request);
            return redirect()->route('login')->withSuccess("New User Created Successfully");
        } catch (Exception $error) {
            return redirect()->route('user.register')->withErrors("New User not Created ");

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('registration');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function authenticate(UserAuthenticateRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            // return redirect()->intended('layout');
            return view('layout');

        }

        return back()->withErrors([
            'email'=>'The provided credentials do not match our records.'
        ])->onlyInput('email');


        $credentials = $request->only('email', 'password');


        // try {
            // $this->userInterface->authenticate($request);
            // return view('layout');

        //     // $request->session()->regenerate();
        //     // return view('layout');
        // } catch (Exception $err) {
        //     return redirect()->route('login')->withErrors("Your credentials dont match ourrrrr record");

        // }
    }




    public function logOut(Request $request){

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }


    public function unauthorized(){
        return view('unauthorized');
    }

}
