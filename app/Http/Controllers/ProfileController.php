<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileDepartemen;
use App\Models\dosenTendik;
use App\Models\Perlombaan;
use App\Models\AlumniKegiatan;
use App\Models\Penelitian;
use App\Models\Profil;
use App\Models\Kontak;

class ProfileController extends Controller
{
	public function departemen(){
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
		
		$data = Profil::filter(['category'=>'Departemen'])->first()??null;

		return view('page.profile.departemen',[
			'title' => 'Profile | Departemen',
			'owl' => true,
			// 'isi' => ProfileDepartemen::isi(),
			'kontak' => Kontak::first(),
			'data' => Profil::filter(['category'=>'Departemen'])->first()??null,
			'profile' => true,
			'random' => collect($random),
			'new' => collect($new),
			'penelitian' => $penelitian
		 ]);
	}

	public function dosen(){
		return view('page.profile.dosen',[
			'title' => 'Profile | Dosen',
			'data' => Profil::filter(['category'=>'Dosen'])->first()??null,
			'dosen' => dosenTendik::latest()->where('category', 'Dosen')->get(),
			'profile' => true
		 ]);
	}

	public function tendik(){
		return view('page.profile.tendik',[
			'title' => 'Profile | Tendik',
			'data' => Profil::filter(['category'=>'Tendik'])->first()??null,
			'tendik' => dosenTendik::latest()->where('category', 'Tendik')->get(),
			'profile' => true
		 ]);
	}
}
