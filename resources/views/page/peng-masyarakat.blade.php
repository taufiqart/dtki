@if($peng_masyarakat->count())
<div class="table-scroll">
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Nama</th>
				<th scope="col">Judul</th>
				<th scope="col">Tempat</th>
				<th scope="col">Waktu</th>
			</tr>
		</thead>
		<tbody>
			@foreach($peng_masyarakat as $key => $data)
				<tr class="animated">
					<th scope="row">{{ $key+1 }}</th>
					<td>{{ $data->nama }}</td>
					<td>{{ $data->judul }}</td>
					<td>{{ $data->tempat }}</td>
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
	{{ $peng_masyarakat->onEachSide(1)->links() }}
</div>


{{-- @extends('layouts.main')

@section('container')
	@include('page.peng-masyarakat_data')
@endsection --}}