@extends('admin.layouts.main')

@section('container')
	<div class="col-lg-8-">
		<div class="row">
			
			<div class="mb-3 col-12 col-sm-6 col-md-4">
				{{-- <label for="title" class="form-label">Deskripsi</label> --}}
				<a href="{{ $url }}/deskripsi"><h3 class="text-white p-5 btn-primary rounded-3" id="title">Deskripsi <hr></h3></a>
			</div>
			<div class="mb-3 col-12 col-sm-6 col-md-4">
				{{-- <label for="title" class="form-label">Deskripsi</label> --}}
				<a href="{{ $url }}/kepala_anggota"><h3 class="text-white p-5 btn-primary rounded-3" id="title">Kepala & Anggota <hr></h3></a>
			</div>
			<div class="mb-3 col-12 col-sm-6 col-md-4">
				{{-- <label for="title" class="form-label">Deskripsi</label> --}}
				<a href="{{ $url }}/galery"><h3 class="text-white p-5 btn-primary rounded-3" id="title">Galery <hr></h3></a>
			</div>
			<div class="mb-3 col-12 col-sm-6 col-md-4">
				<buttton class="collapsed" data-bs-toggle="collapse" data-bs-target="#getting-started-collapse" aria-expanded="false" role="button">
					<h3 class="text-white p-5 btn-primary rounded-3" id="title">Kegiatan <hr></h3>
				</buttton>

				<div class="mt-1 ms-3 collapse" id="getting-started-collapse">
					<ul class="list-unstyled fw-normal">
						<li><a href="{{ $url }}/penelitian" class="p-3 btn-primary border-bottom w-100 d-inline-flex align-items-center rounded">Penelitian</a></li>
						<li><a href="{{ $url }}/praktikum" class="p-3 btn-primary border-bottom w-100 d-inline-flex align-items-center rounded">Praktikum</a></li>
						<li><a href="{{ $url }}/proyek-akhir" class="p-3 btn-primary border-bottom w-100 d-inline-flex align-items-center rounded">Proyek akhir</a></li>
						<li><a href="{{ $url }}/pengujian" class="p-3 btn-primary border-bottom w-100 d-inline-flex align-items-center rounded">Pengujian</a></li>
						<li><a href="{{ $url }}/perlombaan" class="p-3 btn-primary border-bottom w-100 d-inline-flex align-items-center rounded">Perlombaan</a></li>
					</ul>
				</div>
			</div>
		</div>
		
		<hr>
		<a href="{{ $url_view }}" target="_blank" type="button" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
	</div>
@endsection