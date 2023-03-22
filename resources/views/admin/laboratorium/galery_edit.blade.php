@extends('admin.layouts.main')

@section('container')
	<div class="col-lg-8-">
		<form method="post" action="{{ $url }}/{{ $data->id }}" enctype="multipart/form-data">
			@method('put')
			@csrf
			<div class="mb-3 card rounded">
				<div class="p-3">
					<div class="mb-2">
						<label for="image" class="form-label">Image</label>
						@if ($data->image)
							<img src="{{ $data->image }}" alt="" class="img-preview img-fluid mb-3 col-md-5 d-block">
						@else
							<img src="" alt="" class="img-preview img-fluid mb-3 col-md-5 d-block">
						@endif
						<input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage(this)">
						<div class="invalid-feedback"></div>
						@error('image')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
					<div class="mb-2">
						<label for="title" class="form-label">Title</label>
						<input class="form-control @error('title') is-invalid @enderror" type="text" id="title" name="title" value="{{ old('title',$data->title)}}" @error('title') autofocus @enderror }}>
						@error('title')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
				</div>
			</div>
			<button type="submit" class="btn btn-success">Submit</button>
			<a href="{{ $url }}" type="button" class="btn btn-primary">Cancel</a>
		</form>
	</div>
@endsection


