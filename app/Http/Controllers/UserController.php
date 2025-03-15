<?php

namespace App\Http\Controllers;

use App\Interfaces\UserInterface;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // public $userInterface;
    public function __construct(public UserInterface $usrInterface)
    {

        // $this->userInterface =$usrInterface;

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try {
            $data =  $this->usrInterface->model();
            return view('users', $data);
        } catch (Exception $error) {
            return back()->withErrors([
                'message' => 'No data Found'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

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
    public function show(string $id)
    {
        try {
            $user = User::find($id);
            return view('user-detail', ['user' => $user]);
        } catch (Exception $error) {
            return back()->withErrors([
                'message' => 'No data Found'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {


        try {
            $user = User::with('roles')->find($id);
            $role = Role::get();
            // dd($role->all());
            // dd($user->all());
            return view('user-edit', ['user' => $user,'role'=>$role]);
        } catch (Exception $error) {
            return redirect()->route('user.view')->withErrors(" User not found");

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        try {
            $users = $this->usrInterface->Update($request, $id);
            return redirect()->route('user.view');
        }
        catch (Exception $error) {
            return redirect()->route('user.edit',$id)->withErrors(" user data not updated");

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        try {
            $this->usrInterface->destroyUser($id);
            return response()->json(['success' => true]);
        } catch (Exception $error) {
            return back()->withErrors([
                'message' => 'User can not be updated'
            ]);
        }
    }
}
