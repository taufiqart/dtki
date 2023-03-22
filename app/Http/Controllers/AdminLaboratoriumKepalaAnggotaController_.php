<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laboratorium;

class AdminLaboratoriumKepalaAnggotaController extends Controller
{
	public function get_array($lab)
	{
		$filename 	= array('posl.json','ibl.json','acl.json','icpl.json');
		$foldername = array('posl','ibl','acl','icpl');

		$data		= array(collect(Laboratorium::POSL()),collect(Laboratorium::IBL()),collect(Laboratorium::ACL()),collect(Laboratorium::ICPL()));
		$data_json	= array(Laboratorium::POSL(),Laboratorium::IBL(),Laboratorium::ACL(),Laboratorium::ICPL());
		$title		= array('Process Operating System Laboratory','Industrial Biotechnology Laboratory','Applied Chemistry Laboratory','Industrial Chemical Process Laboratory');

		$key = '';
		$key = $lab == '1' || $lab == 'process-operating-system-laboratory'?0:$key;
		$key = $lab == '2' || $lab == 'industrial-biotechnology-laboratory'?1:$key;
		$key = $lab == '3' || $lab == 'applied-chemistry-laboratory'?2:$key;
		$key = $lab == '4' || $lab == 'industrial-chemical-process-laboratory'?3:$key;

		$path = array(
			'default_img' 	=> '/img/foto.jpg',
			'img_path'		=> '/assets/laboratorium/',
			'url_path'		=> '/admin/lab/',
			'json_path'		=> '/json/laboratorium/'
		);
		return array(
			'key'			=> $key,
			'title'			=> $title[$key],
			'data'			=> $data[$key],
			'data_json'		=> $data_json[$key],
			'filename'		=> $filename[$key],
			'foldername'	=> $foldername[$key],
			'path'			=> $path
		);
	}
   
	public function index($lab)
	{
		$array = $this->get_array($lab);
		if($array["key"]!=''){
			$json = $array["data_json"];
			$kepala = null;
			foreach($json["anggota"] as $key => $data){
				if($data["category"] == '1'){
					$kepala = $data;
					$kepala += array('key'=>$key);
					$kepala["category"] = 'Kepala';
					unset($json["anggota"][$key]);
					break;
				}
			}
			foreach ($json["anggota"] as $key=>$value) {
				$json["anggota"][$key]["category"] = 'Anggota';
			}
			$anggota = $json["anggota"];
			return view('admin.laboratorium.kepala_anggota', [
				'title' => 'Kepala & Anggota | Laboratorium '.$array["title"],
				'kepala' => $kepala,
				'anggota' => $anggota,
				'count' => collect($array["data"]["anggota"]),
				'url_back' => $array["path"]["url_path"].$lab,
				'url' => $array["path"]["url_path"].$lab.'/kepala_anggota',
			]);
		}
	}

	public function create($lab)
	{
		$array = $this->get_array($lab);
		$kepala_lab = true;
		foreach ($array["data_json"]["anggota"] as $value) {
			if($value["category"] == '1'){
				$kepala_lab = false;
			}
		}
		if($array["key"]!=''){
			return view('admin.laboratorium.kepala_anggota_add',[
				'title' => 'Add Kepala & Anggota | Laboratorium '.$array["title"],
				'kepala_lab' => $kepala_lab,
				'url' => $array["path"]["url_path"].$lab.'/kepala_anggota',
			]);
		}
	}

	public function store(Request $request, $lab)
	{
		$validateData = $request->validate([
			'image'=> 'mimes:jpg,jpeg,png,svg,gif|image|max:2048|nullable',
			'nama' => 'required',
			'nip' => 'required',
			'email' => 'nullable',
			'jabatan' => 'nullable',
			'category' => 'required'
		]);

		$array = $this->get_array($lab);
		if($array["key"]!=''){
			$validateData['image'] = $array["path"]["default_img"];
			if ($request->file('image')) {
				$time = now()->timestamp.'-';
				$name = $time.$request->file('image')->getClientOriginalName();
				$validateData['image'] = $array["path"]["img_path"].$array["foldername"].'/img/'.$name;
				$request->file('image')->move(public_path().$array["path"]["img_path"].$array["foldername"].'/img/', $name);
			}
			$json = $array["data_json"];
			$json["anggota"] += array(count($json["anggota"])=>$validateData);
			// array_push($anggota,$validateData);
			// return dd($json);
			$update_json = json_encode($json);
			if(file_put_contents(storage_path().$array["path"]["json_path"].$array["filename"], $update_json)){
				return redirect($array["path"]["url_path"].$lab.'/kepala_anggota')->with('success', 'data berhasil di tambahkan');
			}
			return redirect($array["path"]["url_path"].$lab.'/kepala_anggota')->with('error', 'data gagal di tambahkan');
		}
	}

	public function show($lab,$kepala_anggotum)
	{
		//
	}

	public function edit($lab,$kepala_anggotum)
	{
		$array = $this->get_array($lab);
		$kepala_lab = true;
		foreach ($array["data_json"]["anggota"] as $value) {
			if($value["category"] == '1'){
				$kepala_lab = false;
			}
		}
		if($array["key"]!=''){
			$data = $array["data"]["anggota"][$kepala_anggotum];
			return view('admin.laboratorium.kepala_anggota_edit',[
				'title' => 'Edit Kepala & Anggota | Laboratorium '.$array["title"],
				'data' => $data,
				'kepala_lab' => $kepala_lab,
				'id' => $kepala_anggotum,
				'url' => $array["path"]["url_path"].$lab.'/kepala_anggota',
				// 'url_back' => $array["path"]["url_path"].$lab,
			]);
		}
	}

	public function update(Request $request, $lab,$kepala_anggotum)
	{

		$validateData = $request->validate([
			'image'=> 'mimes:jpg,jpeg,png,svg,gif|image|max:2048|nullable',
			'nama' => 'required',
			'nip' => 'required',
			'email' => 'nullable',
			'jabatan' => 'nullable',
			'category' => 'required'
		]);

		$array = $this->get_array($lab);
		$json = $array["data_json"];
		if($array["key"]!=''){
			$time = now()->timestamp;
			$validateData["image"] = $json["anggota"][$kepala_anggotum]["image"];
			if ($request->file('image')) {
				if($json["anggota"][$kepala_anggotum]["image"]!=$array["path"]["default_img"]){
					$path = public_path().$json["anggota"][$kepala_anggotum]["image"];
					if(is_file($path)){
						// return dd('unlink');
						unlink($path);
					}
				}
				$name = $time.'-'.$request->file('image')->getClientOriginalName();
				$validateData['image'] = $array["path"]["img_path"].$array["foldername"].'/img/'.$name;
				// return dd('uploaded',$validateData);
				$request->file('image')->move(public_path().$array["path"]["img_path"].$array["foldername"].'/img/', $name);
			}

			$json["anggota"][$kepala_anggotum]["image"] = $validateData["image"];
			$json["anggota"][$kepala_anggotum]["nama"] = $validateData["nama"];
			$json["anggota"][$kepala_anggotum]["nip"] = $validateData["nip"];
			$json["anggota"][$kepala_anggotum]["email"] = $validateData["email"];
			$json["anggota"][$kepala_anggotum]["jabatan"] = $validateData["jabatan"];
			$json["anggota"][$kepala_anggotum]["category"] = $validateData["category"];
			// return dd('success',$json);

			$update_json = json_encode($json);
			if(file_put_contents(storage_path().$array["path"]["json_path"].$array["filename"], $update_json)){
				return redirect($array["path"]["url_path"].$lab.'/kepala_anggota')->with('success', 'data berhasil di ubah');
			}
			return redirect($array["path"]["url_path"].$lab.'/kepala_anggota')->with('error', 'data gagal di ubah');
		}
	}

	public function destroy($lab,$kepala_anggotum)
	{

		$array = $this->get_array($lab);
		if($array["key"]!=''){
			$json = $array["data_json"];
			if($json["anggota"][$kepala_anggotum]["image"]!=$array["path"]["default_img"]){
				$path = public_path().$json["anggota"][$kepala_anggotum]["image"];
				if(is_file($path)){
					unlink($path);
				}
			}
			unset($json["anggota"][$kepala_anggotum]);
			$update_json = json_encode($json);
			if(file_put_contents(storage_path().$array["path"]["json_path"].$array["filename"], $update_json)){
				return redirect($array["path"]["url_path"].$lab.'/kepala_anggota')->with('success', 'data berhasil di hapus');
			}
			return redirect($array["path"]["url_path"].$lab.'/kepala_anggota')->with('error', 'data gagal di hapus');
		}
	}
}
