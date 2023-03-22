<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laboratorium;
use App\Models\Galery;

define('URL_PATH', '/admin/lab/');
define('URL_VIEW', '/laboratorium/');
define('FOLDER_PATH','/assets/laboratorium/');

class AdminLaboratoriumGaleryController extends Controller
{
	public function getLab($lab)
	{		
		return Laboratorium::where('id',$lab)->orWhere('slug_lab',$lab)->first();
	}
	public function getFolderName($slug_lab)
	{
		$foldername = '';
		$arr = explode('-',$slug_lab);
		foreach($arr as $a){
			$foldername .= $a[0];
		}
		return $foldername;
	}

	public function index($lab)
	{
		$getLab = $this->getLab($lab);
		if($getLab){
			$galerys = $getLab->profilLab->first()->galery;
			return view('admin.laboratorium.galery', [
				'title' => 'Galery | Laboratorium '.$getLab->nama_lab,
				'galery' => $galerys,
				'url_back' => URL_PATH.$lab,
				'url' => URL_PATH.$lab.'/galery',
			]);
		}
		return abort(404);
	}

	public function create($lab)
	{

		$getLab = $this->getLab($lab);
		if($getLab){
			return view('admin.laboratorium.galery_add', [
				'title' => 'Add Galery | Laboratorium '.$getLab->nama_lab,
				'url' => URL_PATH.$lab.'/galery',
			]);
		}
		return abort(404);
	}

	public function store(Request $request,$lab)
	{
		$getLab = $this->getLab($lab);
		if($getLab){
			$profil = $getLab->profilLab->first();

			$validateData = $request->validate([
				'image'=> 'mimes:jpg,jpeg,png,svg,gif|image|max:2048|required',
				'title' => 'max:255|nullable'
			]);

			$validateData['profil_lab_id'] = $profil->id;
			$time = now()->timestamp;
			if ($request->file('image')) {
				$folder_path = FOLDER_PATH.$this->getFolderName($getLab->slug_lab).'/img/';
				$time = now()->timestamp.'-';
				$name = $time.$request->file('image')->getClientOriginalName();
				$validateData['image'] = $folder_path.$name;
				$request->file('image')->move(public_path().$folder_path, $name);
			}

			Galery::create($validateData);
			return redirect(URL_PATH.$lab.'/galery')->with('success', 'data berhasil di tambahkan!');
		}
		return abort(404);

	}

	public function show($id)
	{
		return abort(404);
	}

	public function edit($lab, Galery $galery)
	{
		$getLab = $this->getLab($lab);
		if($getLab){
			return view('admin.laboratorium.galery_edit', [
				'title' => 'Add Galery | Laboratorium '.$getLab->nama_lab,
				'data' => $galery,
				'url' => URL_PATH.$lab.'/galery',
			]);
		}
		return abort(404);
	}

	public function update(Request $request, $lab, Galery $galery)
	{
		$getLab = $this->getLab($lab);		
		if($getLab){			
			$validateData = $request->validate([
				'image'=> 'mimes:jpg,jpeg,png,svg,gif|image|max:2048|nullable',
				'title' => 'max:255|nullable'
			]);

			if ($request->file('image')) {
				$path = public_path().$galery->image;
				if (is_file($path)) {
					unlink($path);
				}

				$folder_path = FOLDER_PATH.$this->getFolderName($getLab->slug_lab).'/img/';
				$time = now()->timestamp.'-';
				$name = $time.$request->file('image')->getClientOriginalName();
				$validateData['image'] = $folder_path.$name;
				$request->file('image')->move(public_path().$folder_path, $name);
			}

			Galery::where('id', $galery->id)->update($validateData);
			return redirect(URL_PATH.$lab.'/galery')->with('success', 'data berhasil di edit!');
		}
		return abort(404);
	}

	public function destroy($lab, Galery $galery)
	{
		$getLab = $this->getLab($lab);
		if($getLab){
			$path = public_path().$galery->image;
			if (is_file($path)) {
				unlink($path);
			}

			Galery::destroy($galery->id);
			return redirect(URL_PATH.$lab.'/galery')->with('success', 'data berhasil di hapus!');
		}
		return abort(404);
	}
}
