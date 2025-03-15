<?php


namespace App\Services;

use App\Interfaces\UserInterface;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\alert;

class UserService implements UserInterface
{





    public function register($request)
    {
        DB::transaction(function () use ($request) {
            $users = User::create([
                "name" => $request->user_name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                "phone_number" => $request->phone_no

            ]);
            $role = Role::where('role_name', 'User')->first()->id;
            $users->roles()->attach($role);
        });
    }


    public function authenticate($request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            //     // return redirect()->intended('layout');
            // return view('layout');

        }

        // return back()->withErrors([
        //     'email'=>'The provided credentials do not match our records.'
        // ])->onlyInput('email');


    }


    public function model()
    {

          $users =   User::whereDoesntHave('roles',function($query){
            $query->where('role_name',"Admin");
          })->with('roles')->get();

          $count =   User::whereHas('roles',function($query){
            $query->whereIn('role_name',['Agent','User']);
          })->count();


          return ['users'=>$users,'count'=>$count];
          dd($count);
    }

    public function Update($request, $id)
    {
        DB::transaction(function () use ($request, $id) {

            $user = User::findOrFail($id);
            $user->update([
                "name" => $request->user_name,
                "email" => $request->email,
                "phone_number" => $request->phone_no,
            ]);

            // dd($request->role);
            // $role = Role::where('role_name',$request->role)->get;
            $user->roles()->sync($request->role);

            // return $user;
        });
    }

    public function destroyUser($id)
    {
        DB::transaction(function () use ($id) {
            $user_record = User::find($id);

            if ($user_record) {
                $user_role = UserRole::where('user_id', $user_record->id)->first(); // Using first() instead of find()

                if ($user_role) {
                    $user_record->roles()->detach($user_role);
                    $user_role->delete();
                }

                $user_record->delete();
            }
        });
    }
}
