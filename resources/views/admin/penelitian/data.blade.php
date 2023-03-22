	
<div class="row">
	<div class="container justify-content-center p-3" style=" margin: 0 auto;">
		@if($penelitian->count())
		<table class="table table-sm align-items-center">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Nama</th>
					<th scope="col">Judul</th>
					<th scope="col">Publikasi</th>
					<th scope="col">Tahun</th>
					<th scope="col">Category</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($penelitian as $key => $data)
				<tr class="border-bottom pt-3 animated">
					<th>{{ $key+1 }}</th>
					<td>{{ $data->nama }}</td>
					<td>
						<a target="_blank" href="/penelitian/{{ $data->slug }}">{{ $data->judul }}</a>
					</td>
					<td>{{ $data->publikasi }}</td>
					<td>{{ $data->tahun }}</td>
					<th>{{ $data->category }}</th>
					<td>
						<div class="d-md-flex justify-content-space-between align-items-center">
							<a href="/admin/penelitian/{{ $data->slug }}/edit" class="btn btn-warning m-1 d-inline-block">
								<i class="fas fa-w fa-edit"></i>
							</a>
							
							<form action="/admin/penelitian/{{ $data->slug }}" method="post" class="d-inline">
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
	{{ $penelitian->links() }}
</div>
