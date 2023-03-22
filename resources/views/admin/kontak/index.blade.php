@extends('admin.layouts.main')

@section('container')
	<div class="col-lg-8-">
		<div class="content-rounded mb-2">
			<div class="widget_title"><h5>Kontak</h5></div>
			<div class="widget_body">
				<b><i class="fa fa-home"></i> Alamat :</b>
				<p>{!! $data->alamat??null !!}</p>
				<b><i class="fa fa-phone"></i> Telepon :</b>
				<p>{!! $data->telepon??null !!}</p>
				<b><i class="fa fa-envelope"></i> Email :</b>
				<p>{!! $data->email??null !!}</p>
				<b><i class="fa fa-desktop"></i> Website :</b>
				<p>{!! $data->website??null !!}</p>
				@if($data->media_sosial??null)
				<h5>Media Sosial :</h5>
				<ul>
					@foreach($data->media_sosial as $sosmed)
					<li class="d-inline ">
						<a href="{{ $sosmed["url"] }}" class="text-black" target="_blank" title="{{ $sosmed["title"] }}">
							<i class="fab {{ $sosmed["icon"] }} h3"></i>
						</a>
					</li>
					@endforeach
				</ul>
				@endif
			</div>
		</div>
		<a href="{{ $url }}/edit" type="button" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
	</div>	
@endsection