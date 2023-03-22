@extends('admin.layouts.main')

@section('container')
	<div class="col-lg-8- col-md-10 card rounded p-2">
		<form method="post" action="{{ $url.'/'.$data->id }}" enctype="multipart/form-data">
			@method('put')
			@csrf
			
			<div class="mb-3">
				<label for="nama" class="form-label">Nama</label>
				<input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" required autofocus value="{{ old('nama', $data->nama) }}">
				@error('nama')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="nip" class="form-label">NRP/NIP/NPP</label>
				<input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" required autofocus value="{{ old('nip', $data->nip) }}">
				@error('nip')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			@if($categorys)
			<div class="mb-3">
				<label for="category" class="form-label">Mhs/Dosen/Tendik</label>
				<select class="form-select form-select-sm form-control @error('category_id') is-invalid @enderror" onchange="categorys(this)" name="category_id" id="category" aria-label=".form-select-sm example">
					@foreach($categorys as $category)
					<option {{ old('category_id', $data->category_id) == $category->id ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->nama }}</option>
					@endforeach
				</select>
				@error('category_id')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			@endif
			<div class="mb-3">
				<label for="judul" class="form-label">Judul</label>
				<input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" required autofocus value="{{ old('judul', $data->judul) }}">
				@error('judul')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="waktu" class="form-label">Waktu</label>
				<input type="date" class="form-control @error('waktu') is-invalid @enderror" id="waktu" name="waktu" placeholder="dd-mm-yyyy"  autofocus value="{{ old('waktu', $data->waktu) }}">
				@error('waktu')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			<button type="submit" class="btn btn-success">Submit</button>
			<a href="{{ $url }}" type="button" class="btn btn-primary">Cancel</a>
		</form>
	</div>
	<script>
	</script>
@endsection