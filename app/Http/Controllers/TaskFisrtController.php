<?php

namespace App\Http\Controllers;

use App\Models\TaskFirst;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TaskFisrtController extends Controller
{
    //
    public function reg()
    {
        return view('auth.reg');
    }

    public function regStore(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i|unique:task_firsts,email',
            'password' => 'required|min:8'
        ]);
        $data = new TaskFirst;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->save();
        return redirect('login');
    }

    public function loginStore(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'password' => 'required|min:8',
        ]);
        $user = TaskFirst::where('name', '=', $request->name)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('loginId', $user->id);
                $request->session()->put('name', $user['name']);
                return redirect('home')->with('success', 'Login successful');
            } else {
                return back()->with('fail', 'This Password not Matche');
            }
        } else {
            return back()->with('fail', 'This Name is not registered');
        }
    }

    public function login()
    {
        return view('auth.login');
    }

    public function home()
    {
        return view('auth.home');
    }
}
