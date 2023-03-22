<?php

namespace App\Http\Controllers;

use App\Models\Perlombaan;
use App\Models\AlumniKegiatan;
use App\Models\Penelitian;
use Illuminate\Http\Request;

class PerlombaanController extends Controller
{
	
	public function index(Request $request)
	{
		$category = ['mahasiswa', 'dosen', 'tendik'];
		if($request["s"]){
			return view('page.post_index', [
				'url' => route('perlombaan'),
				'all_data' => Perlombaan::latest()->filter(request(['category','search']))->paginate(10),
			]);
		}

		return view('layouts.main', [
			'title' => 'Perlombaan',
			'url' => route('perlombaan'),
			'ajax' => true,
			'view' => 'page.post_index',
			'all_data' => Perlombaan::latest()->filter(request(['category','search']))->paginate(10),
		]);
	}

	public function show(Perlombaan $perlombaan){
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
			'title' => 'Perlombaan | '.$perlombaan->title,
			'random' => $random,
			'url' => route('perlombaan'),
			'new' => $new,
			'show' =>true,
			'penelitian' => $penelitian,
			'data'=>$perlombaan
		 ]);
	}
}
