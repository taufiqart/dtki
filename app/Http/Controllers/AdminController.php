<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penelitian;
use App\Models\AlumniKegiatan;
use App\Models\AlumniData;
use App\Models\dosenTendik;
use App\Models\PengMasyarakat;
use App\Models\Perlombaan;

class AdminController extends Controller
{
	public function index()
	{
		$penelitian = array(
			'total' => Penelitian::all()->count(),
			'dosen' => Penelitian::all()->where('category','Dosen')->count(),
			'tendik' => Penelitian::all()->where('category','Tendik')->count(),
			'mahasiswa' => Penelitian::all()->where('category','Mahasiswa')->count(),
		);
		$peng_masyarakat = array(
			'total' => PengMasyarakat::all()->count(),
			'dosen' => PengMasyarakat::all()->where('category','Dosen')->count(),
			'tendik' => PengMasyarakat::all()->where('category','Tendik')->count(),
			'mahasiswa' => PengMasyarakat::all()->where('category','Mahasiswa')->count(),
		);
		$alumni = array(
			'data_alumni' => AlumniData::all()->count(),
			'kegiatan' => AlumniKegiatan::all()->count(),
		);
		$perlombaan = array(
			'total' => Perlombaan::all()->count(),
			'dosen' => Perlombaan::all()->where('category','Dosen')->count(),
			'tendik' => Perlombaan::all()->where('category','Tendik')->count(),
			'mahasiswa' => Perlombaan::all()->where('category','Mahasiswa')->count(),
		);
		$dosen_tendik = array(
			'total' => dosenTendik::all()->count(),
			'dosen' => dosenTendik::all()->where('category','Dosen')->count(),
			'tendik' => dosenTendik::all()->where('category','Tendik')->count(),
		);
		return view('admin.dashboard', [
			'title' => 'Admin | Dashboard',
			'penelitian' => collect($penelitian),
			'peng_masyarakat' => collect($peng_masyarakat),
			'alumni' => collect($alumni),
			'perlombaan' => collect($perlombaan),
			'dosen_tendik' => collect($dosen_tendik),
		]);
	}
}
