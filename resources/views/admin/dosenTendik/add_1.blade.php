@extends('admin.layouts.main')

@section('container')
	<div class="col-lg-8">
		<form method="post" action="/admin/dosen_tendik/" enctype="multipart/form-data">
			{{-- @method('put') --}}
			@csrf
			<div id="inputData" class="card rounded p-2 mb-3">
				<div class="mb-3">
					<label for="category" class="form-label">Category</label>
					<select class="form-select form-select-sm form-control" onchange="categorys(this)" name="category[]" id="category" aria-label=".form-select-sm example">
						<option value="Dosen">Dosen</option>
						<option value="Tendik">Tendik</option>
					</select>
				</div>
				<div class="mb-3">
					<label for="image" class="form-label">Image</label>
					<img src="" alt="" class="img-preview img-fluid mb-3 col-md-5 d-block">
					<input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image[]" onchange="previewImage(this)">
					@error('image')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
					@enderror
				</div>
				<div class="mb-3">
					<label for="nama" class="form-label">Nama</label>
					<input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama[]" required autofocus value="{{ old('nama') }}">
					@error('nama')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
					@enderror
				</div>
				<div class="mb-3">
					<label for="nip" class="form-label">Nip</label>
					<input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip[]" required autofocus value="{{ old('nip') }}">
					@error('nip')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
					@enderror
				</div>
				<div class="mb-3">
					<label for="email" class="form-label">Email</label>
					<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email[]" autofocus value="{{ old('email') }}">
					@error('email')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
					@enderror
				</div>
				<div id="dosen">
					<div class="mb-3">
						<label for="jabatan" class="form-label">Gol./ Jabatan</label>
						<input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan[]" autofocus value="{{ old('jabatan') }}">
						@error('jabatan')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
					<div class="mb-3">
						<label for="profil" class="form-label">Profil</label>
						<div class="card rounded p-2 mb-2">
							<label class="profil-sinta" for="profil-sinta">Profil Sinta</label>
							<input type="text" class="form-control @error('profil') is-invalid @enderror" id="profil-sinta" name="profil-sinta[]" autofocus value="{{ old('profil') }}">
							@error('profil-sinta')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
							@enderror
							<label class="form-label" for="profil-scholar">Profil Google Scholar</label>
							<input type="text" class="form-control @error('profil') is-invalid @enderror" id="profil-scholar" name="profil-scholar[]" autofocus value="{{ old('profil') }}">
							@error('profil-scholar')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
							@enderror
							<label for="profil-pdf" class="form-label">Profil file .pdf</label>
							<input class="form-control @error('image') is-invalid @enderror" type="file" id="profil-pdf" name="profil-pdf[]">
							@error('profil-pdf')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
							@enderror
						</div>
					</div>
				</div>
				<div class="mb-3">
					<div class="d-flex justify-content-end align-items-center">
						<button type="button" class="btn btn-primary m-1 d-inline-block" onclick="addnew(this)">
							<i class="fas fa-w fa-plus"></i>
						</button>
						<button type="button" class="delete-btn d-none btn btn-danger m-1 fa-w d-inline-block" onclick="del(this)">
							<i class="fas fa-trash"></i>
						</button>
					</div>
				</div>
			</div>
			<button type="submit" class="btn btn-success">Submit</button>
			<a href="/admin/dosen_tendik" type="button" class="btn btn-primary">Cancel</a>
		</form>
	</div>
	<script>
		function previewImage(element){
			element = element.parentElement;
			const image = element.querySelector('#image');
			const imgPreview = element.querySelector('.img-preview');
			imgPreview.style.display = 'block';

			const oFReader = new FileReader();
			oFReader.readAsDataURL(image.files[0]);

			oFReader.onload = function(oFREvent) {
				imgPreview.src = oFREvent.target.result;
			}
		}

		function categorys(element){
			parent = element.parentElement.parentElement;
			if(element.value == 'Tendik'){
				parent.querySelector('#dosen').classList.add('d-none')
			}else if(element.value == 'Dosen'){
				parent.querySelector('#dosen').classList.remove('d-none')
			}
		}

		function addnew(element, param){

			// if(param == 'inputData'){
				element = element.parentElement.parentElement.parentElement;
				var x = element.parentElement;
				var clone = element.cloneNode(true);
				var delBtn = document.querySelectorAll('#inputData')
				delBtn[0].querySelector('.delete-btn').classList.remove('d-none')

				clone.querySelector('.img-preview').removeAttribute('src')
				clone.querySelector('#dosen').classList.remove('d-none')
				clone.querySelector('.delete-btn').classList.remove('d-none')
				var input = clone.querySelectorAll('input')
				input.forEach(function(item){
					item.value = ''
				})
				
				x.insertBefore(clone,element.nextSibling);

			// }else if(param == 'profil'){
			// 	element = element.parentElement.parentElement.parentElement.parentElement
			// 	var x = element.parentElement
			// 	var clone = element.cloneNode(true);
			// 	var delBtn = document.querySelectorAll('#profil')
			// 	delBtn[0].querySelector('.delete-btn').classList.remove('d-none')
			// 	var input = clone.querySelectorAll('input')
			// 	input.forEach(function(item){
			// 		item.value = ''
			// 	})
			// 	x.insertBefore(clone,element.nextSibling);

			// }
		}

		function del(element){
			element = element.parentElement.parentElement.parentElement;
			var check = false

			if(element.querySelector('.img-preview').src != ''){ check = true }

			var input = element.querySelectorAll('input')
			input.forEach(function(item){
				if(item.value != ''){check = true}
			})
			// if(element.querySelector('#category').value == 'Dosen'){ check = true}
			
			if(check == false){
				element.remove()
			}else{
				if(confirm('Are you sure to delete?')){ element.remove() }
			}
			var delBtn = document.querySelectorAll('#inputData')
			if(delBtn.length == 1){
				delBtn[0].querySelector('.delete-btn').classList.add('d-none')
			}

		}
	</script>
@endsection