<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laboratorium;
use App\Models\ProfilLab;


define('URL_PATH', '/admin/lab/');
define('URL_VIEW', '/laboratorium/');
define('FOLDER_PATH','/assets/laboratorium/');
// define('FOLDER_NAME',array('posl','ibl','acl','icpl'));

class AdminLaboratoriumDeskripsiController extends Controller
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
			$profil = $getLab->profilLab->first();
			return view('admin.laboratorium.deskripsi', [
				'title' => 'Deskripsi | Laboratorium '.$getLab->nama_lab,
				'data' => $profil,
				'url' => URL_PATH.$lab.'/deskripsi',
				'url_view' => URL_VIEW.$lab,
				'url_back' => URL_PATH.$lab,
			]);
		}
		return abort(404);
	}
	
	public function edit($lab)
	{
		$getLab = $this->getLab($lab);
		if($getLab){
			$profil = $getLab->profilLab->first();
			return view('admin.laboratorium.deskripsi_edit', [
				'title' => 'Edit Deskripsi | Laboratorium '.$getLab->nama_lab,
				'data' => $profil,
				'url' => URL_PATH.$lab.'/deskripsi',
			]);			
		}
		return abort(404);
	}

	public function update(Request $request, $lab)
	{
		$getLab = $this->getLab($lab);
		if($getLab){
			$profil = $getLab->profilLab->first();
			
			$validateData = $request->validate([
				'title' => 'nullable',
				'image' => 'nullable',
				'deskripsi' => 'nullable'
			]);
			
			if($request->remove_img){
				$path = public_path().$profil->image;
				if(is_file($path)){
					unlink($path);
				}
				$validateData['image'] = null;
			}

			$validateData['laboratorium_id'] = $getLab->id;
			if ($request->file('image')) {
				$path = public_path().$profil->image;
				if(is_file($path)){
					unlink($path);
				}
				$time = now()->timestamp.'-';
				$name = $time.$request->file('image')->getClientOriginalName();
				$validateData['image'] = FOLDER_PATH.$this->getFolderName($getLab->slug_lab).'/img/'.$name;
				$request->file('image')->move(public_path().FOLDER_PATH.$this->getFolderName($getLab->slug_lab).'/img/', $name);
			}

			ProfilLab::where('id', $profil->id)->update($validateData);
			return redirect(URL_PATH.$lab.'/deskripsi')->with('success', 'data berhasil di ubah');	
			return dd($validateData);

		}
		return abort(404);
	}
}
