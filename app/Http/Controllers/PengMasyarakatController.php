<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengMasyarakat;

class PengMasyarakatController extends Controller
{
   public function index(Request $request)
	{
		$category = ['mahasiswa', 'dosen', 'tendik'];
		if($request["s"]){
			return view('page.peng-masyarakat', [
				'peng_masyarakat' => PengMasyarakat::latest()->filter(request(['category','search']))->paginate(10),
			]);
		}

		return view('layouts.main', [
			'title' => 'Pengabdian Masyarakat',
			'url' => route('peng_masyarakat'),
			'ajax' => true,
			'view' => 'page.peng-masyarakat',
			'peng_masyarakat' => PengMasyarakat::latest()->filter(request(['category','search']))->paginate(10),
		]);
	}
}
