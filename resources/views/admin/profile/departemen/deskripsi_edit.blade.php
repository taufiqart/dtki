@extends('admin.layouts.main')

@section('container')
	<div class="col-lg-8- p-3">
		<form method="post" action="{{ $url }}" enctype="multipart/form-data" class="content-rounded">
			@method('put')
			@csrf
			<div class="mb-3">
				<label for="title" class="form-label">Title</label>
				<input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title', $data->title??null) }}">
				@error('title')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="image" class="form-label">Image</label>
				@if ($data->image??null)
					<img src="{{ $data->image??null }}" alt="" class="img-preview img-fluid mb-3 col-md-5 d-block">
				@else
					<img src="" alt="" class="img-preview img-fluid mb-3 col-md-5 d-block">
				@endif
				<input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage(this)">
				<div class="invalid-feedback d-none"></div>
				@error('image')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
				{{-- <input type="hidden" class="oldImage" name="oldImage" value="{{ $data->image }}"> --}}
			</div>
			<div class="mb-3">
				<label for="deskripsi" class="form-label">Text</label>
				@error('deskripsi')
					<p class="text-danger">{{ $message }}</p>
				@enderror
				<textarea name="deskripsi" id="editor">{{ old('deskripsi', $data->deskripsi??null) }}</textarea>
			</div>
			<button type="submit" class="btn btn-success">Submit</button>
			<a href="{{ $url }}" type="button" class="btn btn-primary">Cancel</a>
		</form>
	</div>
@endsection