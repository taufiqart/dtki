@extends('layouts.main')

@section('container')
	@if($data->count())
	<section class="container-xxl p-0 px-xxl-2 hero-area js-doc-top-el">
		<div class="hero-slides owl-carousel">
			@foreach($data->galery as $galery)
				<div class="single-hero-slide bg-img" style="background-image: url('{{ $galery->image }}');">
					<div class="container h-100">
						<div class="row h-100 align-items-center">
							<div class="col-12">
								<div class="hero-slides-content">
									<h2 data-animation="fadeInUp text-morphism" data-delay="400ms">{{ $galery->title }}</h2>
									<!-- <a href="" target="_parent" class="btn academy-btn" data-animation="fadeInUp" data-delay="700ms">Selengkapnya</a> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</section>
	@endif
	<section id='content' class="mt-5">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="content-rounded">
						<h3 class="card-title">{{ $data->title }}</h3>
						<div class="m-3" style="text-align:justify;color:black !important;">
							<img src="{{ $data->image }}" class="rounded m-auto d-block d-md-inline float-md-start m-md-3 pb-2" width="300" alt="{{ $data->title }}">
						{{-- <p class="text-indent"></p> --}}
						{!! $data->deskripsi !!}
						</div>
					</div>
					@if($random->count())
					<hr />
					<div class="content-rounded">
						<div class="main_title"><h5>Posts</h5></div>
						<div class="main_body">
							<div class="row">
								@foreach($random as $data)
								<div class="col-lg-4 col-6 post-hover" onclick="window.location='{{ !empty($data->category)?'/perlombaan/':'/alumni/kegiatan/' }}{{ $data->slug }}' ">
									<div class="animated post-rounded height mb-4" style="height: 300px">
										<div class="mb-1" style="">
											<img class="shadow-sm rounded max-height-img" src="{{ $data->image }}" alt="" style="width: 100%; margin: 0 auto;">
										</div>
										<div class="overflow-hidden" style="max-height:140px;">
											<a href="{{ !empty($data->category)?'/perlombaan/':'/alumni/kegiatan/' }}{{ $data->slug }}"><h6 class="post-title overflow-hidden" style="max-height: 55px;" >{{ $data->title }}</h6></a>
											<p class="overflow-hidden post-excerpt" style="max-height: 80px;">{{ $data->excerpt }}</p>
										</div>
										<div class="post-date-div">
											<p class="post-date">{{ $data->created_at->diffForHumans() }}</p>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>
					@endif
					<hr class="d-md-none" />
				</div>
				<div class="col-md-4">
					@if($kontak)
					<div class="content-rounded">
						<div class="widget_title"><h5>Kontak</h5></div>
						<div class="widget_body">
							<b><i class="fa fa-home"></i> Alamat :</b>
							<p>{!! $kontak->alamat !!}</p>
							<b><i class="fa fa-phone"></i> Telepon :</b>
							<p>{!! $kontak->telepon !!}</p>
							<b><i class="fa fa-envelope"></i> Email :</b>
							<p>{!! $kontak->email !!}</p>
							<b><i class="fa fa-desktop"></i> Website :</b>
							<p>{!! $kontak->website !!}</p>
							<h5>Media Sosial :</h5>
							<ul>
								@foreach($kontak->media_sosial as $sosmed)
								<li class="d-inline ">
									<a href="{{ $sosmed["url"] }}" class="text-black" target="_blank" title="{{ $sosmed["title"] }}">
										<i class="fab {{ $sosmed["icon"] }} h3"></i>
									</a>
								</li>
								@endforeach
							</ul>
						</div>
					</div>
					@endif
					@if($new->count() || $penelitian->count())
					<div class="content-rounded mt-3">
						<div class="widget_title"><h5>Berita Terbaru</h5></div>
						<div class="widget_body">
							@foreach($new as $data)
							<div class="d-flex row animated post-border" onclick="window.location='{{ !empty($data->category)?'/perlombaan/':'/alumni/kegiatan/' }}{{ $data->slug }}'">
								<div class="col-4">
									<img src="{{ $data->image }}" width="100%">
								</div>
								<div class="col">
									<a href="{{ !empty($data->category)?'/perlombaan/':'/alumni/kegiatan/' }}{{ $data->slug }}" class="overflow-hidden"  title="{{ $data->title }}">
										<h6 class="post-title overflow-hidden" style="max-height: 38px;">{{ $data->title }}</h6>
									</a>
									<p class="post-date">{{ $data->created_at->diffForHumans() }}</p>
								</div>
							</div>
							@endforeach
							@foreach($penelitian as $data)
							<div class="d-flex animated" onclick="window.location='/penelitian/{{ $data->slug }}'" style="padding:15px 0px;border-bottom:1px dashed #DADADA;">
								<a class="overflow-hidden" style="max-height: 50px;" href="/penelitian/{{ $data->slug }}"><p class="post-title-gray">{{ $data->judul }}</p></a>
							</div>
							@endforeach
						</div>
					</div>
					@endif
				</div>
			</div>
		</div>
	</section>
@endsection