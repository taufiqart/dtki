@extends('admin.layouts.main')

@section('container')
	<div class="col-lg-8- col-md-10 card rounded p-2">
		<form method="post" action="/admin/alumni/data-alumni" enctype="multipart/form-data">
			{{-- @method('put') --}}
			@csrf
			<div class="mb-3">
				<label for="nama" class="form-label">Nama</label>
				<input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" autofocus value="{{ old('nama') }}">
				@error('nama')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="pekerjaan" class="form-label">Pekerjaan</label>
				<input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan" name="pekerjaan"  value="{{ old('pekerjaan') }}">
				@error('pekerjaan')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="alamat" class="form-label">Alamat</label>
				<input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat') }}">
				@error('alamat')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="no" class="form-label">Telp</label>
				<input type="text" class="form-control @error('no') is-invalid @enderror" id="no" name="no" value="{{ old('no') }}">
				@error('no')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="tahun" class="form-label">Tahun</label>
				<select class="form-select form-select-sm form-control" name="tahun" id="tahun" aria-label=".form-select-sm example">
					@for($tahun=date('Y'); $tahun>=2000; $tahun--)
					<option {{ old('tahun') == $tahun ? 'selected' : ''}} value="{{ $tahun }}">{{ $tahun }}</option>
					@endfor
				</select>
			</div>
			<button type="submit" class="btn btn-success">Submit</button>
			<a href="/admin/alumni/data-alumni" type="button" class="btn btn-primary">Cancel</a>
		</form>
	</div>
	<script>
	</script>
@endsection