<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaboratoriumKegiatan;
class AdminLaboratoriumKegiatanController extends Controller
{
	public function get_array($lab)
	{

		$title		= array('Process Operating System Laboratory','Industrial Biotechnology Laboratory','Applied Chemistry Laboratory','Industrial Chemical Process Laboratory');

		$key = '';
		$key = $lab == '1' || $lab == 'process-operating-system-laboratory'?0:$key;
		$key = $lab == '2' || $lab == 'industrial-biotechnology-laboratory'?1:$key;
		$key = $lab == '3' || $lab == 'applied-chemistry-laboratory'?2:$key;
		$key = $lab == '4' || $lab == 'industrial-chemical-process-laboratory'?3:$key;

		$path = array(
			'default_img' 	=> '/img/foto.jpg',
			'img_path'		=> '/assets/laboratorium/',
			'url_path'		=> '/admin/lab/',
		);
		return array(
			'key'			=> $key,
			'title'			=> $title[$key],
			'path'			=> $path
		);
	}

	public function index(Request $request, $lab, $kegiatan)
	{
		$array = $this->get_array($lab);
		$kegiatan_check = ['penelitian','praktikum','proyek-akhir','pengujian','perlombaan'];
		if(in_array($kegiatan,$kegiatan_check)){
			if($request["s"]){
				if(in_array($kegiatan,$kegiatan_check)){
					return view('admin.laboratorium.kegiatan.index', [
						'url' => $array["path"]["url_path"].$lab.'/'.$kegiatan,
						'kegiatan' => LaboratoriumKegiatan::latest()->filter(array('lab'=>intval($array["key"]),'kegiatan'=>$kegiatan,'category'=>request('category'),'search'=>request('search')))->paginate(10),
					]);
				}
			}
			return view('admin.layouts.main',[
				'title' => ucfirst($kegiatan).' | Laboratorium '.$array["title"],
				'url' => $array["path"]["url_path"].$lab.'/'.$kegiatan,
				'url_back' => $array["path"]["url_path"].$lab,
				'search' => true,
				'category' => true,
				'view' => 'admin.laboratorium.kegiatan.index',
				'kegiatan' => LaboratoriumKegiatan::latest()->filter(array('lab'=>intval($array["key"]),'kegiatan'=>$kegiatan,'category'=>request('category'),'search'=>request('search')))->paginate(10),
			]);
		}
		return redirect($array["path"]["url_path"].$lab);
	}

	public function create($lab, $kegiatan)
	{
		$array = $this->get_array($lab);
		$kegiatan_check = ['penelitian','praktikum','proyek-akhir','pengujian','perlombaan'];
		if(in_array($kegiatan,$kegiatan_check)){
			return view('admin.laboratorium.kegiatan.add', [
				'title' => 'Add '.ucfirst($kegiatan).' | Laboratorium '.$array["title"],
				'url' => $array["path"]["url_path"].$lab.'/'.$kegiatan,
			]);
		}
		return redirect($array["path"]["url_path"].$lab);
	}

	public function store(Request $request, $lab, $kegiatan)
	{
		// return dd($request);
		$array = $this->get_array($lab);
		$kegiatan_check = ['penelitian','praktikum','proyek-akhir','pengujian','perlombaan'];
		if(in_array($kegiatan,$kegiatan_check)){
			$request['waktu'] = $request['waktu']?date('d M Y', strtotime($request->waktu)):null;

			$validateData = $request->validate([
				'nama' => 'required',
				'nip' => 'required',
				'judul' => 'nullable',
				'waktu' => 'nullable',
				'category' => 'nullable',
			]);
			$validateData["lab"] = $array["key"];
			$validateData["kegiatan"] = $kegiatan;
			LaboratoriumKegiatan::create($validateData);
			return redirect($array["path"]["url_path"].$lab.'/'.$kegiatan)->with('success', 'data berhasill di tambahkan!');
		}
		return redirect($array["path"]["url_path"].$lab.'/'.$kegiatan);
		return dd($validateData);
	}

	public function edit($lab, $kegiatan, LaboratoriumKegiatan $id)
	{
		// return dd($kegiatan,$id);
		$array = $this->get_array($lab);
		$kegiatan_check = ['penelitian','praktikum','proyek-akhir','pengujian','perlombaan'];
		if(in_array($kegiatan,$kegiatan_check)){
			$id->waktu = $id->waktu?date('Y-m-d', strtotime($id->waktu)):null;

			return view('admin.laboratorium.kegiatan.edit', [
				'title' => 'Edit '.ucfirst($kegiatan).' | Laboratorium '.$array["title"],
				'data' => $id,
				'url' => $array["path"]["url_path"].$lab.'/'.$kegiatan,
			]);
		}
		return redirect($array["path"]["url_path"].$lab.'/'.$kegiatan);
		return dd($kegiatan,$id);
	}

	public function update(Request $request, $lab, $kegiatan, LaboratoriumKegiatan $id)
	{
		$array = $this->get_array($lab);
		$kegiatan_check = ['penelitian','praktikum','proyek-akhir','pengujian','perlombaan'];
		if(in_array($kegiatan,$kegiatan_check)){
			$request['waktu'] = $request['waktu']?date('d M Y', strtotime($request->waktu)):null;

			$validateData = $request->validate([
				'nama' => 'required',
				'nip' => 'required',
				'judul' => 'nullable',
				'waktu' => 'nullable',
				'category' => 'nullable',
			]);

			LaboratoriumKegiatan::where('id', $id->id)->update($validateData);

			return redirect($array["path"]["url_path"].$lab.'/'.$kegiatan)->with('success', 'data berhasill di edit!');

		}
		return redirect($array["path"]["url_path"].$lab.'/'.$kegiatan);
		return dd($kegiatan,$id);
	}

	public function destroy($lab, $kegiatan, LaboratoriumKegiatan $id)
	{
		$array = $this->get_array($lab);
		LaboratoriumKegiatan::destroy($id->id);
		return redirect($array["path"]["url_path"].$lab.'/'.$kegiatan)->with('success', 'berhasil di hapus!');
	}
}
