@extends('layouts.main')

@section('container')
	<style>
		#kepala-lab:target{
			margin-bottom: 8rem;
		}
		#anggota-lab:target{
			margin-bottom: 8rem;
		}
	</style>
		<section class="container-xxl p-0 px-xxl-2 hero-area js-doc-top-el">
			<div class="hero-slides owl-carousel">
				@foreach($galerys as $galery)
					<div class="single-hero-slide bg-img" style="background-image: url('{{ $galery->image }}');">
						<div class="container h-100">
							<div class="row h-100 align-items-center">
								<div class="col-12">
									<div class="hero-slides-content">
										<h2 data-animation="fadeInUp text-morphism" data-delay="400ms">{{ $galery->title }}</h2>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</section>
		<section id='content' class="about-us-area pt-4 js-doc-main-el">
			<div class="container">
				<div class="row">
					<div class="co">
						<div id="main">
							<div class="main mb-5 content-rounded">
								<div class="main_title pb-3">{{ $data->title }}</div>
								<div class="main_body" style="text-align:justify;">
									@if($data->image)
									<img src="{{ $data->image }}" class="rounded m-auto d-block d-md-inline float-md-start m-md-3 pb-2" width="300" alt="{{ $data->title }}">
									@endif
									{!! $data->deskripsi !!}
								</div>
							</div>
						</div>
						<hr id="kepala-lab">
						@if($kepala || $anggota)
						<div id="main" class="mb-5 content-rounded">
							@if($kepala)
							<div class="main mb-5">
								<div class="main_title btn-primary dropdown ps-3 rounded mb-3">Kepala Lab</div>
								<div class="main_body">
									<div class="card-rounded bg-white mb-3 animated">
										<div class="row g-0 justify-content-center align-items-center">
											<div class="col-12 col-md-4">
												<div class="shadow-sm card-img img-size">
													<div class="img-container" >
														<img class="img-size" src="{{ $kepala->image }}" alt="{{ $kepala->nama }}">
													</div>
												</div>
											</div>
											<div class="col">
												<div class="card-body">
													<h5 class="card-title">{{ $kepala->nama }}</h5>
													<ul class="list-group list-group-flush">
														<li class="list-group-item">NIP : {{ $kepala->nip }}</li>
														<li class="list-group-item">Email : {{ $kepala->email }}</li>
														<li class="list-group-item">Gol./ Jabatan Fungsional : {{ $kepala->jabatan }}</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<hr id="anggota-lab">
							@endif
							@if($anggota)
							<div class="main">
								<div class="main_title btn-primary dropdown ps-3 rounded mb-3">Anggota Lab</div>
								<div class="main_body mt-1">
									@foreach($anggota as $data)
									<div class="card-rounded bg-white mb-3 animated">
										<div class="row g-0 justify-content-center align-items-center">
											<div class="col-12 col-md-4">
												<div class="shadow-sm card-img img-size">
													<div class="img-container" >
														<img class="img-size" src="{{ $data->image }}" alt="{{ $data->nama }}">
													</div>
												</div>
											</div>
											<div class="col">
												<div class="card-body">
													<h5 class="card-title">{{ $data->nama }}</h5>
													<ul class="list-group list-group-flush">
														<li class="list-group-item">NIP : {{ $data->nip }}</li>
														<li class="list-group-item">Email : {{ $data->email }}</li>
														<li class="list-group-item">Gol./ Jabatan Fungsional : {{ $data->jabatan }}</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>
							@endif
						</div>
						<hr/>
						@endif
					</div>
				</div>
			</div>
		</section>
@endsection