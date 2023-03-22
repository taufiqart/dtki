@if($penelitian->count())
<div class="table-scroll">
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Nama</th>
				<th scope="col">Judul</th>
				<th scope="col">Publikasi</th>
				<th scope="col">Tahun</th>
			</tr>
		</thead>
		<tbody>
			@foreach($penelitian as $key => $data)
				<tr class="animated">
					<th scope="row">{{ $key+1 }}</th>
					<td>{{ $data->nama }}</td>
					<td><a href="/penelitian/{{ $data->slug }}">{{ $data->judul }}</a></td>
					<td>{{ $data->publikasi }}</td>
					<td>{{ $data->tahun }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@else
	<p class="text-center">data tidak ditemukan.</p>
@endif
<div class="d-flex justify-content-center">
	{{ $penelitian->onEachSide(1)->links() }}
</div>
