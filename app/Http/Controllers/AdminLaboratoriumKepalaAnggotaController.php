<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laboratorium;
use App\Models\KepalaAnggotaLab;

define('ROLE_NAME', 'Kepala Lab');
define('URL_PATH', '/admin/lab/');
define('URL_VIEW', '/laboratorium/');
define('DEFAULT_IMG','/img/foto.jpg');
define('FOLDER_PATH','/assets/laboratorium/');
// define('FOLDER_NAME',array('posl','ibl','acl','icpl'));

class AdminLaboratoriumKepalaAnggotaController extends Controller
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

			return view('admin.laboratorium.kepala_anggota', [
				'title' => 'Kepala & Anggota | Laboratorium '.$getLab->nama_lab,
				'kepalaAnggota' => $getLab->kepalaAnggotaLab,
				'url_back' => URL_PATH.$lab,
				'url' => URL_PATH.$lab.'/kepala_anggota',
			]);
		}
		return abort(404);
	}

	public function create($lab)
	{
		$getLab = $this->getLab($lab);
		if($getLab){

			$kepala_lab = false;
			foreach ($getLab->kepalaAnggotaLab as $data) {
				if($data->role_name == ROLE_NAME){
					$kepala_lab = true;
					break;
				}
			}
			return view('admin.laboratorium.kepala_anggota_add',[
				'title' => 'Add Kepala & Anggota | Laboratorium '.$getLab->nama_lab,
				'kepala_lab' => $kepala_lab,
				'url' => URL_PATH.$lab.'/kepala_anggota',
			]);
		}
		return abort(404);
	}

	public function store(Request $request, $lab)
	{
		$getLab = $this->getLab($lab);
		if($getLab){
			$validateData = $request->validate([
				'image'=> 'mimes:jpg,jpeg,png,svg,gif|image|max:2048|nullable',
				'nama' => 'required',
				'nip' => 'required',
				'email' => 'nullable',
				'jabatan' => 'nullable',
				'role_name' => 'required'
			]);

			$validateData['laboratorium_id'] = $getLab->id;
			$validateData['image'] = DEFAULT_IMG;
			if ($request->file('image')) {
				$time = now()->timestamp.'-';
				$name = $time.$request->file('image')->getClientOriginalName();
				$validateData['image'] = FOLDER_PATH.$this->getFolderName($getLab->slug_lab).'/img/'.$name;
				$request->file('image')->move(public_path().FOLDER_PATH.$this->getFolderName($getLab->slug_lab).'/img/', $name);
			}

			KepalaAnggotaLab::create($validateData);
			return redirect(URL_PATH.$lab.'/kepala_anggota')->with('success', 'data berhasil di tambahkan');
		}
		return abort(404);
	}

	public function show($lab,$kepala_anggotum)
	{
		return abort(404);
	}

	public function edit($lab, KepalaAnggotaLab $kepala_anggotum)
	{
		$getLab = $this->getLab($lab);
		if($getLab){
			$kepala_lab = false;
			foreach ($getLab->kepalaAnggotaLab as $data) {
				if($data->role_name == ROLE_NAME && $kepala_anggotum->role_name != ROLE_NAME){
					$kepala_lab = true;
					break;
				}
			}

			return view('admin.laboratorium.kepala_anggota_edit',[
				'title' => 'Edit Kepala & Anggota | Laboratorium '.$getLab->nama_lab,
				'data' => $kepala_anggotum,
				'kepala_lab' => $kepala_lab,
				'url' => URL_PATH.$lab.'/kepala_anggota',
			]);
		}
		return abort(404);
	}

	public function update(Request $request, $lab,KepalaAnggotaLab $kepala_anggotum)
	{

		$getLab = $this->getLab($lab);
		if($getLab){

			$validateData = $request->validate([
				'image'=> 'mimes:jpg,jpeg,png,svg,gif|image|max:2048|nullable',
				'nama' => 'required',
				'nip' => 'required',
				'email' => 'nullable',
				'jabatan' => 'nullable',
				'role_name' => 'required'
			]);

			$validateData['laboratorium_id'] = $getLab->id;
			if ($request->file('image')) {
				$path = $kepala_anggotum->image != DEFAULT_IMG?public_path().$kepala_anggotum->image:'';
				if(is_file($path)){
					unlink($path);
				}
				$time = now()->timestamp.'-';
				$name = $time.$request->file('image')->getClientOriginalName();
				$validateData['image'] = FOLDER_PATH.$this->getFolderName($getLab->slug_lab).'/img/'.$name;
				$request->file('image')->move(public_path().FOLDER_PATH.$this->getFolderName($getLab->slug_lab).'/img/', $name);
			}

			KepalaAnggotaLab::where('id', $kepala_anggotum->id)->update($validateData);
			return redirect(URL_PATH.$lab.'/kepala_anggota')->with('success', 'data berhasil di edit');
		}
		return abort(404);
	}

	public function destroy($lab, KepalaAnggotaLab $kepala_anggotum)
	{
		$getLab = $this->getLab($lab);
		if($getLab){
			$path = $kepala_anggotum->image != DEFAULT_IMG?public_path().$kepala_anggotum->image:'';
			if(is_file($path)){
				unlink($path);
			}
			
			KepalaAnggotaLab::destroy($kepala_anggotum->id);
			return redirect(URL_PATH.$lab.'/kepala_anggota')->with('success', 'data berhasil di hapus!');
		}
		return abort(404);
	}
}
