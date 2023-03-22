@extends('admin.layouts.main')

@section('container')
	<div class="col-lg-8-">
		<form class="row justify-content-space-between col-md-8" method="get" action="/admin/peng-masyarakat">
			<div class="col-2 col-sm-2 align-items-center m-0 p-2">
				<a href="/admin/peng-masyarakat/create" class="btn btn-primary form-control text-white"><i class="fas fa-plus"></i><div class="ms-1 d-none d-lg-inline">Add new</div></a>
			</div>
			<div class="col-4 col-sm-3 m-0 p-2">
				<select class="form-select form-control" name="category" id="category">
					<option value="">Category</option>
					<option {{ request('category') == 'Dosen' ? 'selected' : '' }} value="Dosen">Dosen</option>
					<option {{ request('category') == 'Tendik' ? 'selected' : '' }} value="Tendik">Tendik</option>
					<option {{ request('category') == 'Mahasiswa' ? 'selected' : '' }} value="Mahasiswa">Mahasiswa</option>
				</select>
			</div>
			<div class="col-12 col-sm-7 m-0 p-2">
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
				@if($peng_masyarakat->count())
				<table class="table table-sm align-items-center">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nama</th>
							<th scope="col">Judul</th>
							<th scope="col">Tempat</th>
							<th scope="col">Waktu</th>
							<th scope="col">Category</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($peng_masyarakat as $key => $data)
						<tr class="border-bottom pt-3 animated">
							<th>{{ $key+1 }}</th>
							<td>{{ $data->nama }}</td>
							<td>{{ $data->judul }}</td>
							<td>{{ $data->tempat }}</td>
							<td>{{ $data->waktu }}</td>
							<th>{{ $data->category }}</th>
							<td>
								<div class="d-md-flex justify-content-space-between align-items-center">
									<a href="/admin/peng-masyarakat/{{ $data->id }}/edit" class="btn btn-warning m-1 d-inline-block">
										<i class="fas fa-w fa-edit"></i>
									</a>
									
									<form action="/admin/peng-masyarakat/{{ $data->id }}" method="post" class="d-inline">
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
			{{ $peng_masyarakat->links() }}
		</div>
	</div>
@endsection