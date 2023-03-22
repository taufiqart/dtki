@extends('admin.layouts.main')

@section('container')
	<div class="col-lg-8- p-3">
		<form method="post" action="{{ $url }}" enctype="multipart/form-data" class="content-rounded">
			@method('put')
			@csrf
			<div class="mb-3">
				<label for="alamat" class="form-label">Alamat</label>
				<input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"  autofocus value="{{ old('alamat', $data->alamat??null) }}">
				@error('alamat')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="telepon" class="form-label">Telepon</label>
				<input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon"  autofocus value="{{ old('telepon', $data->telepon??null) }}">
				@error('telepon')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="email" class="form-label">Email</label>
				<input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"  autofocus value="{{ old('email', $data->email??null) }}">
				@error('email')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="website" class="form-label">Website</label>
				<input type="text" class="form-control @error('website') is-invalid @enderror" id="website" name="website"  autofocus value="{{ old('website', $data->website??null) }}">
				@error('website')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="media_sosial" class="form-label">Media Sosial</label>
				<ul id="sosmed">
					@if(!$data->media_sosial)
					<li class="d-inline" id="sosmed">
						<div class="card rounded p-2 mb-2">
							<label class="form-label" for="sosmed-title">sosmed title</label>
							<input class="form-control" id="sosmed-title" type="text" name="sosmed-title[]" value="">
							<label class="form-label" for="sosmed-url">sosmed url</label>
							<input class="form-control" id="sosmed-url" type="text" name="sosmed-url[]" value="">
							<label class="form-label" for="sosmed-icon">icon sosmed</label>
							<input class="form-control" id="sosmed-icon" type="text" name="sosmed-icon[]" value="">
							<div class="mb-2">
								<div class="d-flex justify-content-end align-items-center">
									<button type="button" class="btn btn-primary m-1 d-inline-block" onclick="addnew(this,'sosmed')">
										<i class="fas fa-w fa-plus"></i>
									</button>
									<button type="button" id="delete" class="btn btn-danger m-1 fa-w d-inline-block" onclick="del(this,'sosmed')">
										<i class="fas fa-trash"></i>
									</button>
								</div>
							</div>
						</div>
					</li>
					@else
					@foreach($data->media_sosial as $sosmed)
					<li class="d-inline" id="sosmed">
						<div class="card rounded p-2 mb-2">
							<label class="form-label" for="sosmed-title">sosmed title</label>
							<input class="form-control" id="sosmed-title" type="text" name="sosmed-title[]" value="{{ $sosmed["title"]??null }}">
							<label class="form-label" for="sosmed-url">sosmed url</label>
							<input class="form-control" id="sosmed-url" type="text" name="sosmed-url[]" value="{{ $sosmed["url"]??null }}">
							<label class="form-label" for="sosmed-icon">icon sosmed</label>
							<input class="form-control" id="sosmed-icon" type="text" name="sosmed-icon[]" value="{{ $sosmed["icon"]??null }}">
							<div class="mb-2">
								<div class="d-flex justify-content-end align-items-center">
									<button type="button" class="btn btn-primary m-1 d-inline-block" onclick="addnew(this,'sosmed')">
										<i class="fas fa-w fa-plus"></i>
									</button>
									<button type="button" id="delete" class="btn btn-danger m-1 fa-w d-inline-block" onclick="del(this,'sosmed')">
										<i class="fas fa-trash"></i>
									</button>
								</div>
							</div>
						</div>
					</li>
					@endforeach
					@endif
					<p>get icon on <a target="_blank" href="https://fontawesome.com/v5/search">this</a></p>
				</ul>
			</div>
			
			<button type="submit" class="btn btn-success">Submit</button>
			<a href="{{ $url }}" type="button" class="btn btn-primary">Cancel</a>
		</form>
	</div>
	<script>
		window.addEventListener('DOMContentLoaded', (event)=>{
			var check = document.querySelectorAll('#delete')
			console.log(check.length)
			console.log(check[0])
			if(check.length == 1){
				check[0].classList.remove('d-inline-block')
				check[0].classList.add('d-none')
			}else{
				check[0].classList.add('d-inline-block')
				check[0].classList.remove('d-none')
			}
		})
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
				clone.querySelector('#delete').classList.remove('d-none')
				clone.querySelector('#delete').classList.add('d-inline-block')
			}
			
			x.insertBefore(clone,element.nextSibling);
			var check = document.querySelectorAll('#delete')
			console.log(check.length)
			console.log(check[0])
			if(check.length == 1){
				check[0].classList.remove('d-inline-block')
				check[0].classList.add('d-none')
			}else{
				check[0].classList.add('d-inline-block')
				check[0].classList.remove('d-none')
			}
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
			var check = document.querySelectorAll('#delete')
			console.log(check.length)
			console.log(check[0])
			if(check.length == 1){
				check[0].classList.remove('d-inline-block')
				check[0].classList.add('d-none')
			}else{
				check[0].classList.add('d-inline-block')
				check[0].classList.remove('d-none')
			}
		}
	</script>
@endsection