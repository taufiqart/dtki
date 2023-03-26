<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaboratoriumKegiatan;
use App\Models\Laboratorium;
use App\Models\CategoryKegiatan;
use App\Models\Category;


define('URL_PATH', '/admin/lab/');
define('URL_VIEW', '/laboratorium/');
define('FOLDER_PATH','/assets/laboratorium/');

class AdminLaboratoriumKegiatanController extends Controller
{

	public function getLab($lab)
	{		
		return Laboratorium::where('id',$lab)->orWhere('slug_lab',$lab)->first();
	}

	public function index(Request $request, $lab, $kegiatan)
	{
		// return dd($kegiatan);
		$getLab = $this->getLab($lab);
		if($getLab){
			
			$category_kegiatan = CategoryKegiatan::where('slug_c',$kegiatan)->first();

			if($request["s"]){
				if($category_kegiatan){
					return view('admin.laboratorium.kegiatan.index', [
						'url' => URL_PATH.$lab.'/'.$kegiatan,
						'kegiatan' => LaboratoriumKegiatan::latest()->filter(array('lab'=>$getLab->id,'kegiatan'=>$kegiatan,'category'=>request('category'),'search'=>request('search')))->paginate(10),
					]);
				}
			}
				return view('admin.layouts.main',[
					'title' => $category_kegiatan->nama_c.' | Laboratorium '.$getLab->nama_lab,
					'url' => URL_PATH.$lab.'/'.$kegiatan,
					'url_back' => URL_PATH.$lab,
					'search' => true,
					'category' => true,
					'view' => 'admin.laboratorium.kegiatan.index',
					'kegiatan' => LaboratoriumKegiatan::latest()->filter(array('lab'=>$getLab->id,'kegiatan'=>$kegiatan,'category'=>request('category'),'search'=>request('search')))->paginate(10),
				]);
		}
		return abort(404);
	}

	public function create($lab, $kegiatan)
	{
		$getLab = $this->getLab($lab);
		if($getLab){
			$category_kegiatan = CategoryKegiatan::where('slug_c',$kegiatan)->first();
			if($category_kegiatan){
				return view('admin.laboratorium.kegiatan.add', [
					'title' => 'Add '.$category_kegiatan->nama_c.' | Laboratorium '.$getLab->nama_lab,
					'url' => URL_PATH.$lab.'/'.$kegiatan,
					'categorys' => Category::all()->where('nama','!=','Departemen')
				]);
			}
		}
		return abort(404);
	}

	public function store(Request $request, $lab, $kegiatan)
	{

		$getLab = $this->getLab($lab);
		if($getLab){
			$category_kegiatan = CategoryKegiatan::where('slug_c',$kegiatan)->first();
			if($category_kegiatan){
				$request['waktu'] = $request['waktu']?date('d M Y', strtotime($request->waktu)):null;
				$request['category_id'] = intval($request['category_id']);
				$validateData = $request->validate([
					'nama' => 'required',
					'nip' => 'required',
					'judul' => 'nullable',
					'waktu' => 'nullable',
					'category_id' => 'required',
				]);
				$validateData["laboratorium_id"] = $getLab->id;
				$validateData["category_kegiatan_id"] = $category_kegiatan->id;

				LaboratoriumKegiatan::create($validateData);
				return redirect(URL_PATH.$lab.'/'.$kegiatan)->with('success', 'data berhasill di tambahkan!');
			}
		}
		return abort(404);
	}

	public function edit($lab, $kegiatan, LaboratoriumKegiatan $id)
	{
		$getLab = $this->getLab($lab);
		if($getLab){
			$category_kegiatan = CategoryKegiatan::where('slug_c',$kegiatan)->first();
			if($category_kegiatan){
				$id->waktu = $id->waktu?date('Y-m-d', strtotime($id->waktu)):null;
				return view('admin.laboratorium.kegiatan.edit', [
					'title' => 'Edit '.$category_kegiatan->nama_c.' | Laboratorium '.$getLab->nama_lab,
					'url' => URL_PATH.$lab.'/'.$kegiatan,
					'categorys' => Category::all()->where('nama','!=','Departemen'),
					'data' => $id
				]);
			}
		}
		return abort(404);
	}

	public function update(Request $request, $lab, $kegiatan, LaboratoriumKegiatan $id)
	{
		$getLab = $this->getLab($lab);
		if($getLab){
			$category_kegiatan = CategoryKegiatan::where('slug_c',$kegiatan)->first();
			if($category_kegiatan){
				$request['waktu'] = $request['waktu']?date('d M Y', strtotime($request->waktu)):null;
				$request['category_id'] = intval($request['category_id']);
				$validateData = $request->validate([
					'nama' => 'required',
					'nip' => 'required',
					'judul' => 'nullable',
					'waktu' => 'nullable',
					'category_id' => 'required',
				]);
				$validateData["laboratorium_id"] = $getLab->id;
				$validateData["category_kegiatan_id"] = $category_kegiatan->id;

				LaboratoriumKegiatan::where('id', $id->id)->update($validateData);
				return redirect(URL_PATH.$lab.'/'.$kegiatan)->with('success', 'data berhasill di edit!');
			}
		}
		return abort(404);
	}

	public function destroy($lab, $kegiatan, LaboratoriumKegiatan $id)
	{
		$getLab = $this->getLab($lab);
		if($getLab){
			$category_kegiatan = CategoryKegiatan::where('slug_c',$kegiatan)->first();
			if($category_kegiatan){
				LaboratoriumKegiatan::destroy($id->id);
				return redirect(URL_PATH.$lab.'/'.$kegiatan)->with('success', 'data berhasill di hapus!');
			}
		}
		return abort(404);
	}
}
