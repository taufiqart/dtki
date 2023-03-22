@extends('admin.layouts.main')

@section('container')
	<div class="col-lg-8">
		<div class="">
			<a href="{{ $url_edit }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
			<a href="{{ $url_back }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
			<hr>
		</div>

		<div class="main mb-5">
			<div class="main_title btn-primary dropdown ps-3 rounded mb-3">Kepala Lab</div>
			<div class="main_body">
				<div class="card m-1 animated mb-3">
					<div class="row g-0 justify-content-center align-items-center">
						<div class="col-md-4 col-lg-3 text-center ps-md-2 ps-sm-0">
							<img src="{{ $kepala["image"] }}" class="col-md-5 card-img-top img-thumbnail rounded-circle m-auto" style="width: 200px;" alt="...">
						</div>
						<div class="col-md-8">
							<div class="card-body">
								<h5 class="card-title">{{ $kepala["nama"] }}</h5>
								<ul class="list-group list-group-flush">
									<li class="list-group-item">NIP : {{ $kepala["nip"] }}</li>
									<li class="list-group-item">Email : {{ $kepala["email"] }}</li>
									<li class="list-group-item">Gol./ Jabatan Fungsional : {{ $kepala["jabatan"] }}</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr id="anggota-lab">
		<div class="main">
			<div class="main_title btn-primary dropdown ps-3 rounded mb-3">Anggota Lab</div>
			<div class="main_body mt-1 ms-3">
				@foreach($anggota as $data)
				<div class="card m-1 animated mb-3">
					<div class="row g-0 justify-content-center align-items-center">
						<div class="col-md-4 col-lg-3 text-center ps-md-2 ps-sm-0">
							<img src="{{ $data["image"] }}" class="col-md-5 card-img-top img-thumbnail rounded-circle m-auto" style="width: 200px;" alt="...">
						</div>
						<div class="col-md-8">
							<div class="card-body">
								<h5 class="card-title">{{ $data["nama"] }}</h5>
								<ul class="list-group list-group-flush">
									<li class="list-group-item">NIP : {{ $data["nip"] }}</li>
									<li class="list-group-item">Email : {{ $data["email"] }}</li>
									<li class="list-group-item">Gol./ Jabatan Fungsional : {{ $data["jabatan"] }}</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
		
@endsection