{{-- @dd($kegiatan) --}}
@if($kegiatan->count())
<div class="table-scroll">
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Nama</th>
				<th scope="col">NRP/NIP/NPP</th>
				<th scope="col">Mhs/Dosen/Tendik</th>
				<th scope="col">Judul</th>
				<th scope="col">Waktu</th>
			</tr>
		</thead>
		<tbody>
			@foreach($kegiatan as $key => $data)
				<tr class="animated">
					<th scope="row">{{ $key+1 }}</th>
					<td>{{ $data->nama }}</td>
					<td>{{ $data->nip }}</td>
					<td>{{ $data->category }}</td>
					<td>{{ $data->judul }}</td>
					<td>{{ $data->waktu }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@else
	<p class="text-center">data tidak ditemukan.</p>
@endif
<div class="d-flex justify-content-center">
	{{ $kegiatan->onEachSide(1)->links() }}
</div>
