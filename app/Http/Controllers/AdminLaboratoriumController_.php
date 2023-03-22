<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laboratorium;
use App\Models\Galerys;

class AdminLaboratoriumController extends Controller
{
	public function get_array($lab)
	{
		$action_check = ['deskripsi','kepala_anggota','galery'];

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
			'action_check'	=> $action_check,
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
		// $data = [Laboratorium::POSL(),Laboratorium::IBL(),Laboratorium::ACL(),Laboratorium::ICPL()];
		// $title = ['Process Operating System Laboratory','Industrial Biotechnology Laboratory','Applied Chemistry Laboratory','Industrial Chemical Process Laboratory'];
		
		$array = $this->get_array($lab);
		if($array["key"]!=''){
			return view('admin.laboratorium.index',[
				'title' => 'Laboratorium | '.$array["title"],
				'owl' => true,
				// 'url_deskripsi' => $array["path"]["url_path"].$lab.'/deskripsi',
				// 'url_kalab' => $array["path"]["url_path"].$lab.'/kepala_anggota',
				// 'url_galery' => $array["path"]["url_path"].$lab.'/galery',
				'url' => $array["path"]["url_path"].$lab,
				// 'url_back' => '/admin/lab/'.$lab,
				'url_view' => '/laboratorium/'.$lab
			]);
		}

		// return abort(404);
		return redirect('/admin/lab/1');

	}

	public function show($lab,$action)
	{
		// return dd($action);
		$array = $this->get_array($lab);

		if(in_array($action,$array["action_check"]) && $array["key"] != ''){
			if($action == $array["action_check"][0]){
				return view('admin.laboratorium.deskripsi', [
					'title' => 'Deskripsi | Laboratorium '.$array["title"],
					'deskripsi' => $array["data"]["deskripsi"],
					'url_back' => '/admin/lab/'.$lab,
					'url_edit' => '/admin/lab/'.$lab.'/'.$action.'/edit',
				]);
			}
			if($action == $array["action_check"][1]){
				$kepala = [];
	            $anggota = [];

	            $check = true;
	            foreach($array["data"]["anggota"] as $ka){
	                if($ka["category"] == 1 && $check == true){
	                    $kepala = $ka;
	                    $check = false;
	                }else{
	                    array_push($anggota, $ka);
	                }
	            }

	            // return dd($anggota);
				return view('admin.laboratorium.kepala_anggota', [
					'title' => 'Deskripsi | Laboratorium '.$array["title"],
					'kepala' => $kepala,
					'anggota' => $anggota,
					'count' => collect($array["data"]["anggota"]),
					'url_back' => '/admin/lab/'.$lab,
					'url' => '/admin/lab/'.$lab.'/'.$action,
				]);
			}
		}

		return redirect('/admin/lab/1/deskripsi');
	}


	public function create($lab,$action){
		$array = $this->get_array($lab);

		if(in_array($action,$array["action_check"]) && $array["key"]!=''){
			if($action == $array["action_check"][1]){
				return view('admin.laboratorium.kepala_anggota_add',[
					'title' => 'Deskripsi | Laboratorium '.$array["title"],
					'url' => '/admin/lab/'.$lab.'/'.$action,
					'url_back' => '/admin/lab/'.$lab,
				]);
			}
		}
	}
	public function store(Request $request,$lab,$action){
		return dd($request->request);
	}
	public function edit($lab,$action,$id=null)
	{
		// return dd($action);

		$array = $this->get_array($lab);

		if(in_array($action,$array["action_check"]) && $array["key"]!=''){
			if($action == $array["action_check"][0]){
				return view('admin.laboratorium.deskripsi_edit', [
					'title' => 'Edit Deskripsi | Laboratorium '.$array["title"],
					'deskripsi' => $array["data"]["deskripsi"],
					'url' => '/admin/lab/'.$lab.'/'.$action,
				]);
			}
			if($action == $array["action_check"][1]){
				$get_data = [];
				foreach ($array["data"]["anggota"] as $nip) {
				    if($nip["nip"] == $id){
				    	$get_data = $nip;
				    }
				}
				return view('admin.laboratorium.kepala_anggota_edit', [
					'title' => 'Deskripsi | Laboratorium '.$array["title"],
					'data' => $get_data,
					'url' => '/admin/lab/'.$lab.'/'.$action,
					'url_back' => '/admin/lab/'.$lab,
				]);
			}
		}

		// return abort(404);
		return redirect('/admin/lab/1/deskripsi/edit');
	}
	


	public function update($lab,$action,Request $request)
	{
		$array = $this->get_array($lab);

		if(in_array($action,$array["action_check"]) && $array["key"]!=''){
			if($action == $array["action_check"][0]){
				$json = $array["data_json"];
				// return dd($json["deskripsi"]["title"] = "tes");
				$json["deskripsi"]["title"] = $request->title;
				$json["deskripsi"]["body"] = $request->body;
				$update_json = json_encode($json);
				if(file_put_contents(storage_path()."/json/laboratorium/".$array["filename"], $update_json)){
					return redirect('/admin/lab/'.$lab.'/'.$action)->with('success', 'Deskripsi berhasil di ubah');
				}
				return redirect('/admin/lab/'.$lab.'/'.$action)->with('error', 'Deskripsi gagal di ubah');
			}
			if($action == $array["action_check"][1]){
				$kepala = [];
	            $anggota = [];

	            $check = true;
	            foreach($array["data"]["anggota"] as $ka){
	                if($ka["category"] == 1 && $check == true){
	                    $kepala = $ka;
	                    $check = false;
	                }else{
	                    array_push($anggota, $ka);
	                }
	            }

				return view('admin.laboratorium.kepala_anggota_edit', [
					'title' => 'Deskripsi | Laboratorium '.$array["title"],
					'kepala' => $kepala,
					'anggota' => $anggota,
					'url' => '/admin/lab/'.$lab.'/'.$action,
					'url_back' => '/admin/lab/'.$lab,
				]);
			}
			return dd($lab,$action);
		}
		if ($request->file('img')) {
			$image = explode('/',$request->image);
			$chekOldImg = [end($image)];
			foreach($request["galery-image"] as $galery){
				$image = explode('/',$galery);
				array_push($chekOldImg,end($image));
			}

			foreach($request->oldImage as $oldImage){
				if ($oldImage != null || $oldImage != '') {
					$img = explode('/',$oldImage);
					$check = in_array(end($img), $chekOldImg);
					if($check == false){
						$path = public_path().'/assets/profile/departemen/img/'.end($img);
						unlink($path);
					}
				}
			}

			$allowedExtension = ['jpg','ico','jpeg','png','svg'];
			foreach($request->img as $newImage){
				$imgName = $newImage->getClientOriginalName();
				$imgExtension = $newImage->getClientOriginalExtension();
				$imgSize = $newImage->getSize();
				if($imgSize <= 2048){               
					return redirect('/admin/profile/departemen/edit')->with('error', 'max image size 2mb');
				}
				$check = in_array($imgExtension, $allowedExtension);
				if($check){
					$newImage->move(public_path().'/assets/profile/departemen/img/', $imgName);
				}else{
					return redirect('/admin/profile/departemen/edit')->with('error', 'image extension not allowed');
				}
			}
		}

		$sosmed = [];
		foreach($request['sosmed-title'] as $key=>$index){
			$arrSosmed = [
				'title' => $request['sosmed-title'][$key],
				'url' => $request['sosmed-url'][$key],
				'icon' => $request['sosmed-icon'][$key]
			];
			array_push($sosmed, $arrSosmed);
		}

		$isiFoto = explode('/',$request->image);
		$isi = [
			'title' => $request->title,
			'foto' => '/assets/profile/departemen/img/'.end($isiFoto),
			'text' => $request->body,
			'alamat' => $request->alamat,
			'telepon' => $request->telepon,
			'email' => $request->email,
			'website' => $request->website,
			'sosmed' => $sosmed,
		];
		$galerys = [];
		foreach($request['galery-title'] as $key=>$insert){
			$foto = explode('/',$request['galery-image'][$key]);
			$galery = [
				"title" => $request['galery-title'][$key],
				"foto" => '/assets/profile/departemen/img/'.end($foto),
			];
			array_push($galerys, $galery);
		}
		$json = json_encode(array('galerys'=>$galerys,'isi'=>$isi));
		if(file_put_contents(storage_path()."/json/Labor.json", $json)){
			return redirect('/admin/profile/departemen')->with('success', 'Profile Departemen berhasil di ubah');
		}
		return dd($json);
	}

}
