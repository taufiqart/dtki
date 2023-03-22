@extends('admin.layouts.main')

@section('container')
	<div class="col-lg-8- col-md-10 card rounded p-2">
		<form method="post" action="/admin/alumni/kegiatan/{{ $alumni_kegiatan->slug }}" enctype="multipart/form-data">
			@method('put')
			@csrf
			<div class="mb-3">
				<label for="title" class="form-label">Title</label>
				<input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title', $alumni_kegiatan->title) }}">
				@error('title')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>			
			<div class="mb-3">
				<label for="image" class="form-label">Image</label>
				@if($alumni_kegiatan->image)
				<img src="{{ $alumni_kegiatan->image }}" alt="" class="img-preview img-fluid mb-3 col-md-5 d-block">
				@else
				<img src="" alt="" class="img-preview img-fluid mb-3 col-md-5 d-block">
				@endif
				<input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage(this)">
				<input type="hidden" name="oldImage" value="{{ $alumni_kegiatan->image }}">
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
				<textarea name="body" id="editor">{{ old('body', $alumni_kegiatan->body) }}</textarea>
			</div>
			<button type="submit" class="btn btn-success">Submit</button>
			<a href="/admin/alumni/kegiatan" type="button" class="btn btn-primary">Cancel</a>
		</form>
	</div>
@endsection