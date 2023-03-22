<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	public function login()
	{
		return view('login',[
			'title' => 'Admin Login'
		]);
	}

	public function authenticate(Request $request)
	{
		$credentials = $request->validate([
			'username' => 'required',
			'password' => 'required'
		]);

		if(Auth::attempt($credentials)){
			$request->session()->regenerate();
			return redirect()->intended('/admin');
		}

		// return dd($credentials);
		return back()->with('error','Login failed!');
	}

	public function logout(Request $request)
	{
		Auth::logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();

		return redirect('/');
	}

	public function setting()
	{
		return view('admin.setting',[
			'title' => 'Setting'
		]);
	}

	public function update(Request $request)
	{
		$validateData = $request->validate([
			'username' => 'required|unique:users,username,'.auth()->id(),
			'password' => 'required'
		]);
		$validateData['password'] = bcrypt($validateData['password']);
		auth()->user()->update($validateData);
		return redirect(route('dashboard'))->with('success', 'Account has been updated');
	}
}
