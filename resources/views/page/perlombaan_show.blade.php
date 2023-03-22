@extends('layouts.main')

@section('container')
	<div class="col-md-8">
		<div class="content-rounded">
			<div class="main_title">
				<h1 class="content-title">{{ $perlombaan->title }}</h1>
			</div>
			@if($perlombaan->category)
			<div class="my-4">
				Category : 
				<a target="_blank" class="" href="{{ $url.'?category='.$perlombaan->category }}">
					{{ $perlombaan->category }}
				</a>
			</div>
			@endif
			<hr>
			<div class="main_body">
				<div class="" style="text-align:justify;">
					<img class="m-auto d-block d-md-inline float-none float-md-start m-md-3 mb-3 rounded shadow-sm" src="{{ $perlombaan->image }}" alt="" width="300">
					{!! $perlombaan->body !!}
				</div>
			</div>
		</div>
		<hr/>
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
		<hr />
	</div>
	<div class="col-md-4">
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
	</div>
@endsection