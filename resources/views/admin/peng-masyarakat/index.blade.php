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