<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
		<div class="sidebar-brand-icon rotate-n-15">
			<i class="fas fa-laugh-wink"></i>
		</div>
		<div class="sidebar-brand-text mx-3">Admin DTKI</div>
	</a>

	<hr class="sidebar-divider my-0">

	<li class="nav-item {{ Request::is('admin') ? 'active':'' }}">
		<a class="nav-link" href="/admin">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span>
		</a>
	</li>

	<hr class="sidebar-divider">

	<div class="sidebar-heading">
		Interface
	</div>

	<li class="nav-item {{ Request::is('admin/profile*') ? 'active':'' }}">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
			aria-expanded="true" aria-controls="collapseOne">
			<i class="fas fa-fw fa-book" aria-hidden="true"></i>
			<span>Profile</span>
		</a>
		<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item {{ Request::is('admin/profile/departemen*') ? 'active':'' }}" href="/admin/profile/departemen">Departemen</a>
				<a class="collapse-item {{ Request::is('admin/profile/dosen*') ? 'active':'' }}" href="/admin/profile/dosen">Dosen</a>
				<a class="collapse-item {{ Request::is('admin/profile/tendik*') ? 'active':'' }}" href="/admin/profile/tendik">Tendik</a>
			</div>
		</div>
	</li>
	<li class="nav-item {{ Request::is('admin/lab*') ? 'active':'' }}">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
			aria-expanded="true" aria-controls="collapseTwo">
			<i class="fas fa-fw fa-flask" aria-hidden="true"></i>
			<span>Laboratorium</span>
		</a>
		<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item {{ Request::is('admin/lab/1*') ? 'active':'' }}" href="/admin/lab/1">Process Operating System Laboratory</a>
				<a class="collapse-item {{ Request::is('admin/lab/2*') ? 'active':'' }}" href="/admin/lab/2">Industrial Biotechnology Laboratory</a>
				<a class="collapse-item {{ Request::is('admin/lab/3*') ? 'active':'' }}" href="/admin/lab/3">Applied Chemistry Laboratory</a>
				<a class="collapse-item {{ Request::is('admin/lab/4*') ? 'active':'' }}" href="/admin/lab/4">Industrial Chemical Process Laboratory</a>
			</div>
		</div>
	</li>
	<li class="nav-item {{ Request::is('admin/penelitian*') ? 'active':'' }}">
		<a class="nav-link collapsed" href="/admin/penelitian">
			<i class="fas fa-fw fa-newspaper"></i>
			<span>Penelitian</span>
		</a>
	</li>
	<li class="nav-item {{ Request::is('admin/peng-masyarakat*') ? 'active':'' }}">
		<a class="nav-link collapsed" href="/admin/peng-masyarakat">
			<i class="fas fa-fw fa-street-view"></i>
			<span>Pengabdian Masyarakat</span>
		</a>
	</li>
	<li class="nav-item {{ Request::is('admin/alumni*') ? 'active':'' }}">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix"
			aria-expanded="true" aria-controls="collapseSix">
			<i class="fas fa-fw fa-users"></i>
			<span>Alumni</span>
		</a>
		<div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item {{ Request::is('admin/alumni/data-alumni*') ? 'active':'' }}" href="/admin/alumni/data-alumni">Data Alumni</a>
				<a class="collapse-item {{ Request::is('admin/alumni/kegiatan*') ? 'active':'' }}" href="/admin/alumni/kegiatan">Kegiatan</a>
			</div>
		</div>
	</li>
	<li class="nav-item {{ Request::is('admin/perlombaan*') ? 'active':'' }}">
		<a class="nav-link collapsed" href="/admin/perlombaan">
			<i class="fas fa-fw fa-trophy"></i>
			<span>Perlombaan</span>
		</a>
	</li>
	<li class="nav-item {{ Request::is('admin/dosen_tendik*') ? 'active':'' }}">
		<a class="nav-link collapsed" href="/admin/dosen_tendik">
			<i class="fas fa-fw fa-user"></i>
			<span>Dosen & Tendik</span>
		</a>
	</li>
	<li class="nav-item {{ Request::is('admin/kontak*') ? 'active':'' }}">
		<a class="nav-link collapsed" href="/admin/kontak">
			<i class="fas fa-fw fa-address-book"></i>
			<span>Kontak</span>
		</a>
	</li>
	<hr class="sidebar-divider d-none d-md-block">

</ul>