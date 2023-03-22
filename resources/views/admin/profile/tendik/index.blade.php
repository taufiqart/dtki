@extends('admin.layouts.main')

@section('container')
	<div class="col-lg-8-">

		<div class="mb-3">
			<div class="col-md-11 card mb-3 border-0">
				<h3 class="card-title">{{ $body["title"] }}</h3>
				<div class="m-3" style="text-align:justify;"><img src="{{ $body["image"] }}" class="m-auto d-block d-md-inline float-none float-md-start m-md-3" width="300" alt="...">
				<p>{!! $body["text"] !!}</p>
			
			</div>
		</div>
		<a href="/admin/profile/tendik/edit" type="button" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
		<a href="/profile/tendik" target="_blank" type="button" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
	</div>
@endsection