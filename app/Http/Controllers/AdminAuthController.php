<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Voter;
use App\Models\Candidate;
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
        $voters = Voter::orderBy('voted', 'desc')->get();
        $candidates = Candidate::orderBy('votes', 'desc')->get();
        $latestVoters = Voter::orderByDesc('updated_at')->take(3)->get();
        $HighestCan = Candidate::orderByDesc('votes')->take(3)->get();
        return view('admin_dashboard', compact('admin','voters','candidates','latestVoters','HighestCan'));
    }

    public function adminLogout()
    {
        if (Session::has('loginAdmin')) {
            Session::pull('loginAdmin');
            return redirect('a-login');
        }
    }
}
