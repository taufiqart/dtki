<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laboratorium;
use App\Models\ProfilLab;
use App\Models\KepalaAnggotaLab;
use App\Models\LaboratoriumKegiatan;

define('URL_PATH', '/admin/lab/');
define('URL_VIEW', '/laboratorium/');
class AdminLaboratoriumController extends Controller
{
	public function index($lab)
	{
		// return dd(LaboratoriumKegiatan::first()->categoryKegiatan);
		// return dd(ProfilLab::first()->galery);
		$getLab = Laboratorium::where('id',$lab)->orWhere('slug_lab',$lab)->first();
		if($getLab){

			return view('admin.laboratorium.index',[
				'title' => 'Laboratorium | '.$getLab->nama_lab,
				'url' => URL_PATH.$lab,
				'url_view' => URL_VIEW.$lab
			]);

			return $getLab;
		}
		return abort(404);
		// $profilLab = $getLab->profilLab->first();
		// return dd($getLab->kegiatan->where('category_id',2));
		// return dd($getLab->kepalaAnggotaLab);
		// return dd($profilLab,$profilLab->galery,$getLab->kepalaAnggotaLab);
		// return $lab;
	}
}
