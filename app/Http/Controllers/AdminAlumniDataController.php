<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlumniData;

class AdminAlumniDataController extends Controller
{
	public function index(Request $request)
	{
		$tahun = [];
		foreach(AlumniData::all() as $data){
			if(!in_array($data->tahun, $tahun)){
				array_push($tahun, $data->tahun);
			}
		}
		rsort($tahun);

		if($request["s"]){
			return view('admin.alumni.data-alumni.index', [
				'url' => route('data-alumni.index'),
				'data_alumni' => AlumniData::latest()->filter(request(['tahun','search']))->paginate(10)
			]);
		}
		return view('admin.layouts.main', [
			'title' => 'Data Alumni',
			'tahun' => $tahun,
			'url' => route('data-alumni.index'),
			'search' => true,
			'view' => 'admin.alumni.data-alumni.index',
			'data_alumni' => AlumniData::latest()->filter(request(['tahun','search']))->paginate(10)
		]);
	}

	public function create()
	{
		return view('admin.alumni.data-alumni.add', [
			'title' => 'Add | Data Alumni'
		]);
	}

	public function store(Request $request)
	{
		$data = [
			'nama' => $request->nama,
			'pekerjaan' => $request->pekerjaan,
			'alamat' => $request->alamat,
			'no' => $request->no,
			'tahun' => $request->tahun,
		];
		AlumniData::create($data);
		return redirect(route('data-alumni.index'))->with('success', 'data berhasil di tambahkan!');
	}

	public function show($id)
	{
		return abort(404);
	}

	public function edit(AlumniData $data_alumnus)
	{
		return view('admin.alumni.data-alumni.edit', [
			'title' => 'Edit | Data Alumni',
			'data_alumni' => $data_alumnus
		]);
	}

	public function update(Request $request, AlumniData $data_alumnus)
	{
		$data = [
			'nama' => $request->nama,
			'pekerjaan' => $request->pekerjaan,
			'alamat' => $request->alamat,
			'no' => $request->no,
			'tahun' => $request->tahun,
		];

		AlumniData::where('id', $data_alumnus->id)->update($data);
		return redirect(route('data-alumni.index'))->with('success', 'data berhasil di edit!');
	}

	public function destroy(AlumniData $data_alumnus)
	{
		AlumniData::destroy($data_alumnus->id);
		return redirect(route('data-alumni.index'))->with('success', 'data berhasil di hapus!');
	}
}
