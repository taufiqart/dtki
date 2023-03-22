<?php

namespace App\Http\Controllers;

use App\Models\AlumniKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Services\SlugService;

class AdminAlumniKegiatanController extends Controller
{
	public function index(Request $request)
	{
		if($request["s"]){
			return view('admin.alumni.kegiatan.index', [
				'url' => route('kegiatan.index'),
				'alumni_kegiatan' => AlumniKegiatan::latest()->filter(request(['search']))->paginate(10)
			]);
		}
		return view('admin.layouts.main', [
			'title' => 'Alumni Kegiatan',
			'url' => route('kegiatan.index'),
			'search' => true,
			'view' => 'admin.alumni.kegiatan.index',
			'alumni_kegiatan' => AlumniKegiatan::latest()->filter(request(['search']))->paginate(10)
			// 'data_alumni' => AlumniData::all()
		]);
	}

	public function create()
	{
		return view('admin.alumni.kegiatan.add', [
			'title' => 'Add | Alumni Kegiatan'
		]);
	}

	public function store(Request $request)
	{
		$validateData = $request->validate([
			'title' => 'required|max:255',
			'image'=> 'mimes:jpg,jpeg,png,svg,gif|image|max:2048|required',
			'body' => 'required'
			// 'user_id' => 'required',
		]);

		$slug = SlugService::createSlug(AlumniKegiatan::class, 'slug', $request['title']);

		if ($request->file('image')) {
			$time = now()->timestamp.'-';
			$name = $time.$request->file('image')->getClientOriginalName();
			$validateData['image'] = '/assets/alumni/kegiatan/img/'.$name;
			$request->file('image')->move(public_path().'/assets/alumni/kegiatan/img/', $name);
		}

		$validateData['slug'] = $slug;
		$validateData['excerpt'] = Str::limit(strip_tags($request->body), 100);
		// return $request;

		// return dd($validateData);
		AlumniKegiatan::create($validateData);

		return redirect(route('kegiatan.index'))->with('success', 'berhasill di tambahkan!');
	}

	public function show(AlumniKegiatan $kegiatan)
	{
		return abort(404);
	}

	public function edit(AlumniKegiatan $kegiatan)
	{
		// return dd(AlumniKegiatan::find(1));
		return view('admin.alumni.kegiatan.edit', [
			'title' => 'Edit | Alumni Kegiatan',
			'alumni_kegiatan' => $kegiatan
		]);
	}

	public function update(Request $request, AlumniKegiatan $kegiatan)
	{
		$rules = [
			'title' => 'required|max:255',
			'image'=> 'mimes:jpg,jpeg,png,svg,gif|image|max:2048|required',
			'body' => 'required',
			'slug' => 'unique:alumni_kegiatans,slug,'.$kegiatan->id
			// 'user_id' => 'required',
		];

		$slug = $kegiatan->slug;
		if ($request->title != $kegiatan->title) {
			$slug = SlugService::createSlug(AlumniKegiatan::class, 'slug', $request['title']);
		}

		$validateData = $request->validate($rules);


		if ($request->file('image')) {
			if ($kegiatan->image){
				$path = public_path().$kegiatan->image;
				if (is_file($path)) {
					unlink($path);
				}
			}
			$time = now()->timestamp.'-';
			$name = $time.$request->file('image')->getClientOriginalName();
			$validateData['image'] = '/assets/alumni/kegiatan/img/'.$name;
			$request->file('image')->move(public_path().'/assets/alumni/kegiatan/img/', $name);
		}

		$validateData['slug'] = $slug;
		$validateData['excerpt'] = Str::limit(strip_tags($request->body), 100);

		AlumniKegiatan::where('id', $kegiatan->id)->update($validateData);

		return redirect(route('kegiatan.index'))->with('success', 'berhasill di edit!');
	}

	public function destroy(AlumniKegiatan $kegiatan)
	{
		$path = public_path().$kegiatan->image;
		if (is_file($path)) {
			unlink($path);
		}

		AlumniKegiatan::destroy($kegiatan->id);
		return redirect(route('kegiatan.index'))->with('success', 'berhasil di hapus!');
	}
}
