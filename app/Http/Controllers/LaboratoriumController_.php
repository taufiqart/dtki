<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaboratoriumKegiatan;
use App\Models\Laboratorium;

class LaboratoriumController extends Controller
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
			'url_path'      => '/laboratorium/',
			'json_path'     => '/json/laboratorium/'
		);
		return array(
			'action_check'  => $action_check,
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
		// $url = ['process-operating-system-laboratory','industrial-biotechnology-laboratory','applied-chemistry-laboratory','industrial-chemical-process-laboratory'];
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
			return view('page.laboratorium',[
				'title' => 'Laboratorium | '.$array["title"],
				'owl' => true,
				'laboratorium' => true,
				'owl' => true,
				'galerys' => $json["galerys"],
				'anggota' => $anggota,
				'kepala' => $kepala,
				'deskripsi' => $json["deskripsi"],
				'url' => $array["path"]["url_path"].$lab,
				'url_home' => $array["path"]["url_path"].$lab,
			]);
		}
		// return abort(404);
		return redirect('/laboratorium/process-operating-system-laboratory');
	}

	public function kegiatan(Request $request, $lab,$kegiatan)
	{

		$array = $this->get_array($lab);
		$kegiatan_check = ['penelitian','praktikum','proyek-akhir','pengujian','perlombaan'];
		if(in_array($kegiatan,$kegiatan_check)){
			if($request["s"]){
				if(in_array($kegiatan,$kegiatan_check)){
					return view('page.laboratorium.kegiatan', [
						'kegiatan' => LaboratoriumKegiatan::latest()->filter(array('lab'=>intval($array["key"]),'kegiatan'=>$kegiatan,'category'=>request('category'),'search'=>request('search')))->paginate(10),
					]);
				}
			}
			return view('layouts.main',[
				'title' => ucfirst($kegiatan).' | Laboratorium '.$array["title"],
				'url' => $array["path"]["url_path"].$lab.'/'.$kegiatan,
				'url_home' => $array["path"]["url_path"].$lab,
				'ajax' => true,
				'view' => 'page.laboratorium.kegiatan',
				'kegiatan_lab' => true,
				'filter' => true,
				'category' => true,
				'kegiatan' => LaboratoriumKegiatan::latest()->filter(array('lab'=>intval($array["key"]),'kegiatan'=>$kegiatan,'category'=>request('category'),'search'=>request('search')))->paginate(10),
			]);
		}
		return redirect($array["path"]["url_path"].$lab);
	}
}
