@extends('admin.layouts.main')

@section('container')
	<div class="col-lg-8- col-md-10 card rounded p-2">
		<form method="post" action="/admin/peng-masyarakat" enctype="multipart/form-data">
			{{-- @method('put') --}}
			@csrf
			<div class="mb-3">
				<label for="category" class="form-label">Category</label>
				<select class="form-select form-select-sm form-control" onchange="categorys(this)" name="category" id="category" aria-label=".form-select-sm example">
					<option {{ old('category') == 'Dosen' ? 'selected' : ''}} value="Dosen">Dosen</option>
					<option {{ old('category') == 'Tendik' ? 'selected' : ''}} value="Tendik">Tendik</option>
					<option {{ old('category') == 'Mahasiswa' ? 'selected' : ''}} value="Mahasiswa">Mahasiswa</option>
				</select>
			</div>
			<div class="mb-3">
				<label for="nama" class="form-label">Nama</label>
				<input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" required autofocus value="{{ old('nama') }}">
				@error('nama')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="judul" class="form-label">Judul</label>
				<input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" required autofocus value="{{ old('judul') }}">
				@error('judul')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="tempat" class="form-label">Tempat</label>
				<input type="text" class="form-control @error('tempat') is-invalid @enderror" id="tempat" name="tempat" required autofocus value="{{ old('tempat') }}">
				@error('tempat')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="waktu" class="form-label">Waktu</label>
				<input type="date" class="form-control @error('waktu') is-invalid @enderror" id="waktu" name="waktu" placeholder="dd-mm-yyyy"  autofocus value="{{ old('waktu') }}">
				@error('waktu')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			<button type="submit" class="btn btn-success">Submit</button>
			<a href="/admin/peng-masyarakat" type="button" class="btn btn-primary">Cancel</a>
		</form>
	</div>
@endsection