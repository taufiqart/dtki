<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penelitian;

class PenelitianController extends Controller
{
	public function index(Request $request)
	{
		$category = ['mahasiswa', 'dosen', 'tendik'];
		if(in_array(strtolower($request->category), $category)){
			if($request["s"]){
				return view('page.penelitian', [
					'penelitian' => Penelitian::latest()->filter(request(['category','search']))->paginate(10),
				]);
			}
			return view('layouts.main', [
				'title' => 'Penelitian | '.ucfirst($request->category),
				'url' => route('penelitian'),
				'ajax' => true,
				'view' => 'page.penelitian',
				'penelitian' => Penelitian::latest()->filter(request(['category','search']))->paginate(10),
			]);
		}

		return view('layouts.main', [
			'title' => 'Penelitian',
			'url' => route('penelitian'),
			'ajax' => true,
			'view' => 'page.penelitian',
			'penelitian' => Penelitian::latest()->filter(request(['category','search']))->paginate(10),
		]);
	}
	public function show(Penelitian $penelitian){

		return view('page.penelitian_show', [
			'title' => 'Penelitian | '.$penelitian->judul,
			'url' => route('penelitian'),
			'penelitian' => $penelitian,
			'show' =>true,
			'posts' => Penelitian::latest()->take(5)->get()
		]);
	}
}
