<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    public function aLogin()
    {
        return view('auth.admin_login');
    }

    public function loginAdmin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:4'
        ]);
        $admin = Admin::where('username', '=', $request->username)->first();
        if ($admin) {
            if (Hash::check($request->password, $admin->password)) {
                $request->session()->put('loginAdmin', $admin->id);
                return redirect('a-dashboard');
            } else {
                return back()->with('Fail', 'Password is not correct.');
            }
        } else {
            return back()->with('Fail', 'Username is not correct.');
        }
    }

    public function adminDashboard()
    {
        $admin = null;
        if (Session::has('loginAdmin')) {
            $admin = Admin::where('id', '=', Session::get('loginAdmin'))->first();
        }
        return view('admin_dashboard', compact('admin'));
    }

    public function adminLogout()
    {
        if (Session::has('loginAdmin')) {
            Session::pull('loginAdmin');
            return redirect('a-login');
        }
    }
}
