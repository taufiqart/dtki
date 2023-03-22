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
		<link rel="stylesheet" href="/css/bootstrap.css">
		<link rel="stylesheet" href="/css/animate.css">
		<link rel="stylesheet" href="/css/update.css">
		@if(!empty($owl))
			<link rel="stylesheet" href="/css/style.all.css">
			<link rel="stylesheet" href="/css/owl.carousel.min.css">
			<link rel="stylesheet" href="/css/owl.theme.default.min.css">
		@endif
		@if(!empty($satki))
			<link rel="stylesheet" href="/css/custom.css">
			<link href="/css/sb-admin-2.min.css" rel="stylesheet">
		@endif
		<link rel="stylesheet" href="/css/style.css">
		<link rel="stylesheet" href="/css/animate.css">
		<link rel="stylesheet" href="/css/navAndFooter.css">
		<link rel="stylesheet" href="/css/fontawesome/css/all.min.css">
	</head>
	{{-- Bootstrap Icons --}}
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
	
	<body class="{{ !empty($satki) ? 'bg-primary bg-anim' : ''}} min-vh-100 d-flex flex-column" style="background:#f5f5f5f5;">
		@include('partials.navbar')
		@if(!empty($profile) || !empty($satki) || !empty($laboratorium))
			@yield('container')
		@else
			<div class="container p-sm-4 p-md-5" style="max-width: 1100px; margin: 0 auto;">
				<div class="row">
					<form class="col-12 my-2 ms-auto" action="{{ $url }}" method="get">
						@if(!empty($filter))
						<div class="row justify-content-end">
							<div class="col-4 col-md-2 my-4 ms-auto">
								@if(!empty($category))
								<select class="form-control form-select bg-light border-1" name="category" id="category" >
									<option value="">Category</option>
									<option {{ request('category') == 'Dosen' ? 'selected' : '' }} value="Dosen">Dosen</option>
									<option {{ request('category') == 'Tendik' ? 'selected' : '' }} value="Tendik">Tendik</option>
									<option {{ request('category') == 'Mahasiswa' ? 'selected' : '' }} value="Mahasiswa">Mahasiswa</option>
								</select>
								@elseif(!empty($tahun))
								<select class="form-control form-select bg-light border-1" name="tahun" id="category" >
									<option value="">--tahun--</option>
									@foreach ($tahun as $data)
										<option {{ request('tahun') == $data ? 'selected' : '' }} value="{{ $data }}">{{ $data }}</option>
									@endforeach
								</select>
								@endif
							</div>
							<div class="col-8 col-md-5 my-4">
								<div class="input-group">
									<input id="search" type="text" class="form-control bg-light border-1"  placeholder="Search for..." name="search" value="{{ request('search') }}">
									<div class="input-group-append">
										<button class="btn btn-primary" type="submit">
											<i class="fas fa-search fa-sm"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
						@else
						<div class="col-md-5 my-4 ms-auto">
							<div class="input-group">
								@if(request('category'))
								<input type="hidden" value="{{ request('category') }}" name="category" id="category">
								@endif
								<input id="search" type="text" class="form-control bg-light border-1 small" placeholder="Search for..." name="search" value="{{ request('search') }}">
								<div class="input-group-append">
									<button class="btn btn-primary" type="submit">
										<i class="fas fa-search fa-sm"></i>
									</button>
								</div>
							</div>
						</div>
						@endif
					</form>
					<div class="p-3">
						<div id="data" class="m-auto {{ empty($show)?'content-rounded':'' }} {{ empty($data_alumni) ? 'row justify-content-space-evenly' : '' }}">
							@if(!empty($ajax))
							@include($view)
							@else
							@yield('container')
							@endif
						</div>
					</div>
				</div>
			</div>
		@endif
		@include('partials.footer')
	</body>
	<script type="text/javascript" src="/js/jquery.min.js"></script>
	@if(!empty($owl))
		<script type="text/javascript" src="/js/new-test.js"></script>
		<script type="text/javascript" src="/js/active.js"></script>
	@endif
	<script src="/js/script.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script>
		@if(empty($satki))
			navbarAnim();
		@endif
		window.onload = () => {
			scrollbar();
			animate();
		}

		@if(empty($show))
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

			@if(!empty($filter))
				$('#category').change(function(){
					var category = $(this).val()
					fetch_data(category)
				})
			@endif
				function fetch_data(category='',search='', page=''){
					var path = window.location.pathname
					@if(!empty($data_alumni))
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
		@endif
	</script>
</html>