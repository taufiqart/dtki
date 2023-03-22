@extends('admin.layouts.main')

@section('container')
	<div class="col-lg-8- col-md-10">
		<form method="post" action="/admin/dosen_tendik/{{ $dosen_tendik->nip }}" enctype="multipart/form-data">
			@method('put')
			@csrf
			<div id="inputData" class="card rounded p-2 mb-3">
				<div class="mb-3">
					<label for="category" class="form-label">Category</label>
					<select class="form-select form-select-sm form-control" onchange="categorys(this)" name="category" id="category" aria-label=".form-select-sm example">
						<option value="Dosen" {{ $dosen_tendik->category == 'Dosen' ? 'selected' : '' }}>Dosen</option>
						<option value="Tendik" {{ $dosen_tendik->category == 'Tendik' ? 'selected' : '' }}>Tendik</option>
					</select>
				</div>
				<div class="mb-3">
					<label for="image" class="form-label">Image</label>
					@if($dosen_tendik->image)
					<img src="{{ $dosen_tendik->image }}" alt="" class="img-preview img-fluid mb-3 col-md-5 d-block">
					@else
					<img src="" alt="" class="img-preview img-fluid mb-3 col-md-5 d-block">
					@endif
					<input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage(this)">
					<input type="hidden" name="oldImage" value="{{ $dosen_tendik->image }}">
					<div class="invalid-feedback d-none"></div>
					@error('image')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
					@enderror
				</div>
				<div class="mb-3">
					<label for="nama" class="form-label">Nama</label>
					<input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" required autofocus value="{{ old('nama', $dosen_tendik->nama) }}">
					@error('nama')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
					@enderror
				</div>
				<div class="mb-3">
					<label for="nip" class="form-label">Nip</label>
					<input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" required autofocus value="{{ old('nip', $dosen_tendik->nip) }}">
					@error('nip')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
					@enderror
				</div>
				<div class="mb-3">
					<label for="email" class="form-label">Email</label>
					<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" autofocus value="{{ old('email', $dosen_tendik->email) }}">
					@error('email')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
					@enderror
				</div>
				<div id="dosen" class="{{ $dosen_tendik->category == 'Dosen' ? '' : 'd-none' }}">
					<div class="mb-3">
						<label for="jabatan" class="form-label">Gol./ Jabatan</label>
						<input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" autofocus value="{{ old('jabatan', $dosen_tendik->jabatan) }}">
						@error('jabatan')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
					<div class="mb-3">
						<label for="profil" class="form-label">Profil</label>
						<div class="card rounded p-2 mb-2">
							<label class="profil_sinta" for="profil_sinta">Profil Sinta</label>
							<input type="text" class="form-control @error('profil_sinta') is-invalid @enderror" id="profil_sinta" name="profil_sinta" autofocus value="{{ old('profil_sinta', $dosen_tendik->profil_sinta) }}">
							@error('profil_sinta')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
							@enderror
							<label class="form-label" for="profil_scholar">Profil Google Scholar</label>
							<input type="text" class="form-control @error('profil_scholar') is-invalid @enderror" id="profil_scholar" name="profil_scholar" autofocus value="{{ old('profil_scholar', $dosen_tendik->profil_scholar) }}">
							@error('profil_scholar')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
							@enderror
						</div>
					</div>
				</div>
				<label for="profil_file" class="form-label">Profil file pdf</label>
				@if($dosen_tendik->profil_file)
				<a href="{{ $dosen_tendik->profil_file }}">{{ $filename }}</a>
				@endif
				<input class="form-control @error('profil_file') is-invalid @enderror" type="file" id="profil_file" name="profil_file" onchange="checkPdf(this)">
				<input type="hidden" name="oldFile" value="{{ $dosen_tendik->profil_file }}">
				<div class="invalid-feedback d-none"></div>
				@error('profil_file')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			<button type="submit" class="btn btn-warning">Update</button>
			<a href="/admin/dosen_tendik" type="button" class="btn btn-primary">Cancel</a>
		</form>
	</div>
	<script>
		function previewImage(element){
			var allowExtention = ['jpg','ico','jpeg','png','svg','gif']
			var ext = /^.+\.([^.]+)$/.exec(element.files[0].name)
			ext = (ext == null)?"":ext[1];
			var size = Math.round((element.files[0].size / 1024))
			parent = element.parentElement;
			var imgPreview = parent.querySelector('.img-preview');

			if(allowExtention.includes(ext)){
				if(size <= 2000){
					element.classList.remove('is-invalid')
					var err = parent.querySelector('.invalid-feedback')
					err.classList.add('d-none')
					const image = parent.querySelector('#image');
					imgPreview.style.display = 'block';

					const oFReader = new FileReader();
					oFReader.readAsDataURL(image.files[0]);

					oFReader.onload = function(oFREvent) {
						imgPreview.src = oFREvent.target.result;
					}
				}else{
					var err = parent.querySelector('.invalid-feedback')
					err.classList.remove('d-none')
					err.innerHTML = 'The image failed to upload'
					element.value = ''
					element.classList.add('is-invalid')
					imgPreview.style.display = 'none';
					imgPreview.removeAttribute('src')
				}
				
			}else{
				imgPreview.style.display = 'none';
				imgPreview.removeAttribute('src')
				var err = parent.querySelector('.invalid-feedback')
				err.classList.remove('d-none')
				err.innerHTML = 'The image mut be a file of type: jpg, jpeg, png, ico, svg, gif.'
				element.value = ''
				element.classList.add('is-invalid')
			}
		}
		function checkPdf(element){
			var ext = /^.+\.([^.]+)$/.exec(element.files[0].name)
			ext = (ext == null)?"":ext[1];
			var size = Math.round((element.files[0].size / 1024))
			var err = element.parentElement.querySelector('.invalid-feedback')

			if(ext != 'pdf'){
				element.value = ''
				err.classList.remove('d-none')
				err.innerHTML = 'The profil file must be a file of type: pdf.'
				element.classList.add('is-invalid')
			}else if(size >= 2000){
				element.value = ''
				err.classList.remove('d-none')
				err.innerHTML = 'The profil file failed to upload.'
				element.classList.add('is-invalid')
			}else{
				err.classList.add('d-none')
				element.classList.remove('is-invalid')
			}
		}

		function categorys(element){
			parent = element.parentElement.parentElement;

			if(element.value == 'Tendik'){
				parent.querySelector('#dosen').classList.add('d-none')
				var inp = parent.querySelector('#dosen').querySelectorAll('input')
				inp.forEach(function(item){
					if(item.type != 'hidden'){
						item.value = ''
					}
				})
			}else if(element.value == 'Dosen'){
				parent.querySelector('#dosen').classList.remove('d-none')
			}
		}
	</script>
@endsection