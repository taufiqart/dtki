@extends('admin.layouts.main')

@section('container')	
	<div class="col-lg-8-">
		<form class="row justify-content-space-between col-md-8" method="get" action="{{ $url }}">
			<div class="col-2 col-sm-2 align-items-center m-0 p-2">
				<a href="{{ $url }}/create" class="btn btn-primary form-control text-white"><i class="fas fa-plus"></i><div class="ms-1 d-none d-lg-inline">Add new</div></a>
			</div>			
		</form>
		<div class="row">
			<div class="container justify-content-center p-3" style=" margin: 0 auto;">
				@if($kepalaAnggota->count())
				<table class="table table-sm align-items-center">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Image</th>
							<th scope="col">Nama</th>
							<th scope="col">Nip/Npp/Nrp</th>
							<th scope="col">Email</th>
							<th scope="col">Jabatan</th>
							<th scope="col">role_name</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($kepalaAnggota as $key => $data)						
						<tr class="border-bottom pt-3 animated">
							<th>{{ $key+1 }}</th>
							<td class="col-2 p-2"><img style="width: 50%;" src="{{ $data->image }}" alt=""></td>
							<td>{{ $data->nama }}</td>
							<td>{{ $data->nip }}</td>
							<td>{{ $data->email }}</td>
							<td>{{ $data->jabatan }}</td>
							<th>{{ $data->role_name }}</th>
							<td>
								<div class="d-md-flex justify-content-space-between align-items-center">
									<a href="{{ $url }}/{{ $data->id }}/edit" class="btn btn-warning m-1 d-inline-block">
										<i class="fas fa-w fa-edit"></i>
									</a>
									
									<form action="{{ $url }}/{{ $data->id }}" method="post" class="d-inline">
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
			{{-- {{ $anggota->links() }} --}}
		</div>
	</div>
@endsection