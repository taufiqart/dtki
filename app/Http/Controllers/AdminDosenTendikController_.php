<?php

namespace App\Http\Controllers;

use App\Models\dosenTendik;
use Illuminate\Http\Request;
// use Illuminate\Container\Validation\Validator;
use Validator;
class AdminDosenTendikController extends Controller
{
	public function index(dosenTendik $dosenTendik)
	{
		return view('admin.dosenTendik.index',[
			'title' => 'Dosen & Tendik',
			'datas' => dosenTendik::all()
		]);
	}

	public function create()
	{
		return view('admin.dosenTendik.add_1',[
			'title' => 'Add | Dosen & Tendik'
			// 'datas' => dosenTendik::all()
		]);
	}

	public function store(Request $request)
	{
		// dd($request);
		$this->validate($request, [
			'nama.*'=>'required',
			// 'nip.*'=>'required|unique:dosen_tendiks',
			'email.*'=> 'present|string|nullable',
			'jabatan.*'=> 'present|string|nullable',
			'profil_sinta.*'=> 'present|string|nullable',
			'profil_scholar.*'=> 'present|string|nullable',
			'image.*'=> 'mimes:jpg,jpeg,png,ico,svg,gif|image|max:2048',
			'profil_file.*'=> 'mimes:pdf|max:2048',
			'category.*'=> 'present',
		]);
		$datas = [];
		$imgFile = array();
		$pdfFile = array();
		foreach($request['nama'] as $key=>$index){
			$img = null;
			$file = null;
			if($request->file('image')){
				if(!empty($request->file('image')[$key])){
					$image = $request->file('image')[$key];
					$name = $image->getClientOriginalName();
					$size = $image->getSize();

					if($size <= 0){
						return redirect('/admin/dosen_tendik/create')->with('error', $name.' max image size 2mb');
					}
					$allowedExtension = ['jpg','ico','jpeg','png','svg'];
					$ext = $image->getClientOriginalExtension();
					$checkExt = in_array($ext, $allowedExtension);
					if($checkExt){
						// array_push($imgFile, $image);
						$img = $image;
					}else{
						return redirect('/admin/dosen_tendik/create')->with('error', $name.' image extension not allowed');
					}
				}
			}
			if($request->file('profil-pdf')){
				if(!empty($request->file('profil-pdf')[$key])){
					$pdf = $request->file('profil-pdf')[$key];
					$name = $pdf->getClientOriginalName();
					$size = $pdf->getSize();

					if($size <= 0){
						return redirect('/admin/dosen_tendik/create')->with('error', $name.' max file size 2mb');
					}
					$checkExt = $pdf->getClientOriginalExtension();
					if($checkExt == 'pdf'){
						// array_push($pdfFile, $image);
						$file = $image;
					}else{
						return redirect('/admin/dosen_tendik/create')->with('error', $name.' file extension not allowed');
					}
				}
			}

			$data = [
				'nama'=>$request['nama'][$key],
				'nip'=>$request['nip'][$key],
				'email'=>$request['email'][$key],
				'jabatan'=>$request['jabatan'][$key],
				'profil_sinta'=>$request['profil-sinta'][$key],
				'profil_scholar'=>$request['profil-scholar'][$key],
				'image'=>$img,
				'profil_file'=>$file,
				'category'=>$request['category'][$key]
			];

			$valid = Validator::make($data,[
				'nama'=>'required',
				'nip'=>'required|unique:dosen_tendiks',
				'email'=> 'present|string|nullable',
				'jabatan'=> 'present|string|nullable',
				'profil_sinta'=> 'present|string|nullable',
				'profil_scholar'=> 'present|string|nullable',
				'image'=> 'mimes:jpg,jpeg,png,ico,svg,gif|image|max:2048',
				'profil_file'=> 'mimes:pdf|max:2048',
				'category'=> 'present',
			]);

			array_push($datas,$data);
		}
		// return dd($imgFile[0]);
		// foreach($imgFile as $image){
		// 	if($image != null || !empty($image)){
		// 		$name = $image->getClientOriginalName();
		// 		$image->move(public_path().'/assets/dosen_tendik/img', $name);
		// 	}
		// }
		// foreach($pdfFile as $pdf){
		// 	if($image != null || !empty($pdf)){
		// 		$name = $pdf->getClientOriginalName();
		// 		$pdf->move(public_path().'/assets/dosen_tendik/file', $name);
		// 	}
		// }
		dosenTendik::insert($datas);
		return redirect('/admin/dosen_tendik')->with('success', 'Data berhasil di tambahkan');
	}

	public function show($id)
	{
		//
	}

	public function edit(dosenTendik $dosenTendik)
	{
		$filename = '';
		if($dosenTendik->profile_file){
			$filename = explode('/',$dosenTendik);
			$filename = end($filename);
		}
		return view('admin.dosenTendik.edit',[
			'title' => 'Edit | Dosen & Tendik',
			'filename' => $filename,
			'data' => $dosenTendik
		]);
	}

	public function update(Request $request, $id)
	{
		//
	}

	public function destroy(dosenTendik $dosenTendik)
	{
		if (file_exists($dosenTendik->image)) {
			unlink($dosenTendik->image);
		}
		if (file_exists($dosenTendik->profile_file)) {
			unlink($dosenTendik->profile_file);
		}

		dosenTendik::destroy($dosenTendik->id);
		return redirect('/admin/dosen_tendik')->with('success', 'data has been deleted!');
	}
}
