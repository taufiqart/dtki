<?php

namespace App\Http\Controllers;

use App\Models\dosenTendik;
use Illuminate\Http\Request;
// use Illuminate\Container\Validation\Validator;

class AdminDosenTendikController extends Controller
{
	public function index(Request $request)
	{
		if($request["s"]){
			return view('admin.dosenTendik.index', [
				'url' => route('dosen_tendik.index'),
				'dosen_tendik' => dosenTendik::latest()->filter(request(['category','search']))->paginate(10)
			]);
		}
		return view('admin.layouts.main', [
			'title' => 'Dosen & Tendik',
			'url' => route('dosen_tendik.index'),
			'search' => true,
			'category' => true,
			'view' => 'admin.dosenTendik.index',
			'dosen_tendik' => dosenTendik::latest()->filter(request(['category','search']))->paginate(10)
		]);
		return view('admin.dosenTendik.index',[
			'title' => 'Dosen & Tendik',
			'dosen_tendik' => dosenTendik::latest()->filter(request(['category','search']))->paginate(10)
		]);
	}

	public function create()
	{
		return view('admin.dosenTendik.add',[
			'title' => 'Add | Dosen & Tendik'
			// 'datas' => dosenTendik::all()
		]);
	}

	public function store(Request $request)
	{
		// $time = date('Y-m-d H-i-s', time());
		$time = now()->timestamp.'-';
		// dd($request);
		$validateData = $request->validate([
			'nama'=>'required',
			'nip'=>'required|unique:dosen_tendiks,nip',
			'email'=> 'nullable',
			'jabatan'=> 'nullable',
			'profil_sinta'=> 'nullable',
			'profil_scholar'=> 'nullable',
			'image'=> 'mimes:jpg,jpeg,png,svg,gif|image|max:2048|nullable',
			'profil_file'=> 'mimes:pdf|max:2048|nullable',
			'category'=> 'nullable',
			// 'user_id' => 'required',
		]);
		// return dd($validateData);
		if ($request->file('image')) {
			$name = $time.$request->file('image')->getClientOriginalName();
			$validateData['image'] = '/assets/dosen_tendik/img/'.$name;
			$request->file('image')->move(public_path().'/assets/dosen_tendik/img/', $name);
		}
		if ($request->file('profil_file')){
			$name = $time.$request->file('profil_file')->getClientOriginalName();
			$validateData['profil_file'] = '/assets/dosen_tendik/file/'.$name;
			$request->file('profil_file')->move(public_path().'/assets/dosen_tendik/file/', $name);
		}

		// return $request;
		// return dd($validateData);
		dosenTendik::create($validateData);
		return redirect(route('dosen_tendik.index'))->with('success', 'data berhasil di tambahkan');
		// dosenTendik::insert($datas);
	}

	public function show($id)
	{
		return abort(404);
	}

	public function edit(dosenTendik $dosenTendik)
	{
		$filename = '';
		if($dosenTendik['profil_file'] != ''){
			$name = explode('/',$dosenTendik['profil_file']);
			$filename = end($name);
		}
		
		return view('admin.dosenTendik.edit',[
			'title' => 'Edit | Dosen & Tendik',
			'filename' => $filename,
			'dosen_tendik' => $dosenTendik
		]);
	}

	public function update(Request $request, dosenTendik $dosenTendik)
	{
		$time = now()->timestamp.'-';

		$validateData = $request->validate([
			'nama'=>'required',
			'nip'=>'required|unique:dosen_tendiks,nip,'.$dosenTendik->id,
			'email'=> 'nullable',
			'jabatan'=> 'nullable',
			'profil_sinta'=> 'nullable',
			'profil_scholar'=> 'nullable',
			'image'=> 'mimes:jpg,jpeg,png,svg,gif|image|max:2048|nullable',
			'profil_file'=> 'mimes:pdf|max:2048|nullable',
			'category'=> 'nullable',
			// 'user_id' => 'required',
		]);
		// return dd($validateData);
		if ($request->file('image')) {
			if($dosenTendik->image){
				$image = public_path().$dosenTendik->image;
				if (is_file($image)) {
					unlink($image);
				}
			}
			$name = $time.$request->file('image')->getClientOriginalName();
			$validateData['image'] = '/assets/dosen_tendik/img/'.$name;
			$request->file('image')->move(public_path().'/assets/dosen_tendik/img/', $name);
		}
		if ($request->file('profil_file')){
			if($dosenTendik->profil_file){
				$file = public_path().$dosenTendik->profil_file;
				if (is_file($file)) {
					unlink($file);
				}
			}
			$name = $time.$request->file('profil_file')->getClientOriginalName();
			$validateData['profil_file'] = '/assets/dosen_tendik/file/'.$name;
			$request->file('profil_file')->move(public_path().'/assets/dosen_tendik/file/', $name);
		}

		// if ($request['category'] == 'Tendik'){
		// 	if($request['oldFile']){
		// 	// dd($request['oldFile']);
		// 		$file = public_path().$dosenTendik->profil_file;
		// 		// dd($file);
		// 		if (is_file($file)) {
		// 			unlink($file);
		// 			$validateData['profil_file'] = null;
		// 		}
		// 	}
		// }

		// return $request;
		// return dd($validateData);
		dosenTendik::where('id', $dosenTendik->id)->update($validateData);
		return redirect(route('dosen_tendik.index'))->with('success', 'data berhasil di edit!');
	}

	public function destroy(dosenTendik $dosenTendik)
	{
		// return file_exists($dosenTendik->profile_file);
		$image = public_path().$dosenTendik->image;
		$file = public_path().$dosenTendik->profil_file;
		if (is_file($image)) {
			unlink($image);
		}
		if (is_file($file)) {
			unlink($file);
		}

		dosenTendik::destroy($dosenTendik->id);
		return redirect(route('dosen_tendik.index'))->with('success', 'data berhasil di hapus!');
	}
}
