
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
				<div class="p-2">
				<input type="hidden" value="" name="remove_img" id="input-img-remove">				
				<button type="button" id="button-img-remove" class="btn btn-danger m-1 fa-w d-inline-block {{ !$data->image?'d-none':'' }}" onclick="">
					<i class="fas fa-trash"></i> Remove Image
				</button>
				</div>
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
	<script>
		document.querySelector('#image').addEventListener('change', ()=>{
			document.querySelector('#input-img-remove').removeAttribute('value')
			let btnImg = document.querySelector('#button-img-remove')
			btnImg.classList.remove('d-none')
		})
		document.querySelector('#button-img-remove').addEventListener('click', ()=>{			
			if(confirm('Are you sure to remove image')){
				let img = document.querySelector('.img-preview')			
				img.removeAttribute('src')
				let inpImg = document.querySelector('#image')
				inpImg.value = ''
				inpImg.removeAttribute('value')
				document.querySelector('#input-img-remove').value = 'true'
				let btnImg = document.querySelector('#button-img-remove')
				btnImg.classList.add('d-none')
			}
		})
	</script>
@endsection