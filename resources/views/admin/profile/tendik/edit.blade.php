@extends('admin.layouts.main')

@section('container')
	<div class="col-lg-8-">
		<form method="post" action="/admin/profile/tendik" enctype="multipart/form-data">
			@method('put')
			@csrf
			<div class="mb-3">
				<label for="title" class="form-label">Title</label>
				<input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title', $body["title"]) }}">
				@error('title')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="image" class="form-label">Image</label>
				@if ($body["image"])
					<img src="{{ $body["image"] }}" alt="" class="img-preview img-fluid mb-3 col-md-5 d-block">
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
				<input type="hidden" class="oldImage" name="oldImage" value="{{ $body["image"] }}">
			</div>
			<div class="mb-3">
				<label for="text" class="form-label">Text</label>
				@error('text')
					<p class="text-danger">{{ $message }}</p>
				@enderror
				<textarea name="text" id="editor">{{ old('text', $body["text"]) }}</textarea>
			</div>
			<button type="submit" class="btn btn-success">Submit</button>
			<a href="/admin/profile/tendik" type="button" class="btn btn-primary">Cancel</a>
		</form>
	</div>
@endsection