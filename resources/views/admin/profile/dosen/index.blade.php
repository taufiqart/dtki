@extends('admin.layouts.main')

@section('container')
	<div class="col-lg-8-">
		@if($data)
		<div class="mb-3">
			<div class="col-md-11 content-rounded mb-3 border-0">
				<h3 class="card-title">{{ $data->title }}</h3>
				<div class="m-3" style="text-align:justify;"><img src="{{ $data->image }}" class="m-auto d-block p-3 d-md-inline float-md-start " width="300" alt="...">
  				<p class="clearfix">{!! $data->deskripsi !!}</p></div>  				
			</div>
		</div>
		@endif		
		<a href="{{ $url }}/edit" type="button" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
		<a href="{{ $url_view }}" target="_blank" type="button" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
	</div>	
@endsection