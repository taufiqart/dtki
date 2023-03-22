<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlumniData;
use App\Models\AlumniKegiatan;
use App\Models\Perlombaan;
use App\Models\Penelitian;

class AlumniController extends Controller
{
	public function data_alumni(Request $request)
	{
		if($request["s"]){
			return view('page.data-alumni', [
				'data_alumni' => AlumniData::latest()->filter(request(['tahun','search']))->paginate(10)
			]);
		}
		$tahun = [];
		foreach(AlumniData::all() as $data){
			if(!in_array($data->tahun, $tahun)){
				array_push($tahun, $data->tahun);
			}
		}
		rsort($tahun);
		return view('layouts.main', [
			'title' => 'Data Alumni',
			'tahun' => $tahun,
			'filter' => true,
			'ajax' => true,
			'view' => 'page.data-alumni',
			'url' => route('data_alumni'),
			'data_alumni' => AlumniData::latest()->filter(request(['tahun','search']))->paginate(10)
		]);
	}

	// public function data_alumni_ajax()
	// {
	// 	return view('page.data-alumni_data', [
	// 		'data_alumni' => AlumniData::latest()->filter(request(['tahun','search']))->paginate(10)
	// 	]);
	// }

	public function kegiatan(Request $request)
	{
		if($request["s"]){
			return view('page.post_index', [
				'url' => route('alumni_kegiatan'),
				'all_data' => AlumniKegiatan::latest()->filter(request(['search']))->paginate(10)
			]);
		}
		return view('layouts.main', [
			'title' => 'Alumni Kegiatan',
			'url' => route('alumni_kegiatan'),
			'ajax' => true,
			'view' => 'page.post_index',
			'first' => AlumniKegiatan::latest()->filter(request(['search']))->first(),
			'all_data' => AlumniKegiatan::latest()->filter(request(['search']))->paginate(10)
		]);
	}

	// public function kegiatan_ajax()
	// {
	// 	return view('page.kegiatan_data', [
	// 		'kegiatan' => AlumniKegiatan::latest()->filter(request(['search']))->paginate(10)
	// 	]);
	// }

	public function kegiatan_show(AlumniKegiatan $kegiatan)
	{
		// return $kegiatan;
		
		$random = [];

		$rperlombaan = Perlombaan::inRandomOrder()->limit(6)->get();
		foreach($rperlombaan as $p){
			array_push($random,$p);
		}
		$rkegiatan = AlumniKegiatan::inRandomOrder()->limit(6)->get();
		foreach($rkegiatan as $k){
			array_push($random,$k);
		}
		shuffle($random);
		$random = array_slice($random,6);

		// new post
		$new = [];		
		$nperlombaan = Perlombaan::latest()->take(3)->get();
		foreach($nperlombaan as $key=>$p){
			$new += array(strtotime($p->updated_at)+$key=>$p);
		}
		$nkegiatan = AlumniKegiatan::latest()->take(3)->get();
		foreach($nkegiatan as $key=>$k){
			$new += array(strtotime($k->updated_at)+$key=>$k);
		}
		krsort($new);
		array_pop($new);
		
		$penelitian = Penelitian::latest()->take(3)->get();

		return view('page.post_show',[
			'title' => 'Kegiatan | '.$kegiatan->title,
			'random' => $random,
			'url' => route('alumni_kegiatan'),
			'new' => $new,
			'show' =>true,
			'penelitian' => $penelitian,
			'data'=> $kegiatan
		 ]);

	}
}
