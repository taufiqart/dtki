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
					<input class="form-control" type="file" id="image" name="image[]" onchange="previewImage(this)">
					<div class="d-none invalid-feedback">only image file</div>
				</div>
				<div class="mb-3">
					<label for="nama" class="form-label">Nama</label>
					<input type="text" class="form-control " id="nama" name="nama[]" required autofocus value="{{ old('nama') }}">
				</div>
				<div class="mb-3">
					<label for="nip" class="form-label">Nip</label>
					<input type="text" class="form-control" id="nip" name="nip[]" required autofocus value="{{ old('nip') }}">
					@error('nip')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
				<div class="mb-3">
					<label for="email" class="form-label">Email</label>
					<input type="email" class="form-control" id="email" name="email[]" autofocus value="{{ old('email') }}">
				</div>
				<div id="dosen">
					<div class="mb-3">
						<label for="jabatan" class="form-label">Gol./ Jabatan</label>
						<input type="text" class="form-control" id="jabatan" name="jabatan[]" autofocus value="{{ old('jabatan') }}">
					</div>
					<div class="mb-3">
						<label for="profil" class="form-label">Profil</label>
						<div class="card rounded p-2 mb-2">
							<label class="profil-sinta" for="profil-sinta">Profil Sinta</label>
							<input type="text" class="form-control" id="profil-sinta" name="profil-sinta[]" autofocus value="{{ old('profil') }}">
							<label class="form-label" for="profil-scholar">Profil Google Scholar</label>
							<input type="text" class="form-control" id="profil-scholar" name="profil-scholar[]" autofocus value="{{ old('profil') }}">
							<label for="profil-pdf" class="form-label">Profil file pdf</label>
							<input class="form-control" type="file" id="profil-pdf" onchange="checkPdf(this)" name="profil-pdf[]">
							<div class="d-none invalid-feedback">only pdf file</div>
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
			var allowExtention = ['jpg','ico','jpeg','png','svg']
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
					err.innerHTML = 'max image size 2mb'
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
				err.innerHTML = 'only image file'
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
				err.innerHTML = 'only pdf file'
				element.classList.add('is-invalid')
			}else if(size >= 2000){
				element.value = ''
				err.classList.remove('d-none')
				err.innerHTML = 'max file size 2mb'
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
					item.value = ''
				})
			}else if(element.value == 'Dosen'){
				parent.querySelector('#dosen').classList.remove('d-none')
			}
		}

		function addnew(element, param){

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