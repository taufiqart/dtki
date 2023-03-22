@extends('admin.layouts.main')

@section('container')
	<div class="col-lg-8-">
		<form class="row justify-content-space-between col-md-8" method="get" action="/admin/alumni/kegiatan">
			<div class="col-2 col-sm-2 align-items-center m-0 p-2">
				<a href="/admin/alumni/kegiatan/create" class="btn btn-primary form-control text-white"><i class="fas fa-plus"></i><div class="ms-1 d-none d-lg-inline">Add new</div></a>
			</div>
			<div class="col-10 col-sm-7 m-0 p-2">
				<div class="input-group">
					<input type="text" class="form-control bg-light border-1 small" name="search" placeholder="Search for..."
						aria-label="Search" aria-describedby="basic-addon2" value="{{ request('search') }}">
					<div class="input-group-append">
						<button class="btn btn-primary" type="submit">
							<i class="fas fa-search fa-sm"></i>
						</button>
					</div>
				</div>
			</div>
		</form>
		<div class="row">
			<div class="container justify-content-center p-3" style=" margin: 0 auto;">
				@if($alumni_kegiatan->count())
				<table class="table table-sm align-items-center">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Image</th>
							<th scope="col">Article</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($alumni_kegiatan as $key => $data)
						<tr class="border-bottom pt-3 animated">
							<th>{{ $key+1 }}</th>
							<td class="col-2 p-2"><img style="width: 50%;" src="{{ $data->image }}" alt=""></td>
							<td>
								<h5>
									<a target="_blank" href="/alumni/kegiatan/{{ $data->slug }}">{{ $data->title }}</a>
								</h5>
								<p class="d-none d-md-inline">{{ $data->excerpt }}</p>
								<p>{{ $data->created_at->diffForHumans() }}</p>
							</td>
							<td>
								<div class="d-md-flex justify-content-space-between align-items-center">
									<a href="/admin/alumni/kegiatan/{{ $data->slug }}/edit" class="btn btn-warning m-1 d-inline-block">
										<i class="fas fa-w fa-edit"></i>
									</a>
									
									<form action="/admin/alumni/kegiatan/{{ $data->slug }}" method="post" class="d-inline">
										@method('delete')
										@csrf
										<button class="btn btn-danger m-1 fa-w d-inline-block" onclick="return confirm('Are you sure?')">
											<i class="fas fa-trash"></i>
										</button>
									</form>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@else
					<p class="text-center fs-4">data tidak ditemukan.</p>
				@endif
			</div>
		</div>
		<div class="d-flex justify-content-center">
			{{ $alumni_kegiatan->links() }}
		</div>
	</div>
@endsection