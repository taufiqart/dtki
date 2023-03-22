<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laboratorium;
use Symfony\Component\HttpFoundation\Response;

class AdminLaboratoriumGaleryController extends Controller
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
			return view('admin.laboratorium.galery', [
				'title' => 'Galery | Laboratorium '.$array["title"],
				'galery' => collect($array["data"]["galerys"]),
				'url_back' => $array["path"]["url_path"].$lab,
				'url' => $array["path"]["url_path"].$lab.'/galery',
			]);
		}
	}

	public function create($lab)
	{
		$array = $this->get_array($lab);
		// return dd($array["data"]["galerys"]);
		if($array["key"]!=''){
			return view('admin.laboratorium.galery_add', [
				'title' => 'Galery | Laboratorium '.$array["title"],
				'galery' => collect($array["data"]["galerys"]),
				// 'url_back' => $array["path"]["url_path"].$lab,
				'url' => $array["path"]["url_path"].$lab.'/galery',
			]);
		}
	}

	public function store(Request $request,$lab)
	{
		$array = $this->get_array($lab);

		$validateData = $request->validate([
			'image'=> 'mimes:jpg,jpeg,png,svg,gif|image|max:2048|required',
			'title' => 'nullable'
		]);

		if($array["key"]!=''){
			$time = now()->timestamp;
			$validateData['image'] = null;
			if ($request->file('image')) {
				$name = $time.'-'.$request->file('image')->getClientOriginalName();
				$validateData['image'] = $array["path"]["img_path"].$array["foldername"].'/img/'.$name;
				$request->file('image')->move(public_path().$array["path"]["img_path"].$array["foldername"].'/img/', $name);
			}
			$json = $array["data_json"];
			$json["galerys"] += array($time=>$validateData);

			$update_json = json_encode($json);
			if(file_put_contents(storage_path().$array["path"]["json_path"].$array["filename"], $update_json)){
				return redirect($array["path"]["url_path"].$lab.'/galery')->with('success', 'data berhasil di tambahkan');
			}
			return redirect($array["path"]["url_path"].$lab.'/galery')->with('error', 'data gagal di tambahkan');
		}
	}

	public function show($id)
	{
		//
	}

	public function edit($lab, $galery)
	{
		$array = $this->get_array($lab);
		// return dd($array["data"]["galerys"][$galery]);

		if($array["key"]!=''){
			return view('admin.laboratorium.galery_edit', [
				'title' => 'Edit Galery | Laboratorium '.$array["title"],
				'data' => $array["data_json"]["galerys"][$galery],
				'key' => $galery,
				// 'url_back' => $array["path"]["url_path"].$lab,
				'url' => $array["path"]["url_path"].$lab.'/galery',
			]);
		}
	}

	public function update(Request $request, $lab, $galery)
	{
		// return dd($request);
		$array = $this->get_array($lab);

		$validateData = $request->validate([
			'image'=> 'mimes:jpg,jpeg,png,svg,gif|image|max:2048|nullable',
			'title' => 'nullable'
		]);

		if($array["key"]!=''){
			$json = $array["data_json"];

			$time = now()->timestamp;
			$validateData["image"] = $json["galerys"][$galery]["image"];
			if ($request->file('image')) {
				if($json["galerys"][$galery]["image"]){
					$path = public_path().$json["galerys"][$galery]["image"];
					if(is_file($path)){
						unlink($path);
					}
				}
				$name = $time.'-'.$request->file('image')->getClientOriginalName();
				$validateData['image'] = $array["path"]["img_path"].$array["foldername"].'/img/'.$name;
				$request->file('image')->move(public_path().$array["path"]["img_path"].$array["foldername"].'/img/', $name);
			}
			$json["galerys"][$galery]["image"] = $validateData["image"];
			$json["galerys"][$galery]["title"] = $validateData["title"];
			// return dd($json);

			$update_json = json_encode($json);
			if(file_put_contents(storage_path().$array["path"]["json_path"].$array["filename"], $update_json)){
				return redirect($array["path"]["url_path"].$lab.'/galery')->with('success', 'data berhasil di ubah');
			}
			return redirect($array["path"]["url_path"].$lab.'/galery')->with('error', 'data gagal di ubah');
		}
	}

	public function destroy($lab, $galery)
	{
		$array = $this->get_array($lab);
		if($array["key"]!=''){
			$json = $array["data_json"];
			if($json["galerys"][$galery]["image"]){
				$path = public_path().$json["galerys"][$galery]["image"];
				if(is_file($path)){
					unlink($path);
				}
			}
			unset($json["galerys"][$galery]);
			$update_json = json_encode($json);
			if(file_put_contents(storage_path().$array["path"]["json_path"].$array["filename"], $update_json)){
				return redirect($array["path"]["url_path"].$lab.'/galery')->with('success', 'data berhasil di hapus');
			}
			return redirect($array["path"]["url_path"].$lab.'/galery')->with('error', 'data gagal di hapus');
		}
	}
}
