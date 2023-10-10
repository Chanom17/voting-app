<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerVoter(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'identify_id' => 'required|min:13|max:13',
            'password' => 'required|min:6',
            'confirm-password' => 'required|same:password',
            'birthday' => 'required|date|before_or_equal:-18 years'
        ]);
        $voter = new Voter();
        $voter->name = $request->name;
        $voter->identify_id = $request->identify_id;
        $voter->password = $request->password;
        $voter->birthday = $request->birthday;
        $answer = $voter->save();

        if ($answer) {
            return back()->with('Success', 'You has been registered successful');
        } else {
            return back()->with('Fail', 'Something wrong');
        }
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginVoter(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required|min:6'
        ]);
        $voter = Voter::where('name', '=', $request->name)->first();
        if ($voter) {
            if (Hash::check($request->password, $voter->password)) {
                $request->session()->put('loginVoter', $voter->id);
                return redirect('dashboard');
            } else {
                return back()->with('Fail', 'Password is not correct.');
            }
        } else {
            return back()->with('Fail', 'This name is not registration.');
        }
    }

    public function dashboard()
    {
        $voter = null;
        if (Session::has('loginVoter')) {
            $voter = Voter::where('id', '=', Session::get('loginVoter'))->first();
        }
        return view('dashboard', compact('voter'));
    }

    public function logout()
    {
        if (Session::has('loginVoter')) {
            Session::pull('loginVoter');
            return redirect('login');
        }
    }

    public function welcome()
    {
        if (Session::has('loginVoter')) {
            return redirect('dashboard');
        } else {
            if (Session::has('loginAdmin')) {
                return redirect('a-dashboard');
            }
        }
        return view('welcome');
    }
}
