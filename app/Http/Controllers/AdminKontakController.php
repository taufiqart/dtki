<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontak;
use App\Models\ProfileDepartemen;

class AdminKontakController extends Controller
{
	public function index()
	{
		return view('admin.kontak.index',[
			'title' => 'Kontak',			
			'isi' => ProfileDepartemen::isi(),
			'data' => Kontak::first(),
			'url' => route('adm_kontak')

		]);
	}

	public function edit()
	{
		return view('admin.kontak.edit',[
			'title' => 'Kontak',			
			'isi' => ProfileDepartemen::isi(),
			'data' => Kontak::first(),
			'url' => route('adm_kontak')
		]);
	}

	public function update(Request $request)
	{
		$sosmed = [];
		foreach($request['sosmed-title'] as $key=>$index){
			$arrSosmed = [
				'title' => $request['sosmed-title'][$key],
				'url' => $request['sosmed-url'][$key],
				'icon' => $request['sosmed-icon'][$key]
			];
			array_push($sosmed, $arrSosmed);
		}

		$validateData = [
			'alamat' => $request->alamat,
			'telepon' => $request->telepon,
			'email' => $request->email,
			'website' => $request->website,
			'media_sosial' => $sosmed,
		];

		if(Kontak::first()){			
			Kontak::first()->update($validateData);
		}
		else{
			Kontak::create($validateData);
		}
		return redirect(route('adm_kontak'))->with('success', 'data berhasill di edit!');
	}

}
