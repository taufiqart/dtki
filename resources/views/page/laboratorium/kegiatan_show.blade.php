@extends('layouts.main')

@section('container')
 	<div class="container justify-content-center pt-5" style="max-width: 900;">
		<div class="row justify-content-center">
			<div class="col-md-9 col-lg-6">
				<div class="">
					<span class="">
						<i class="fas fa-file"></i> {{ $penelitian->publikasi }}
					</span>
					{{-- <span class="mx-2">
						<i class="fas fa-globe"></i>
						<a href="/journals/jurnal-teknologi-kimia-dan-industri" title="Journal published by Diponegoro University">Jurnal Teknologi Kimia dan Industri</a>
					</span> --}}
					<span class="mx-2">
						Category : {{ $penelitian->category }}
					</span>
				</div>
				<div class="mt-2">
					<h1 class="content-title">{{ $penelitian->judul }}</h1>
					<div class="">
						<div class="">
							{{ $penelitian->nama }}
						</div>
						<div class="">
							{{ $penelitian->tahun }}
						</div>
					</div>
					<div class="d-flex justify-content-between my-3 mb-5">
						@if($penelitian->file)
						<div class="">
							<a target="_blank" class="btn btn-primary" href="{{ $penelitian->file }}">
								<i class="fas fa-download"></i>
								Download full text
							</a>
						</div>
						<div class="clearfix mobile-only"></div>
						@endif
					</div>
				</div>
				<div class="pub-content position-relative">
					<h2 class="pp-title">Abstract</h2>
					<p class="abstract text-indent">{!! $penelitian->abstract !!}</p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="widget">
					<hr class="d-md-none mt-3 divider">
					<div class="bg-md-primary widget-title">
						New Post
					</div>
					<div class="widget_body">
						<div class="latest-blog-posts">
							@foreach($posts as $post)
							<div class="single-latest-blog-post d-flex animated" style="padding:15px 0px;border-bottom:1px dashed #DADADA;">
								<a href="/penelitian/{{ $post->slug }}">{{ $post->judul }}</a>
							</div>
							@endforeach
							{{-- <div class="single-latest-blog-post d-flex animated" style="padding:15px 0px;border-bottom:1px dashed #DADADA;">
								<div class="latest-blog-post-thumb">
									<img src="/img/Lambang-DTKI-180x180.png" width="100%">
								</div>
								<div class="latest-blog-post-content">
									<a href="/perlombaan/view/lorem-ipsum-dolor.html" class="post-title" title="">
										<h6>Lorem ipsum dolor sit amet.</h6>
									</a>
									<a class="post-date">Tanggal 22-08-2019 pukul 19:24</a>
								</div>
							</div> --}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection