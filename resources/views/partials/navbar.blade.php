<header class="header">
	@if(empty($satki))
	<div class="container">
		<div class="brand py-2 d-flex justify-content-center align-items-center min-width-3">
			<img src="/img/Lambang-DTKI-180x180.png" width="120" class="logo-top" alt="">
			<div class="brand-text d-inline-block">
				<h1>Departemen Teknik Kimia Industri (DTKI)</h1>
				<h3>Institut Teknologi Sepuluh November</h3>
			</div>
		</div>	
	</div>
	@endif
	<style>
		.dropdown-item.active{
			color: #fff !important;
		}
	</style>
	<div id="navbar" class="shadow-sm {{ !empty($satki) ? 'fixed-top' : '' }}">
	<nav class="navbar navbar-expand-md navbar-dark bg-gradient ">
		<div class="container">
			<div title="Departemen Tekik Kimia Industri" class="{{ !empty($satki) ? '' : 'd-none' }} logo-navbar-image img-nav">
				<div class="flash">
					<div class="line"></div>
				</div>
				<a href="/"><img class="logo-navbar logo-navbar-m" style="width: 70px;" src="/img/Lambang-DTKI-180x180.png" alt="" class="mx-2"></a>
			</div>
			<a class="navbar-brand mx-2" title="Departemen Tekik Kimia Industri" href="/">{{ !empty($satki) ? 'DTKI' : 'Home' }}</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="ms-md-5 collapse navbar-collapse justify-content-end" id="navbarNav">
				<ul class="navbar-nav d-edit text-md-end">
					<li class="d-lg-inline dropdown">
						<a class="d-lg-inline p-lg-2 m-lg-0 nav-link dropdown-toggle {{ Request::is('profile*')? 'active' :'' }}" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Profile
						</a>
						<ul class="mt-2 dropdown-menu bg-light-green text-black" aria-labelledby="navbarDropdownMenuLink">
							<li><a class="dropdown-item bg-transparent dropdown-edit {{ Request::is('profile/departemen')? 'active' :'' }}" href="/profile/departemen">Departemen</a></li>
							<li><a class="dropdown-item bg-transparent dropdown-edit {{ Request::is('profile/dosen')? 'active' :'' }}" href="/profile/dosen">Dosen</a></li>
							<li><a class="dropdown-item bg-transparent dropdown-edit {{ Request::is('profile/tendik')? 'active' :'' }}" href="/profile/tendik">Tendik</a></li>
						</ul>
					</li>
					<li class="d-lg-inline dropdown">
						<!-- <a class="d-lg-inline p-lg-2 m-lg-0 nav-link" href="/satki/login">SATKI</a> -->
						<a class="d-lg-inline p-lg-2 m-lg-0 nav-link {{ Request::is('satki')? 'active' :'' }}" href="/satki">SATKI</a>
					</li>
					<li class="d-lg-inline dropdown">
						<a class="d-lg-inline p-lg-2 m-lg-0 nav-link dropdown-toggle {{ Request::is('laboratorium*')? 'active' :'' }}" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Laboratorium
						</a>
						<ul class="mt-2 dropdown-menu bg-light-green text-black" aria-labelledby="navbarDropdownMenuLink">
							<li><a class="dropdown-item bg-transparent dropdown-edit {{ Request::is('laboratorium/1')? 'active' :'' }} {{ Request::is('laboratorium/process-operating-system-laboratory')? 'active' :'' }}" href="/laboratorium/process-operating-system-laboratory">Process Operating System Laboratory</a></li>
							<li><a class="dropdown-item bg-transparent dropdown-edit {{ Request::is('laboratorium/2')? 'active' :'' }} {{ Request::is('laboratorium/industrial-biotechnology-laboratory')? 'active' :'' }}" href="/laboratorium/industrial-biotechnology-laboratory">Industrial Biotechnology Laboratory</a></li>
							<li><a class="dropdown-item bg-transparent dropdown-edit {{ Request::is('laboratorium/3')? 'active' :'' }} {{ Request::is('laboratorium/applied-chemistry-laboratory')? 'active' :'' }}" href="/laboratorium/applied-chemistry-laboratory">Applied Chemistry Laboratory</a></li>
							<li><a class="dropdown-item bg-transparent dropdown-edit {{ Request::is('laboratorium/4')? 'active' :'' }} {{ Request::is('laboratorium/industrial-chemical-process-laboratory')? 'active' :'' }}" href="/laboratorium/industrial-chemical-process-laboratory">Industrial Chemical Process Laboratory</a></li>
						</ul>
					</li>
					<li class="d-lg-inline dropdown">
						<a class="d-lg-inline p-lg-2 m-lg-0 nav-link dropdown-toggle {{ Request::is('penelitian*')? 'active' :'' }}" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Penelitian
						</a>
						<ul class="mt-2 dropdown-menu bg-light-green text-black" aria-labelledby="navbarDropdownMenuLink">
							<li><a class="dropdown-item bg-transparent dropdown-edit {{ Request::is('penelitian*') && strtolower(Request::get('category')) == 'dosen'? 'active' :'' }}" href="/penelitian?category=dosen">Dosen</a></li>
							<li><a class="dropdown-item bg-transparent dropdown-edit {{ Request::is('penelitian*') && strtolower(Request::get('category')) == 'tendik'? 'active' :'' }}" href="/penelitian?category=tendik">Tendik</a></li>
							<li><a class="dropdown-item bg-transparent dropdown-edit {{ Request::is('penelitian*') && strtolower(Request::get('category')) == 'mahasiswa'? 'active' :'' }}" href="/penelitian?category=mahasiswa">Mahasiswa</a></li>
						</ul>
					</li>
					<li class="d-lg-inline dropdown">
						<a class="d-lg-inline p-lg-2 m-lg-0 nav-link dropdown-toggle {{ Request::is('pengabdian-masyarakat*')? 'active' :'' }}" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Pengabdian Masyarakat
						</a>
						<ul class="mt-2 dropdown-menu bg-light-green text-black" aria-labelledby="navbarDropdownMenuLink">
							<li><a class="dropdown-item bg-transparent dropdown-edit {{ Request::is('pengabdian-masyarakat*') && strtolower(Request::get('category')) == 'dosen'? 'active' :'' }}" href="/pengabdian-masyarakat?category=dosen">Dosen</a></li>
							<li><a class="dropdown-item bg-transparent dropdown-edit {{ Request::is('pengabdian-masyarakat*') && strtolower(Request::get('category')) == 'tendik'? 'active' :'' }}" href="/pengabdian-masyarakat?category=tendik">Tendik</a></li>
							<li><a class="dropdown-item bg-transparent dropdown-edit {{ Request::is('pengabdian-masyarakat*') && strtolower(Request::get('category')) == 'mahasiswa'? 'active' :'' }}" href="/pengabdian-masyarakat?category=mahasiswa">Mahasiswa</a></li>
						</ul>
					</li>
					<li class="d-lg-inline dropdown">
						<a class="d-lg-inline p-lg-2 m-lg-0 nav-link dropdown-toggle {{ Request::is('alumni*')? 'active' :'' }}" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Alumni
						</a>
						<ul class="mt-2 dropdown-menu bg-light-green text-black" role="menu" aria-labelledby="dropdownMenu">
							{{-- <li class=""><span class="dropdown-item bg-transparent dropdown-edit dropdown-toggle">Data Alumni</span>
								<ul class="submenu px-4">
									<li><a class="dropdown-item bg-transparent dropdown-edit" href="/alumni/data-angkatan-1">Angkatan 1</a></li>
									<li><a class="dropdown-item bg-transparent dropdown-edit" href="/alumni/data-angkatan-2">Angkatan 2</a></li>
								</ul>
							</li> --}}
							<li><a class="dropdown-item bg-transparent dropdown-edit {{ Request::is('alumni/angkatan')? 'active' :'' }}" href="/alumni/angkatan">Data Alumni</a></li>
							<li><a class="dropdown-item bg-transparent dropdown-edit {{ Request::is('alumni/kegiatan')? 'active' :'' }}" href="/alumni/kegiatan">Kegiatan</a></li>
						</ul>
					</li>
					<li class="d-lg-inline dropdown">
						<a class="d-lg-inline p-lg-2 m-lg-0 nav-link dropdown-toggle {{ Request::is('perlombaan')? 'active' :'' }}" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Perlombaan
						</a>
						<ul class="mt-2 dropdown-menu bg-light-green text-black" aria-labelledby="navbarDropdownMenuLink">
							<li><a class="dropdown-item bg-transparent dropdown-edit {{ Request::is('perlombaan') && strtolower(Request::get('category')) == 'mahasiswa'? 'active' :'' }}" href="/perlombaan?category=mahasiswa">Mahasiswa</a></li>
							<li><a class="dropdown-item bg-transparent dropdown-edit {{ Request::is('perlombaan') && strtolower(Request::get('category')) == 'dosen'? 'active' :'' }}" href="/perlombaan?category=dosen">Dosen</a></li>
							<li><a class="dropdown-item bg-transparent dropdown-edit {{ Request::is('perlombaan') && strtolower(Request::get('category')) == 'tendik'? 'active' :'' }}" href="/perlombaan?category=tendik">Tendik</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	@if(!empty($laboratorium) || !empty($kegiatan_lab))
	<nav class="bg-white">
		<div class="container py-2">
			<ul class="navbar-nav  ms-md-5 row">
				@if($kepala)
				<li class="d-inline dropdown ">
					<a class="d-inline p-lg-2 m-lg-0 nav-link text-opacity-75 text-black" href="{{ $url }}#kepala-lab">Kepala Lab</a>
				</li>
				@endif
				@if($anggota)
				<li class="d-inline dropdown">
					<a class="d-inline p-lg-2 m-lg-0 nav-link text-opacity-75 text-black" href="{{ $url }}#anggota-lab">Anggota Lab</a>
				</li>
				@endif
				<li class="d-inline dropdown">
					<a class="d-inline p-lg-2 m-lg-0 nav-link dropdown-toggle text-opacity-75 {{ Request::is(substr($url, 1).'/*') ? '' : 'text-black' }}" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Kegiatan
					</a>
					<ul class="mt-2 dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						@foreach($category_kegiatan as $category)
						<li><a class="dropdown-item {{ Request::is(substr($url, 1).'/'.$category->slug_c) ? 'text-primary' : 'text-gray' }}" href="{{ $url.'/'.$category->slug_c }}">{{ $category->nama_c }}</a></li>
						@endforeach
					</ul>
				</li>
			</ul>
		</div>
	</nav>
	<script type="text/javascript">
		var item = document.querySelectorAll('.nav-link.text-opacity-75')
		change()
		item[0].parentElement.addEventListener('click', function(){
			item[0].classList.remove('text-black')
			item[0].classList.add('text-primary')
			item[1].classList.add('text-black')
			item[1].classList.remove('text-primary')
			change()
		})
		item[1].parentElement.addEventListener('click', function(){
			item[0].classList.add('text-black')
			item[1].classList.add('text-primary')
			item[1].classList.remove('text-black')
			change()
		})
		function change() {
			item[0].classList.remove('text-primary')
			item[1].classList.remove('text-primary')
			if(window.location.hash == '#kepala-lab'){
				item[0].classList.remove('text-black')
				item[0].classList.add('text-primary')
				item[1].classList.add('text-black')
			}
			if(window.location.hash == '#anggota-lab'){
				item[1].classList.remove('text-black')
				item[0].classList.add('text-black')
				item[1].classList.add('text-primary')
			}
		}
	</script>
	@endif
</div>
</header>
