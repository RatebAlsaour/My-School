<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Master;

class AuthAdmin extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $classes = ClassRoom::all();
        $sta = [
            'student' => Student::all()->count(),
            'teacher' =>  Teacher::all()->count(),
            'master' =>  Master::all()->count(),
        ];

        return view('admin.home')->with('data', $classes )->with('sta',$sta);
    }


    public function register()
    {
        return view('admin.auth.register');
    }

    public function createAdmin(Request $request)
    {

        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|unique:admins|string|email|max:255',
                'password' => 'required|min:8|'
            ]
        );

        if ($validate->fails()) {
            return redirect()->back()->with('faile', $validate->errors());
        }

        Admin::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        return route('home');
    }

    //delete Admin
    public function deleteAdmin(Request $request)
    {

        $validate = Validator::make(
            $request->all(),
            [
                'email' => 'required|exists:admins|string|email|max:255',
            ]
        );

        if ($validate->fails()) {
            return redirect()->back()->with('faile', $validate->errors());
        }

        $boss = Admin::where('id', '=', '1')->first();

        $admin = Admin::where('email', '=', $request->email)->first();
        if (!$admin) {
            return redirect()->back()->with('faile', 'not found');
        }
        if ($admin == $boss)
            return redirect()->back()->with('faile', 'cant delet this accoutn');
        $admin->delete();
        return redirect()->back()->with('success', 'deleted successfully');
    }

    public function allAdmin(Request $request)
    {
        $admin = Admin::all();
        return view('admin.allAdmin')->with('data',$admin);
    }
}
