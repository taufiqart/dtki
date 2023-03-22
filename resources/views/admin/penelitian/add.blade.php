@extends('admin.layouts.main')

@section('container')
	<div class="col-lg-8- col-md-10 card rounded p-2">
		<form method="post" action="/admin/penelitian" enctype="multipart/form-data">
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
				<label for="publikasi" class="form-label">Publikasi</label>
				<input type="text" class="form-control @error('publikasi') is-invalid @enderror" id="publikasi" name="publikasi" required autofocus value="{{ old('publikasi') }}">
				@error('publikasi')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			<div class="mb-3">
				<select class="form-select form-select-sm form-control" name="tahun" id="tahun" aria-label=".form-select-sm example">
					@for($tahun=date('Y'); $tahun>=2000; $tahun--)
					<option value="{{ $tahun }}">{{ $tahun }}</option>
					@endfor
				</select>
				@error('tahun')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			<div class="mb-3">		
				<label for="file" class="form-label">File pdf</label>
				<input class="form-control @error('file') is-invalid @enderror" type="file" id="file" name="file" onchange="checkPdf(this)">
				<div class="invalid-feedback d-none"></div>
				@error('file')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="abstract" class="form-label">Abstract</label>
				@error('abstract')
				<p class="text-danger">{{ $message }}</p>
				@enderror
				<textarea name="abstract" id="editor">{{ old('body') }}</textarea>
			</div>
			<button type="submit" class="btn btn-success">Submit</button>
			<a href="/admin/penelitian" type="button" class="btn btn-primary">Cancel</a>
		</form>
	</div>
@endsection