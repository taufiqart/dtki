<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profil;
use App\Models\Galery;
use App\Models\Category;

define('CATEGORY', 'Departemen');
define('CATEGORY_ID', Category::where('nama',CATEGORY)->first()->id)??null;
define('DATA_PROFIL', Profil::filter(['category'=>CATEGORY])->first()??null);

class AdminProfileDepartemenController extends Controller
{
	public function index()
	{		
		return view('admin.profile.departemen.index',[
			'title' => 'Profile | Departemen',
			'url' => route('adm_profile_departemen'),
			'url_view' => route('departemen')
		]);
	}


	// DESKRIPSI CONTROLLERS

	public function desIndex()
	{
		return view('admin.profile.departemen.deskripsi', [
			'title' => 'Deskripsi | Profil Departemen',
			'url_back' => route('adm_profile_departemen'),
			'url' => route('adm_PD_deskripsi'),
			'data' => DATA_PROFIL
		]);
	}

	public function desEdit()
	{
		return view('admin.profile.departemen.deskripsi_edit', [
			'title' => 'Edit Deskripsi | Profil Departemen',
			'url' => route('adm_PD_deskripsi'),
			'data' => DATA_PROFIL
		]);
	}

	public function desUpdate(Request $request)
	{
		$validateData = $request->validate([
			'title' => 'max:255|nullable',
			'image'=> 'mimes:jpg,jpeg,png,svg,gif|image|max:2048|nullable',
			'deskripsi' => 'nullable'
		]);

		$validateData['category_id'] = CATEGORY_ID;
		
		if ($request->file('image')) {
			$path = public_path().DATA_PROFIL->image;
			if (is_file($path)) {
				unlink($path);
			}

			$time = now()->timestamp.'-';
			$name = $time.$request->file('image')->getClientOriginalName();
			$validateData['image'] = '/assets/profile/departemen/img/'.$name;
			$request->file('image')->move(public_path().'/assets/profile/departemen/img/', $name);
		}

		Profil::where('category_id', CATEGORY_ID)->update($validateData);
		return redirect(route('adm_PD_deskripsi'))->with('success', 'data berhasil di edit!');
	}

		// GALERY CONTROLLERS

	public function galeryIndex()
	{
		return view('admin.profile.departemen.galery', [
			'title' => 'Galery | Profil Departemen ',
			'galery' => Galery::latest()->where('profil_id',CATEGORY_ID)->get(),
			'url_back' => route('adm_profile_departemen'),
			'url' => route('adm_PD_galery'),
		]);
	}

	public function galeryCreate()
	{
		return view('admin.profile.departemen.galery_add', [
			'title' => 'Add Galery | Profil Departemen',
			'url' => route('adm_PD_galery'),
		]);
	}

	public function galeryStore(Request $request)
	{		
		$validateData = $request->validate([
			'image'=> 'mimes:jpg,jpeg,png,svg,gif|image|max:2048|required',
			'title' => 'max:255|nullable'
		]);

		$validateData['profil_id'] = CATEGORY_ID;
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

	public function galeryEdit($galery)
	{
		return view('admin.profile.departemen.galery_edit', [
			'title' => 'Edit Galery | Profil Departemen',
			'data' => Galery::find($galery),
			'url' => route('adm_PD_galery'),
		]);
	}

	public function galeryUpdate(Request $request, $galery)
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

	public function galeryDestroy($galery)
	{
		$path = public_path().Galery::find($galery)->image;
		if (is_file($path)) {
			unlink($path);
		}

		Galery::destroy($galery);
		return redirect(route('adm_PD_galery'))->with('success', 'data berhasil di hapus!');
	}


}
