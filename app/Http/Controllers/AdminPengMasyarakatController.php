<?php

namespace App\Http\Controllers;

use App\Models\PengMasyarakat;
use Illuminate\Http\Request;

class AdminPengMasyarakatController extends Controller
{
	public function index(Request $request)
	{
		if($request["s"]){
			return view('admin.peng-masyarakat.index', [
				'peng_masyarakat' => PengMasyarakat::latest()->filter(request(['category','search']))->paginate(10),
			]);
		}
		return view('admin.layouts.main', [
			'title' => 'Pengabdian Masyarakat',
			'url' => route('peng-masyarakat.index'),
			'search' => true,
			'category' => true,
			'view' => 'admin.peng-masyarakat.index',
			'peng_masyarakat' => PengMasyarakat::latest()->filter(request(['category','search']))->paginate(10)
		]);
	}

	public function create()
	{
		return view('admin.peng-masyarakat.add', [
			'title' => 'Add | Pengabdian Masyarakat'
		]);
	}

	public function store(Request $request)
	{
		$request['waktu'] = $request['waktu']?date('d M Y', strtotime($request->waktu)):null;
		$validateData = $request->validate([
			'nama' => 'required|max:255',
			'judul' => 'required',
			'tempat' => 'required',
			'waktu' => 'nullable',
			'category' => 'required',
		]);

		PengMasyarakat::create($validateData);

		return redirect(route('peng-masyarakat.index'))->with('success', 'data berhasill di tambahkan!');
		return dd($request->request);
	}

	public function show(PengMasyarakat $peng_masyarakat)
	{
		//
	}

	public function edit(PengMasyarakat $peng_masyarakat)
	{
		$peng_masyarakat->waktu = $peng_masyarakat->waktu?date('Y-m-d', strtotime($peng_masyarakat->waktu)):null;

		return view('admin.peng-masyarakat.edit', [
			'title' => 'Edit | Pengabdian Masyarakat',
			'peng_masyarakat' => $peng_masyarakat
		]);
	}

	public function update(Request $request, PengMasyarakat $peng_masyarakat)
	{
		$request['waktu'] = $request['waktu']?date('d M Y', strtotime($request->waktu)):null;
		$validateData = $request->validate([
			'nama' => 'required',
			'judul' => 'required',
			'tempat' => 'required',
			'waktu' => 'nullable',
			'category' => 'required',
		]);
		PengMasyarakat::where('id', $peng_masyarakat->id)->update($validateData);
		return redirect(route('peng-masyarakat.index'))->with('success', 'data berhasill di edit!');
	}

	public function destroy(PengMasyarakat $peng_masyarakat)
	{
		PengMasyarakat::destroy($peng_masyarakat->id);
		return redirect(route('peng-masyarakat.index'))->with('success', 'berhasil di hapus!');
	}
}
