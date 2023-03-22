@extends('admin.layouts.main')

@section('container')
	<div class="col-lg-8-">
		<form method="post" action="{{ $url }}" enctype="multipart/form-data">
			@method('put')
			@csrf
			<div class="btn-primary ps-3 rounded mb-3">Kepala Lab</div>
			<div class="main_body" id="kepala">
				<div class="card m-1 animated mb-3">
					<div class="row g-0 justify-content-center align-items-center">
						<div class="col-md-4 col-lg-3 text-center ps-md-2 ps-sm-0">
							<div class="">
							@if ($kepala["image"])
								<label for="image" class="form-label image-label"></label>
								<img src="{{ $kepala["image"] }}" class="img-preview col-md-5 card-img-top img-thumbnail rounded-circle m-auto" id="image" style="width: 200px;">
							@else
								<label for="image" class="form-label image-label">Image</label>
								<img class="img-preview col-md-5 card-img-top img-thumbnail rounded-circle m-auto" style="width: 200px;display:none;">
							@endif
								<input style="width: 80%; text-align: center; margin: auto;" class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image[]" onchange="previewImage(this)">
							<br>
							<div class="d-none invalid-feedback"></div>
							@error('image')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
							@enderror
							<input type="hidden" class="oldImage" name="oldImage[]" value="{{ $kepala["image"] }}">	
							</div>
						</div>
						<div class="col-md-8">
							<div class="card-body">
								<table>
									<tbody>
										<tr>
											<td><label for="nama">Nama</label></td>
											<td width="20" align="center">:</td>
											<td><input type="text" value="{{ $kepala["nama"] }}" autofocus></td>
										</tr>
										<tr>
											<td><label for="nip">Nip</label></td>
											<td width="20" align="center">:</td>
											<td><input type="text" value="{{ $kepala["nip"] }}"></td>
										</tr>
										<tr>
											<td><label for="email">Email</label></td>
											<td width="20" align="center">:</td>
											<td><input type="email" value="{{ $kepala["email"] }}"></td>
										</tr>
										<tr>
											<td><label for="jabatan">Jabatan</label></td>
											<td width="20" align="center">:</td>
											<td><input type="text" value="{{ $kepala["jabatan"] }}"></td>
										</tr>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			{{-- <div class="mb-3 card rounded" id="kepala">
			</div> --}}
			{{-- <div class="mb-3 card rounded" id="kepala">
				<div class="p-3">
					<div class="mb-2">
						<label for="image" class="form-label">Image</label>
						@if ($kepala["image"])
							<img src="{{ $kepala["image"] }}" alt="" class="img-preview img-fluid mb-3 col-md-5 d-block">
						@else
							<img src="" alt="" class="img-preview img-fluid mb-3 col-md-5 d-block">
						@endif
						<input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image[]" onchange="previewImage(this)">
						@error('image')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
						<input type="hidden" class="oldImage" name="oldImage[]" value="{{ $kepala["image"] }}">						
					</div>
					<div class="mb-2">
						<label for="nama" class="form-label">Nama</label>
						<input class="form-control @error('title') is-invalid @enderror" type="text" id="nama" name="nama[]" value="{{ old('nama', $kepala["nama"]) }}" required autofocus>
						@error('nama')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
					<div class="mb-2">
						<label for="nip" class="form-label">Nip</label>
						<input class="form-control @error('title') is-invalid @enderror" type="text" id="nip" name="nip[]" value="{{ old('nip', $kepala["nip"]) }}" required autofocus>
						@error('nip')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
					<div class="mb-2">
						<label for="email" class="form-label">Email</label>
						<input class="form-control @error('title') is-invalid @enderror" type="email" id="email" name="email[]" value="{{ old('email', $kepala["email"]) }}">
						@error('email')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
					<div class="mb-2">
						<label for="jabatan" class="form-label">Gol./Jabatan</label>
						<input class="form-control @error('title') is-invalid @enderror" type="text" id="jabatan" name="jabatan[]" value="{{ old('jabatan', $kepala["jabatan"]) }}" required autofocus>
						@error('jabatan')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
				</div>
			</div> --}}
			<div class="btn-primary ps-3 rounded mb-3">Anggota Lab</div>
			@foreach($anggota as $data)
				<div class="main_body" id="anggota">
					<div class="card m-1 animated mb-3">
						<div class="row g-0 justify-content-center align-items-center">
							<div class="col-md-4 col-lg-3 text-center ps-md-2 ps-sm-0">
								<div class="">
								@if ($data["image"])
									<label for="image" class="form-label image-label"></label>
									<img src="{{ $data["image"] }}" class="img-preview col-md-5 card-img-top img-thumbnail rounded-circle m-auto" id="image" style="width: 200px;">
								@else
									<label for="image" class="form-label image-label">Image</label>
									<img class="img-preview col-md-5 card-img-top img-thumbnail rounded-circle m-auto" style="width: 200px;display:none;">
								@endif
									<input style="width: 80%; text-align: center; margin: auto;" class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image[]" onchange="previewImage(this)">
								<br>
								<div class="d-none invalid-feedback"></div>
								@error('image')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
								@enderror
								<input type="hidden" class="oldImage" name="oldImage[]" value="{{ $data["image"] }}">	
								</div>
							</div>
							<div class="col-md-8">
								<div class="card-body">
									<table>
										<tbody>
											<tr>
												<td><label for="nama">Nama</label></td>
												<td width="20" align="center">:</td>
												<td><input type="text" value="{{ $data["nama"] }}" autofocus></td>
											</tr>
											<tr>
												<td><label for="nip">Nip</label></td>
												<td width="20" align="center">:</td>
												<td><input type="text" value="{{ $data["nip"] }}"></td>
											</tr>
											<tr>
												<td><label for="email">Email</label></td>
												<td width="20" align="center">:</td>
												<td><input type="email" value="{{ $data["email"] }}"></td>
											</tr>
											<tr>
												<td><label for="jabatan">Jabatan</label></td>
												<td width="20" align="center">:</td>
												<td><input type="text" value="{{ $data["jabatan"] }}"></td>
											</tr>
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				{{-- <div class="mb-3 card rounded" id="anggota">
					<div class="p-3">
						<div class="mb-2">
							<label for="image" class="form-label">Image</label>
							@if ($data["image"])
								<img src="{{ $data["image"] }}" alt="" class="img-preview img-fluid mb-3 col-md-5 d-block">
							@else
								<img src="" alt="" class="img-preview img-fluid mb-3 col-md-5 d-block">
							@endif
							<input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image[]" onchange="previewImage(this)">
							@error('image')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
							@enderror
							<input type="hidden" class="oldImage" name="oldImage[]" value="{{ $data["image"] }}">						
						</div>
						<div class="mb-2">
							<label for="nama" class="form-label">Nama</label>
							<input class="form-control @error('title') is-invalid @enderror" type="text" id="nama" name="nama[]" value="{{ old('nama', $data["nama"]) }}" required autofocus>
							@error('nama')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
							@enderror
						</div>
						<div class="mb-2">
							<label for="nip" class="form-label">Nip</label>
							<input class="form-control @error('title') is-invalid @enderror" type="text" id="nip" name="nip[]" value="{{ old('nip', $data["nip"]) }}" required autofocus>
							@error('nip')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
							@enderror
						</div>
						<div class="mb-2">
							<label for="email" class="form-label">Email</label>
							<input class="form-control @error('title') is-invalid @enderror" type="email" id="email" name="email[]" value="{{ old('email', $data["email"]) }}">
							@error('email')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
							@enderror
						</div>
						<div class="mb-2">
							<label for="jabatan" class="form-label">Gol./Jabatan</label>
							<input class="form-control @error('title') is-invalid @enderror" type="text" id="jabatan" name="jabatan[]" value="{{ old('jabatan', $data["jabatan"]) }}" required autofocus>
							@error('jabatan')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
							@enderror
						</div>
						<div class="mb-2">
							<div class="d-flex justify-content-end align-items-center">
								<button type="button" class="btn btn-primary m-1 d-inline-block" onclick="addnew(this)">
									<i class="fas fa-w fa-plus"></i>
								</button>
								<button type="button" class="btn btn-danger m-1 fa-w d-inline-block" onclick="del(this)">
									<i class="fas fa-trash"></i>
								</button>
							</div>
						</div>
					</div>
				</div> --}}
			@endforeach
			<button type="submit" class="btn btn-success">Submit</button>
			<a href="{{ $url }}" type="button" class="btn btn-primary">Cancel</a>
		</form>
	</div>
	<script>

		document.addEventListener('trix-file-accept', function (e) {
			e.preferDefaut();
		});

		function previewImage(element){
			var allowExtention = ['jpg','jpeg','png','svg','gif']
			var ext = /^.+\.([^.]+)$/.exec(element.files[0].name)
			ext = (ext == null)?"":ext[1];
			var size = Math.round((element.files[0].size / 1024))
			parent = element.parentElement.parentElement.parentElement.parentElement;
			var imgPreview = parent.querySelector('.img-preview');

			if(allowExtention.includes(ext)){
				if(size <= 2000){
					element.classList.remove('is-invalid')
					var err = parent.querySelector('.invalid-feedback')
					err.classList.add('d-none')
					const label = parent.querySelector('.image-label');
					label.classList.add('d-none')
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
				err.innerHTML = 'The image mut be a file of type: jpg, jpeg, png, svg, gif.'
				element.value = ''
				element.classList.add('is-invalid')
			}
		}
		function addnew(element){
			element = element.parentElement.parentElement.parentElement.parentElement
			var x = element.parentElement;
			var clone = element.cloneNode(true);
			var newElem = ''
			clone.querySelector('.img-preview').removeAttribute('src')
			var input = clone.querySelectorAll('input')
			input.forEach(function(data){
				data.value = ''
			})
			
			x.insertBefore(clone,element.nextSibling);
		}

		function del(element,param){
			element = element.parentElement.parentElement.parentElement.parentElement
			var imgCheck = element.querySelector('.img-preview')
			var sosmedCheck = element.querySelector('.sosmed-title')
			var check = ''
			if(imgCheck != undefined){check = imgCheck.src}
			if(sosmedCheck != undefined){check = sosmedCheck.value}
			if(check == '' || check == ''){
				element.remove();
			}else{
				if(confirm('Are you sure to delete?')){
					if(param == 'galery'){
						var old = element.querySelector('.oldImage')
						var url = element.querySelector('.urlImage')
						if(old.value != ''){
							element.parentElement.appendChild(old)
						}else if(old.value == '' && url.value != ''){
							old.value = url.value
							element.parentElement.appendChild(old)
						}
					}
					element.remove();
				}
			}
		}
	</script>
@endsection


