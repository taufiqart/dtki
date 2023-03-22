<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=.8">
		<meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate">
		<meta http-equiv="expires" content="0">
		<meta http-equiv="pragma" content="no-cache">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>{{ $title }}</title>
		<link rel="icon" href="/img/Lambang-DTKI-32x32.png">
		<link rel="stylesheet" href="/css/sb-admin-2.min.css">
		<link rel="stylesheet" href="/css/bootstrap.css">
		<link rel="stylesheet" href="/css/update.css">
		<link rel="stylesheet" href="/css/animate.css">
		<link rel="stylesheet" href="/css/style.css">
		<link rel="stylesheet" href="/css/fontawesome/css/all.min.css">
	</head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
	
	<style>
		.nav-item>div>div{
			overflow: scroll;
		}
		.nav-item>div>div::-webkit-scrollbar{
			height: 8px;		
			background: transparent;
		}
		.nav-item>div>div::-webkit-scrollbar-track,
		.nav-item>div>div::-webkit-scrollbar-corner{
			background: transparent;
		}
		.nav-item>div>div::-webkit-scrollbar-thumb{
			background: green;
			border-radius: 2px;
		}
	</style>

	<body id="page-top" class="sidebar-toggled">
		<div id="wrapper">
			@include('admin.layouts.sidebar')
			<div id="content-wrapper" class="d-flex flex-column">
				<div id="content">
					@include('admin.layouts.header')	
					<div class="container-fluid">
						<div class="d-flex justify-content-space-start align-items-center pt-3 pb-2 mb-3 border-bottom text-break">
							@if(!empty($url_back))
							<a href="{{ $url_back }}" class="btn btn-primary text-white mr-3 p-3"><i class="fas fa-arrow-left"></i></a>
							@endif
							<h1 class="m-0 p-0 h2 ">{{ $title }}</h1>
						</div>
						<div class="row justify-content-center">
							<div class="col-lg-10">
								<div class="row justify-content-center table-scroll">
									@if (session()->has('success'))
										<div class="alert alert-success" role="alert">
											{{ session('success') }}
										</div>
									@endif
									@if (session()->has('error'))
										<div class="alert alert-danger" role="alert">
											{{ session('error') }}
										</div>
									@endif
									@if(!empty($search))
									<form class="row justify-content-space-between col-md-8" method="get" action="{{ $url }}">
										<div class="col-2 col-sm-2 align-items-center m-0 p-2">
											<a href="{{ $url }}/create" class="btn btn-primary form-control text-white"><i class="fas fa-plus"></i><div class="ms-1 d-none d-lg-inline">Add</div></a>
										</div>
										@if(!empty($category))
										<div class="col-4 col-sm-3 m-0 p-2">
											<select class="form-select form-control" name="category" id="category">
												<option value="">Category</option>
												<option {{ request('category') == 'Dosen' ? 'selected' : '' }} value="Dosen">Dosen</option>
												<option {{ request('category') == 'Tendik' ? 'selected' : '' }} value="Tendik">Tendik</option>
												@if(empty($dosen_tendik))
												<option {{ request('category') == 'Mahasiswa' ? 'selected' : '' }} value="Mahasiswa">Mahasiswa</option>
												@endif
											</select>
										</div>
										@endif
										@if(!empty($tahun))
										<div class="col-4 col-sm-3 m-0 p-2">
											<select class="form-select form-control" name="tahun" id="category" aria-label=".form-select-sm example">
												<option value="">Tahun</option>
												@foreach ($tahun as $data)
													<option {{ request('tahun') == $data ? 'selected' : '' }} value="{{ $data }}">{{ $data }}</option>
												@endforeach
											</select>
										</div>
										@endif
										<div class="col-12 col-sm-7 m-0 p-2">
											<div class="input-group">
												<input type="text" class="form-control bg-light border-1 small" id="search" name="search" placeholder="Search for..."
													aria-label="Search" aria-describedby="basic-addon2" value="{{ request('search') }}">
												<div class="input-group-append">
													<button class="btn btn-primary" type="submit">
														<i class="fas fa-search fa-sm"></i>
													</button>
												</div>
											</div>
										</div>
									</form>
									<div id="data">
										@include($view)
									</div>
									@else
									@yield('container')
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
				<footer class="sticky-footer bg-white">
					<div class="container my-auto">
						<div class="copyright text-center my-auto">
							<span>Copyright &copy; Your Website 2020</span>
						</div>
					</div>
				</footer>
			</div>
		</div>
		<a class="scroll-to-top rounded" href="#page-top">
			<i class="fas fa-angle-up"></i>
		</a>
		<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
						<form action="/admin/logout" method="post">
							@csrf
							<button type="submit" class="btn btn-primary"></i> Logout</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<script src="/js/jquery.min.js"></script>
		<script src="/js/bootstrap.bundle.min.js"></script>
		<script src="/js/bootstrap.js"></script>

		<!-- Core plugin JavaScript-->
		<script src="/js/jquery.easing.min.js"></script>

		<!-- Custom scripts for all pages-->
		<script src="/js/sb-admin-2.min.js"></script>

	</body>
	<script>
		$(document).ready(function(){
			$(document).on('click', '.pagination a', function(event){
				event.preventDefault();
				var page = $(this).attr('href').split('page=')[1];
				var category = $('#category').val()
				var search = $('#search').val()
				fetch_data(category,search,page)
			})

			$('#search').on('keyup',function(){
				var category = $('#category').val()
				var search = $(this).val()
				fetch_data(category,search)
			})

			$('#category').change(function(){
				var tahun = $(this).val()
				fetch_data(tahun)
			})
			function fetch_data(category='',search='', page=''){
				var path = window.location.pathname
				@if(!empty($tahun))
				var url = `${path}?s=true&tahun=${category}&search=${search}&page=${page}`
				@else
				var url = `${path}?s=true&category=${category}&search=${search}&page=${page}`
				@endif
				$.ajax({
					url:url,
					success:function(data){
						$('#data').html(data)
					}
				})
			}
		})
	</script>
	<script src="/tinymce/js/tinymce/tinymce.min.js"></script>
	{{-- <script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/5-stable/tinymce.min.js"></script> --}}
	<script data-name="editor tinymce">		
		var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

		tinymce.init({
			selector: 'textarea#editor',
			plugins: 'print preview powerpaste casechange importcss searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media template codesample table charmap hr toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap mentions quickbars linkchecker emoticons advtable export',
			mobile: {
				plugins: 'print preview powerpaste casechange importcss searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media template codesample table charmap hr toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap mentions quickbars linkchecker emoticons advtable'
			},
			menubar: 'file edit view insert format tools table tc help',
			toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen preview save print | image media pageembed link anchor codesample | ltr rtl',
			fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
			importcss_append: true,
			template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
			template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
			height: 600,
			toolbar_mode: 'sliding',
		});
	</script>
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
				err.innerHTML = 'The image must be a file of type: jpg, jpeg, png, svg, gif.'
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
	</script>
</html>