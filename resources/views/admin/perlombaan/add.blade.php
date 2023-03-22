@extends('admin.layouts.main')

@section('container')
	<div class="col-lg-8- col-md-10 card rounded p-2">
		<form method="post" action="/admin/perlombaan" enctype="multipart/form-data">
			{{-- @method('put') --}}
			@csrf
			<div class="mb-3">
				<label for="category" class="form-label">Category</label>
				<select class="form-select form-select-sm form-control" onchange="categorys(this)" name="category" id="category" aria-label=".form-select-sm example">
					<option {{ old('category') == 'Mahasiswa' ? 'selected' : ''}} value="Mahasiswa">Mahasiswa</option>
					<option {{ old('category') == 'Dosen' ? 'selected' : ''}} value="Dosen">Dosen</option>
					<option {{ old('category') == 'Tendik' ? 'selected' : ''}} value="Tendik">Tendik</option>
				</select>
			</div>
			<div class="mb-3">
				<label for="title" class="form-label">Title</label>
				<input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title') }}">
				@error('title')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>			
			<div class="mb-3">
				<label for="image" class="form-label">Image</label>
				<img src="" alt="" class="img-preview img-fluid mb-3 col-md-5">
				<input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage(this)">
				<div class="invalid-feedback d-none"></div>
				@error('image')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="body" class="form-label">Article</label>
				@error('body')
				<p class="text-danger">{{ $message }}</p>
				@enderror
				<textarea name="body" id="editor">{{ old('body') }}</textarea>
			</div>
			<button type="submit" class="btn btn-success">Submit</button>
			<a href="/admin/perlombaan" type="button" class="btn btn-primary">Cancel</a>
		</form>
	</div>
@endsection