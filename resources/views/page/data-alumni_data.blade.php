@if($data_alumni->count())
<div class="table-scroll">
	<table class="table table-responsive table-striped overflow-auto">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Nama</th>
				{{-- <th scope="col"><a href="" class="text-black" title="sort by name a-z"><i class="fas fa-sort"></i> Nama</th></a> --}}
				<th scope="col">Pekerjaan</th>
				<th scope="col">Alamat</th>
				<th scope="col" class="col-md-3">Telp</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data_alumni as $key => $data)
			<tr class="animated">
				<th scope="row">{{ $key+1 }}</th>
				<td>{{ $data->nama }}</td>
				<td>{{ $data->pekerjaan }}</td>
				<td>{{ $data->alamat }}</td>
				<td>{{ $data->no }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@else
	<p class="text-center">data tidak ditemukan.</p>
@endif
<div class="d-flex justify-content-center">
	{{ $data_alumni->onEachSide(1)->links() }}
</div>
