<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profil;
use App\Models\Category;

define('CATEGORY', 'Departemen');
define('CATEGORY_ID', Category::where('nama',CATEGORY)->first()->id);
define('DATA_PROFIL', Profil::filter(['category'=>CATEGORY])->first()??null);

class AdminProfileDepartemenDeskripsiController extends Controller
{
	
	public function index()
	{
		return view('admin.profile.departemen.deskripsi', [
			'title' => 'Deskripsi | Profil Departemen',
			'url_back' => route('adm_profile_departemen'),
			'url' => route('adm_PD_deskripsi'),
			'data' => json_decode(DATA_PROFIL)
		]);
	}

	public function edit()
	{
		return view('admin.profile.departemen.deskripsi_edit', [
			'title' => 'Edit Deskripsi | Profil Departemen',
			'url' => route('adm_PD_deskripsi'),
			'data' => json_decode(DATA_PROFIL)
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
			if (is_file($path)) {
				unlink($path);
			}

			$time = now()->timestamp.'-';
			$name = $time.$request->file('image')->getClientOriginalName();
			$validateData['image'] = '/assets/profile/departemen/img/'.$name;
			$request->file('image')->move(public_path().'/assets/profile/departemen/img/', $name);
		}

		Profil::where('category_id', CATEGORY_ID)->update($validateData);
		return redirect(route('adm_PD_deskripsi'))->with('success', 'data berhasill di edit!');
	}

}
