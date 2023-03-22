<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LaboratoriumKegiatan;
use App\Models\Laboratorium;
use App\Models\CategoryKegiatan;
use App\Models\Category;


define('URL_PATH', '/laboratorium/');
define('URL_VIEW', '/laboratorium/');
define('FOLDER_PATH','/assets/laboratorium/');

class LaboratoriumController extends Controller
{
	public function getLab($lab)
	{		
		return Laboratorium::where('id',$lab)->orWhere('slug_lab',$lab)->first();
	}

	public function index($lab)
	{
		$getLab = $this->getLab($lab);
		if($getLab){
			$profil = $getLab->profilLab->first();

			$kepala = $getLab->kepalaAnggotaLab->first();
			$anggota = $getLab->kepalaAnggotaLab->skip(1);

			return view('page.laboratorium',[
				'title' => 'Laboratorium | '.$getLab->nama_lab,
				'laboratorium' => true,
				'owl' => true,
				'galerys' => $profil->galery,
				'anggota' => $anggota,
				'kepala' => $kepala,
				'data' => $profil,
				'url' => URL_PATH.$lab,
				'url_home' => URL_PATH.$lab,
				'category_kegiatan' => CategoryKegiatan::all(),
			]);
		}
		return redirect(URL_PATH.$this->getLab(1)->slug_lab);
	}

	public function kegiatan(Request $request, $lab,$kegiatan)
	{
		$getLab = $this->getLab($lab);
		if($getLab){
			$kepala = $getLab->kepalaAnggotaLab->first();
			$anggota = $getLab->kepalaAnggotaLab->skip(1);
			$category_kegiatan = CategoryKegiatan::where('slug_c',$kegiatan)->first();
			if($category_kegiatan){
				if($request["s"]){
					return view('page.laboratorium.kegiatan', [
						'url' => URL_PATH.$lab.'/'.$kegiatan,
						'kegiatan' => LaboratoriumKegiatan::latest()->filter(array('lab'=>$getLab->id,'kegiatan'=>$kegiatan,'category'=>request('category'),'search'=>request('search')))->paginate(10),
					]);
				}
				return view('layouts.main',[
					'title' => $category_kegiatan->nama_c.' | Laboratorium '.$getLab->nama_lab,
					'url' => URL_PATH.$lab,
					'url_home' => URL_PATH.$lab,
					'category_kegiatan' => CategoryKegiatan::all(),
					'ajax' => true,
					'view' => 'page.laboratorium.kegiatan',
					'kegiatan_lab' => true,
					'filter' => true,
					'category' => true,
					'anggota' => $anggota,
					'kepala' => $kepala,
					'kegiatan' => LaboratoriumKegiatan::latest()->filter(array('lab'=>$getLab->id,'kegiatan'=>$kegiatan,'category'=>request('category'),'search'=>request('search')))->paginate(10),
				]);
			}
		}
		return redirect(URL_PATH.$this->getLab(1)->slug_lab);
	}
}
