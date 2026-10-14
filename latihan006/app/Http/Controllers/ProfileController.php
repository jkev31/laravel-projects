<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request) {
        $request->session()->put('user_role', 'admin');
        session()->flash('status','profil diupdate');

        return redirect()->route('dashboard');
    }


    public function dashboard(Request $request) {
        $role = $request->session()->get('user_role','guest');
/*
        if ($request->session()->has('user_role')) {
            $request->session()->forget('user_role');
        }
*/
        return view('dashboard', ['role' => $role]);
    }
}
