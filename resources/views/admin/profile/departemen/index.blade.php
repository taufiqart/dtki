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
				<a href="{{ $url }}/galery"><h3 class="text-white p-5 btn-primary rounded-3" id="title">Galery <hr></h3></a>
			</div>
		</div>
		
		<hr>
		<a href="{{ $url_view }}" target="_blank" type="button" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
	</div>
@endsection