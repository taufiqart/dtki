<?php

namespace App\Http\Controllers;

use App\Models\Penelitian;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class AdminPenelitianController extends Controller
{
	public function index(Request $request)
	{
		if($request["s"]){
			return view('admin.penelitian.index', [
				'penelitian' => Penelitian::latest()->filter(request(['category','search']))->paginate(10),
			]);
		}
		return view('admin.layouts.main', [
			'title' => 'Penelitian',
			'url' => route('penelitian.index'),
			'search' => true,
			'category' => true,
			'view' => 'admin.penelitian.index',
			'penelitian' => Penelitian::latest()->filter(request(['category','search']))->paginate(10)
		]);
	}

	public function create()
	{
		return view('admin.penelitian.add', [
			'title' => 'Add | Penelitian'
		]);
	}

	public function store(Request $request)
	{
		$validateData = $request->validate([
			'nama' => 'required|max:255',
			'judul' => 'required',
			'publikasi' => 'required|max:255',
			'tahun' => 'nullable',
			'abstract' => 'nullable',
			'file' => 'mimes:pdf|max:2048|nullable',
			'category' => 'required',
		]);

		$slug = SlugService::createSlug(Penelitian::class, 'slug', $request['judul']);

		if ($request->file('file')) {
			$time = now()->timestamp.'-';
			$name = $time.$request->file('file')->getClientOriginalName();
			$validateData['file'] = '/assets/penelitian/file/'.$name;
			$request->file('file')->move(public_path().'/assets/penelitian/file/', $name);
		}

		$validateData['slug'] = $slug;
		// return $request;

		// return dd($validateData);
		Penelitian::create($validateData);

		return redirect(route('penelitian.index'))->with('success', 'data berhasill di tambahkan!');
	}

	public function show(Penelitian $penelitian)
	{
		//
	}

	public function edit(Penelitian $penelitian)
	{
		$filename = '';
		if($penelitian['file'] != ''){
			$name = explode('/',$penelitian['file']);
			$filename = end($name);
		}

		return view('admin.penelitian.edit', [
			'title' => 'Edit | Penelitian',
			'filename' => $filename,
			'penelitian' => $penelitian
		]);
	}

	public function update(Request $request, Penelitian $penelitian)
	{
		$rules = [
			'nama' => 'required|max:255',
			'judul' => 'required',
			'publikasi' => 'required|max:255',
			'tahun' => 'nullable',
			'abstract' => 'nullable',
			'file' => 'mimes:pdf|max:2048|nullable',
			'category' => 'required',
			'slug' => 'unique:penelitians,slug,'.$penelitian->id
		];

		$slug = $penelitian->slug;
		if ($request->judul != $penelitian->judul) {
			$slug = SlugService::createSlug(Penelitian::class, 'slug', $request['judul']);
		}

		$validateData = $request->validate($rules);

		if ($request->file('file')) {
			if ($penelitian->image){
				$path = public_path().$penelitian->image;
				if (is_file($path)) {
					unlink($path);
				}
			}
			$time = now()->timestamp.'-';
			$name = $time.$request->file('file')->getClientOriginalName();
			$validateData['file'] = '/assets/penelitian/file/'.$name;
			$request->file('file')->move(public_path().'/assets/penelitian/file/', $name);
		}

		$validateData['slug'] = $slug;
		// return $request;

		// return dd($validateData);
		Penelitian::where('id', $penelitian->id)->update($validateData);
		return redirect(route('penelitian.index'))->with('success', 'data berhasill di edit!');

	}

	public function destroy(Penelitian $penelitian)
	{
		$path = public_path().$penelitian->file;
		if (is_file($path)) {
			unlink($path);
		}

		Penelitian::destroy($penelitian->id);
		return redirect(route('penelitian.index'))->with('success', 'berhasil di hapus!');
	}
}
