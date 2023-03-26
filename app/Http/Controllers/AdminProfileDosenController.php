<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profil;
use App\Models\Category;

define('CATEGORY', 'Dosen');
define('CATEGORY_ID', Category::where('nama',CATEGORY)->first()->id);
json_decode(define('DATA_PROFIL', Profil::first()??null));
class AdminProfileDosenController extends Controller
{
	public function index()
	{
		// return dd(json_decode(DATA_PROFIL)->title);
		return view('admin.profile.dosen.index',[
			'title' => 'Profile | Dosen',
			'data' => json_decode(DATA_PROFIL),
			'url' => route('adm_profile_dosen'),
			'url_view' => route('dosen')
		]);
	}

	public function edit()
	{
		return view('admin.profile.dosen.edit',[
			'title' => 'Edit Profile | Dosen',
			'data' => DATA_PROFIL,
			'url' => route('adm_profile_dosen')
		]);
	}

	public function update(Request $request)
	{

		$validateData = $request->validate([
			'title' => 'max:255|nullable',
			'image'=> 'mimes:jpg,jpeg,png,svg,gif|image|max:2048|nullable',
			'deskripsi' => 'nullable'
		]);

		$validateData['category_id'] = CATEGORY_ID;
		
		if ($request->file('image')) {
			$path = public_path().json_decode(DATA_PROFIL)->image;
			return dd($path);
			if (is_file($path)) {
				unlink($path);
			}

			$time = now()->timestamp.'-';
			$name = $time.$request->file('image')->getClientOriginalName();
			$validateData['image'] = '/assets/profile/dosen/img/'.$name;
			$request->file('image')->move(public_path().'/assets/profile/dosen/img/', $name);
		}
		Profil::where('category_id', CATEGORY_ID)->update($validateData);
		return redirect(route('adm_profile_dosen'))->with('success', 'data berhasill di edit!');

	}
}
