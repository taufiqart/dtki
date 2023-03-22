@extends('admin.layouts.main')

@section('container')
	<div class="col-lg-8-">
		<form method="post" action="/admin/profile/departemen/" enctype="multipart/form-data">
			@method('put')
			@csrf
			<div class="mb-3">
				<label for="title" class="form-label">Title</label>
				<input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title', $isi["title"]) }}">
				@error('title')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="image" class="form-label">Image</label>
				@if ($isi["foto"])
					<img src="{{ $isi["foto"] }}" alt="" class="img-preview img-fluid mb-3 col-md-5 d-block">
				@else
					<img src="" alt="" class="img-preview img-fluid mb-3 col-md-5 d-block">
				@endif
				<input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="img[]" onchange="previewImage(this)">
				@error('image')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
				<input type="hidden" class="urlImage" name="image" value="{{ $isi["foto"] }}">
				<input type="hidden" class="oldImage" name="oldImage[]" value="">
			</div>
			<div class="mb-3">
				<label for="body" class="form-label">Body</label>
				@error('body')
					<p class="text-danger">{{ $message }}</p>
				@enderror
				<input id="body" type="hidden" name="body" value="{{ old('body', $isi["text"]) }}">
	  			<trix-editor input="body"></trix-editor>
			</div>
			<hr>
			<div class="mb3">
				<div class="widget_title">Kontak</div>
				<label class="form-label" for="alamat"><i class="fa fa-home"></i> Alamat :</label>
				<textarea class="form-control" type="text" id="alamat" name="alamat">{!! $isi["alamat"] !!}</textarea>
				<label class="form-label" for="telepon"><i class="fa fa-phone"></i> Telepon :</label>
				<p>add &lt;br&gt; for enter</p>
				<input class="form-control" id="telepon" type="text" name="telepon" value="{!! $isi["telepon"] !!}">
				<label class="form-label" for="email"><i class="fa fa-envelope"></i> Email :</label>
				<input class="form-control" id="email" type="text" name="email" value="{!! $isi["email"] !!}">
				<label class="form-label" for="website"><i class="fa fa-desktop"></i> Website :</label>
				<input class="form-control" id="website" type="text" name="website" value="{!! $isi["website"] !!}">
				<label class="form-label" for="sosmed">Media Sosial :</label>
				<ul id="sosmed">
					@foreach($isi["sosmed"] as $sosmed)
					<li class="d-inline" id="sosmed">
						<div class="card rounded p-2 mb-2">
							<label class="form-label" for="sosmed-title">sosmed title</label>
							<input class="form-control" id="sosmed-title" type="text" name="sosmed-title[]" value="{{ $sosmed["title"] }}">
							<label class="form-label" for="sosmed-url">sosmed url</label>
							<input class="form-control" id="sosmed-url" type="text" name="sosmed-url[]" value="{{ $sosmed["url"] }}">
							<label class="form-label" for="sosmed-icon">icon sosmed</label>
							<input class="form-control" id="sosmed-icon" type="text" name="sosmed-icon[]" value="{{ $sosmed["icon"] }}">
							<div class="mb-2">
								<div class="d-flex justify-content-end align-items-center">
									<button type="button" class="btn btn-primary m-1 d-inline-block" onclick="addnew(this,'sosmed')">
										<i class="fas fa-w fa-plus"></i>
									</button>
									<button type="button" class="btn btn-danger m-1 fa-w d-inline-block" onclick="del(this,'sosmed')">
										<i class="fas fa-trash"></i>
									</button>
								</div>
							</div>
						</div>
					</li>
					@endforeach
					<p>get icon on <a href="https://fontawesome.com/v5/search">this</a></p>
				</ul>
			</div>
			<hr>
			<h3>Galery</h3>
			@foreach($galerys as $galery)
				<div class="mb-3 card rounded" id="galery">
					<div class="p-3">
						<div class="mb-2">
							<label for="image" class="form-label">Galery Image</label>
							@if ($galery["foto"])
								<img src="{{ $galery["foto"] }}" alt="" class="img-preview img-fluid mb-3 col-md-5 d-block">
							@else
								<img src="" alt="" class="img-preview img-fluid mb-3 col-md-5 d-block">
							@endif
							<input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="img[]" onchange="previewImage(this)">
							@error('galery-image')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
							@enderror
							<input id="galery-image" type="hidden" class="urlImage" name="galery-image[]" value="{{ $galery["foto"] }}">
							<input type="hidden" class="oldImage" name="oldImage[]" value="">						
						</div>
						<div class="mb-2">
							<label for="galery-title" class="form-label">Galery Title</label>
							<input class="form-control @error('title') is-invalid @enderror" type="text" id="galery-title" name="galery-title[]" value="{{ old('galery-title', $galery["title"]) }}">
							@error('galery-title')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
							@enderror
						</div>
						<div class="mb-2">
							<div class="d-flex justify-content-end align-items-center">
								<button type="button" class="btn btn-primary m-1 d-inline-block" onclick="addnew(this,'galery')">
									<i class="fas fa-w fa-plus"></i>
								</button>
								<button type="button" class="btn btn-danger m-1 fa-w d-inline-block" onclick="del(this,'galery')">
									<i class="fas fa-trash"></i>
								</button>
							</div>
						</div>
					</div>
				</div>
			@endforeach
			<button type="submit" class="btn btn-success">Submit</button>
			<a href="/admin/profile/departemen" type="button" class="btn btn-primary">Cancel</a>
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
				err.innerHTML = 'The image mut be a file of type: jpg, jpeg, png, svg, gif.'
				element.value = ''
				element.classList.add('is-invalid')
			}
		}
		function addnew(element,param){
			element = element.parentElement.parentElement.parentElement.parentElement
			var x = element.parentElement;
			var clone = element.cloneNode(true);
			var newElem = ''
			if(param == 'galery'){
				clone.querySelector('.img-preview').removeAttribute('src')
				clone.querySelector('#image').value = ''
				clone.querySelector('.urlImage').value = ''
				clone.querySelector('.oldImage').value = ''
				clone.querySelector('#galery-title').value = ''
			}else if(param == 'sosmed'){
				clone.querySelector('#sosmed-title').value = ''
				clone.querySelector('#sosmed-url').value = ''
				clone.querySelector('#sosmed-icon').value = ''
			}
			
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


