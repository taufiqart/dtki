<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perlombaan;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Services\SlugService;

class AdminPerlombaanController extends Controller
{
	public function index(Request $request)
	{
		// return dd(Perlombaan::all());
		if($request["s"]){
			return view('admin.perlombaan.index', [
				'url' => route('perlombaan.index'),
				'perlombaan' => Perlombaan::latest()->filter(request(['category','search']))->paginate(10)
			]);
		}
		return view('admin.layouts.main', [
			'title' => 'Perlombaan',
			'url' => route('perlombaan.index'),
			'search' => true,
			'category' => true,
			'view' => 'admin.perlombaan.index',
			'perlombaan' => Perlombaan::latest()->filter(request(['category','search']))->paginate(10)
		]);
	}

	public function create()
	{
		return view('admin.perlombaan.add', [
			'title' => 'Add | Perlombaan'
		]);
	}

	public function store(Request $request)
	{

		$validateData = $request->validate([
			'title' => 'required|max:255',
			'category' => 'required',
			'image'=> 'mimes:jpg,jpeg,png,svg,gif|image|max:2048|required',
			'body' => 'required'
		]);

		$slug = SlugService::createSlug(Perlombaan::class, 'slug', $request['title']);

		if ($request->file('image')) {
			$time = now()->timestamp.'-';
			$name = $time.$request->file('image')->getClientOriginalName();
			$validateData['image'] = '/assets/perlombaan/img/'.$name;
			$request->file('image')->move(public_path().'/assets/perlombaan/img/', $name);
		}

		$validateData['slug'] = $slug;
		$validateData['excerpt'] = Str::limit(strip_tags($request->body), 100);

		Perlombaan::create($validateData);

		return redirect(route('perlombaan.index'))->with('success', 'berhasill di tambahkan!');
	}

	public function show($id)
	{
		return abort(404);
	}

	public function edit(Perlombaan $perlombaan)
	{
		return view('admin.perlombaan.edit', [
			'title' => 'Edit | Perlombaan',
			'perlombaan' => $perlombaan
		]);
	}

	public function update(Request $request, Perlombaan $perlombaan)
	{
		// return dd(is_file($perlombaan->image));

		$rules = [
			'title' => 'required|max:255',
			'category' => 'required',
			'image'=> 'mimes:jpg,jpeg,png,svg,gif|image|max:2048|nullable',
			'body' => 'required',
			'slug' => 'unique:perlombaans,slug,'.$perlombaan->id
		];

		$slug = $perlombaan->slug;
		if ($request->title != $perlombaan->title) {
			$slug = SlugService::createSlug(Perlombaan::class, 'slug', $request['title']);
		}

		$validateData = $request->validate($rules);

		if ($request->file('image')) {
			if ($perlombaan->image){
				$path = public_path().$perlombaan->image;
				if (is_file($path)) {
					unlink($path);
				}
				
			}
			$time = now()->timestamp.'-';
			$name = $time.$request->file('image')->getClientOriginalName();
			$validateData['image'] = '/assets/perlombaan/img/'.$name;
			$request->file('image')->move(public_path().'/assets/perlombaan/img/', $name);
		}

		$validateData['slug'] = $slug;
		$validateData['excerpt'] = Str::limit(strip_tags($request->body), 100);

		Perlombaan::where('id', $perlombaan->id)->update($validateData);

		return redirect(route('perlombaan.index'))->with('success', 'berhasill di edit!');	
	}

	public function destroy(Perlombaan $perlombaan)
	{
		$path = public_path().$perlombaan->image;
		if (is_file($path)) {
			unlink($path);
		}

		Perlombaan::destroy($perlombaan->id);
		return redirect(route('perlombaan.index'))->with('success', 'berhasil di hapus!');
	}

}
