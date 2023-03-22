<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laboratorium;

class AdminLaboratoriumDeskripsiController extends Controller
{
	public function get_array($lab)
	{
		$filename   = array('posl.json','ibl.json','acl.json','icpl.json');
		$foldername = array('posl','ibl','acl','icpl');

		$data       = array(collect(Laboratorium::POSL()),collect(Laboratorium::IBL()),collect(Laboratorium::ACL()),collect(Laboratorium::ICPL()));
		$data_json  = array(Laboratorium::POSL(),Laboratorium::IBL(),Laboratorium::ACL(),Laboratorium::ICPL());
		$title      = array('Process Operating System Laboratory','Industrial Biotechnology Laboratory','Applied Chemistry Laboratory','Industrial Chemical Process Laboratory');

		$key = '';
		$key = $lab == '1' || $lab == 'process-operating-system-laboratory'?0:$key;
		$key = $lab == '2' || $lab == 'industrial-biotechnology-laboratory'?1:$key;
		$key = $lab == '3' || $lab == 'applied-chemistry-laboratory'?2:$key;
		$key = $lab == '4' || $lab == 'industrial-chemical-process-laboratory'?3:$key;

		$path = array(
			'default_img'   => '/img/foto.jpg',
			'img_path'      => '/assets/laboratorium/',
			'url_path'      => '/admin/lab/',
			'json_path'     => '/json/laboratorium/'
		);
		return array(
			'key'           => $key,
			'title'         => $title[$key],
			'data'          => $data[$key],
			'data_json'     => $data_json[$key],
			'filename'      => $filename[$key],
			'foldername'    => $foldername[$key],
			'path'          => $path
		);
	}
   
	public function index($lab)
	{
		$array = $this->get_array($lab);
		if($array["key"]!=''){
			return view('admin.laboratorium.deskripsi', [
				'title' => 'Deskripsi | Laboratorium '.$array["title"],
				'deskripsi' => $array["data"]["deskripsi"],
				'url' => $array["path"]["url_path"].$lab.'/deskripsi',
				'url_view' => '/laboratorium/'.$lab,
				'url_back' => $array["path"]["url_path"].$lab,
			]);
		}
	}
	
	public function edit($lab)
	{
		$array = $this->get_array($lab);
		if($array["key"]!=''){
			return view('admin.laboratorium.deskripsi_edit', [
				'title' => 'Deskripsi | Laboratorium '.$array["title"],
				'deskripsi' => $array["data"]["deskripsi"],
				'url' => $array["path"]["url_path"].$lab.'/deskripsi',
			]);
		}
	}

	public function update(Request $request, $lab)
	{
		$array = $this->get_array($lab);

		$validateData = $request->validate([
			'title' => 'nullable',
			'body' => 'nullable'
		]);

		if($array["key"]!=''){
			$json = $array["data_json"];

			// $time = now()->timestamp;
			// $validateData["image"] = $json["deskripsi"][$galery]["image"];
			// if ($request->file('image')) {
			// 	if($json["deskripsi"][$galery]["image"]){
			// 		$path = public_path().$json["deskripsi"][$galery]["image"];
			// 		if(is_file($path)){
			// 			unlink($path);
			// 		}
			// 	}
			// 	$name = $time.'-'.$request->file('image')->getClientOriginalName();
			// 	$validateData['image'] = $array["path"]["img_path"].$array["foldername"].'/img/'.$name;
			// 	$request->file('image')->move(public_path().$array["path"]["img_path"].$array["foldername"].'/img/', $name);
			// }
			$json["deskripsi"] = $validateData;
			// return dd($json);

			$update_json = json_encode($json);
			if(file_put_contents(storage_path().$array["path"]["json_path"].$array["filename"], $update_json)){
				return redirect($array["path"]["url_path"].$lab.'/deskripsi')->with('success', 'data berhasil di ubah');
			}
			return redirect($array["path"]["url_path"].$lab.'/deskripsi')->with('error', 'data gagal di ubah');
		}
	}
}
