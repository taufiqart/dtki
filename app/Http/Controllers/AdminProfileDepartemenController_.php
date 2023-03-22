<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileDepartemen;

class AdminProfileDepartemenController extends Controller
{
	public function index()
	{
		
		return view('admin.profile.departemen.index',[
			'title' => 'Profile | Departemen',
			'owl' => true,
			'galerys' => ProfileDepartemen::galerys(),
			'isi' => ProfileDepartemen::isi(),
		]);
	}

	public function create()
	{
		return abort(404);
	}

	public function store(Request $request)
	{
		//
	}

	public function show($id)
	{
		return abort(404);
	}

	public function edit()
	{
		return view('admin.profile.departemen.edit',[
			'title' => 'Edit Profile | Departemen',
			'owl' => true,
			'galerys' => ProfileDepartemen::galerys(),
			'isi' => ProfileDepartemen::isi()
		]);
	}

	public function update(Request $request)
	{
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
		if(file_put_contents(storage_path()."/json/ProfileDepartemen.json", $json)){
			return redirect(route('adm_profile_departemen'))->with('success', 'Profile Departemen berhasil di ubah');
		}
		return dd($json);
	}

	public function destroy($id)
	{
		//
	}
}
