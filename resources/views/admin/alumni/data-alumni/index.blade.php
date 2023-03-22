
<div class="row">
	<div class="container justify-content-center p-3" style=" margin: 0 auto;">
		@if($data_alumni->count())
		<table class="table table-sm align-items-center">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Nama</th>
					<th scope="col">Pekerjaan</th>
					<th scope="col">Alamat</th>
					<th scope="col">Telp</th>
					<th scope="col">Tahun</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($data_alumni as $key => $data)
				<tr class="border-bottom pt-3 animated">
					<th>{{ $key+1 }}</th>
					<td>{{ $data->nama }}</td>
					<td>{{ $data->pekerjaan }}</td>
					<td>{{ $data->alamat }}</td>
					<td>{{ $data->no }}</td>
					<td>{{ $data->tahun }}</td>
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
	{{ $data_alumni->links() }}
</div>