<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galery;
use App\Models\Category;

define('CATEGORY', 'Departemen');
define('PROFIL_ID', Category::where('nama',CATEGORY)->first()->id);

class AdminProfileDepartemenGaleryController extends Controller
{

	public function index()
	{
		return view('admin.profile.departemen.galery', [
			'title' => 'Galery | Profil Departemen ',
			'galery' => Galery::where('profil_id',PROFIL_ID)->get(),
			'url_back' => route('adm_profile_departemen'),
			'url' => route('adm_PD_galery'),
		]);
	}

	public function create()
	{
		return view('admin.profile.departemen.galery_add', [
			'title' => 'Add Galery | Profil Departemen',
			'url' => route('adm_PD_galery'),
		]);
	}

	public function store(Request $request)
	{		
		$validateData = $request->validate([
			'image'=> 'mimes:jpg,jpeg,png,svg,gif|image|max:2048|required',
			'title' => 'max:255|nullable'
		]);

		$validateData['profil_id'] = PROFIL_ID;
		$time = now()->timestamp;
		if ($request->file('image')) {
			$time = now()->timestamp.'-';
			$name = $time.$request->file('image')->getClientOriginalName();
			$validateData['image'] = '/assets/profile/departemen/img/'.$name;
			$request->file('image')->move(public_path().'/assets/profile/departemen/img/', $name);
		}

		Galery::create($validateData);

		return redirect(route('adm_PD_galery'))->with('success', 'data berhasil di tambahkan!');

	}

	public function show($id)
	{
		return abort(404);
	}

	public function edit($galery)
	{
		return view('admin.profile.departemen.galery_edit', [
			'title' => 'Edit Galery | Profil Departemen',
			'data' => Galery::find($galery),
			'url' => route('adm_PD_galery'),
		]);
	}

	public function update(Request $request, $galery)
	{

		$validateData = $request->validate([
			'image'=> 'mimes:jpg,jpeg,png,svg,gif|image|max:2048|nullable',
			'title' => 'max:255|nullable'
		]);

		if ($request->file('image')) {
			$path = public_path().Galery::find($galery)->image;
			if (is_file($path)) {
				unlink($path);
			}

			$time = now()->timestamp.'-';
			$name = $time.$request->file('image')->getClientOriginalName();
			$validateData['image'] = '/assets/profile/departemen/img/'.$name;
			$request->file('image')->move(public_path().'/assets/profile/departemen/img/', $name);
		}

		Galery::where('id', $galery)->update($validateData);
		return redirect(route('adm_PD_galery'))->with('success', 'data berhasil di edit!');
	}

	public function destroy($galery)
	{
		$path = public_path().Galery::find($galery)->image;
		if (is_file($path)) {
			unlink($path);
		}

		Galery::destroy($galery);
		return redirect(route('adm_PD_galery'))->with('success', 'data berhasil di hapus!');
	}
}
