@extends('layouts.main')

@section('container')
	<div class="pb-5"></div>
	<div class="container justify-content-center">
		<div class="row justify-content-center">
			<div class="col-md-12 col-lg-10 mb-3 border-0">
				<div class="content-rounded">
					<h3 class="card-title">{{ $data->title }}</h3>
					<div class="m-3" style="text-align:justify;">
						<img src="{{ $data->image }}" class="rounded m-auto d-block d-md-inline float-md-start m-md-3 pb-2 pb-md-0" width="300" alt="{{ $data->title }}">
					{{-- <p class="text-indent"></p> --}}
					{!! $data->deskripsi !!}
					</div>
				</div>
				@if($tendik->count())				
				<hr class="divider m-5">
				</hr>
				<div class="content-rounded py-4">
					<div class="row row-cols-1 row-cols-md-3 g-4">
						@foreach($tendik as $data)
						<div class="col col-md-4 my-3 animated">
							<div class="card-rounded">
								<div class="shadow-sm card-img">
									<div class="img-container">
										<img src="{{ $data->image }}" alt="...">
									</div>
								</div>
								<div class="card-body">
									<h5 class="card-title">
										@if($data->profil_file)
										<a target="_blank" href="{{ $data->profil_file }}">{{ $data->nama }}</a>
										@else
										{{ $data->nama }}
										@endif
									</h5>
									<ul class="list-group list-group-flush">
										<li class="list-group-item">NIP : {{ $data->nip }}</li>
										<li class="list-group-item">Email : {{ $data->email }}</li>
									</ul>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>
@endsection