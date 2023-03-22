@extends('admin.layouts.main')

@section('container')
	<style>
	</style>
	<div class="col-lg-8-">
		<div class="mb-3">
			<label for="title" class="form-label">Title</label>
			<h3 id="title">{{ $isi["title"] }}</h3>
		</div>
		<div class="mb-3">
			<label for="image" class="form-label">Image</label>
			<img src="{{ $isi["foto"] }}" alt="" id="image" class="img-preview img-fluid mb-3 col-md-5 d-block">
		</div>
		<div class="mb-3">
  			<p>{!! $isi["text"] !!}</p>
		</div>
		
		<hr>
		<div class="mb3">
			<div class="widget_title">Kontak</div>
			<div class="card rounded p-2 mb-2">
				<b><i class="fa fa-home"></i> Alamat :</b>
				<p>{!! $isi["alamat"] !!}</p>
				<b><i class="fa fa-phone"></i> Telepon :</b>
				<p>{!! $isi["telepon"] !!}</p>
				<b><i class="fa fa-envelope"></i> Email :</b>
				<p>{!! $isi["email"] !!}</p>
				<b><i class="fa fa-desktop"></i> Website :</b>
				<p>{!! $isi["website"] !!}</p>
				<h5>Media Sosial :</h5>
				<ul>
					@foreach($isi["sosmed"] as $sosmed)
					<li class="d-inline">
						<a href="{{ $sosmed["url"] }}" target="_blank" title="{{ $sosmed["title"] }}">
							<i class="fab {{ $sosmed["icon"] }} h3 text-dark"></i>
						</a>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
		<hr>
		<h3>Galery</h3>
		@foreach($galerys as $galery)
			<div class="mb-3 card rounded" id="galery">
				<div class="p-3">
					<div class="mb-2">
						<label for="galery-image" class="form-label">Galery Image</label>
						<img src="{{ $galery["foto"] }}" alt="" id="galery-image" class="img-preview img-fluid mb-3 col-md-5 d-block">
					</div>
					<div class="mb-2">
						<label for="galery-title" class="form-label">Galery Title</label>
						<p id="galey-title">{{ $galery["title"] }}</p>
					</div>
				</div>
			</div>
		@endforeach
		<a href="/admin/profile/departemen/edit" type="button" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
		<a href="/profile/departemen/" target="_blank" type="button" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
	</div>

	<script>

		document.addEventListener('trix-file-accept', function (e) {
			e.preferDefaut();
		});
	</script>
@endsection