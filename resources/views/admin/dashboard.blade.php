@extends('admin.layouts.main')

@section('container')
	{{-- <h1 class="h3 mb-4 text-gray-800">All Menu</h1> --}}
	<div class="row">
		<a href="/admin/penelitian" class="col-xl-4 col-md-6 mb-4 post-hover">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2 px-3">
							<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
								Penelitian
							</div>
							<div class="h5 mb-0 text-gray-700">
								<div class="row">
									<div class="col-5">Total : {{ $penelitian["total"] }}</div>
									<div class="col-5">Dosen : {{ $penelitian["dosen"] }}</div>
									<div class="col-5">Tendik : {{ $penelitian["tendik"] }}</div>
									<div class="col-7">Mahasiswa : {{ $penelitian["mahasiswa"] }}</div>
								</div>
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-fw fa-newspaper fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
		<a href="/admin/peng-masyarakat" class="col-xl-4 col-md-6 mb-4 post-hover">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2 px-3">
							<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
								Pengabdian Masyarakat
							</div>
							<div class="h5 mb-0 text-gray-700">
								<div class="row">
									<div class="col-5">Total : {{ $peng_masyarakat["total"] }}</div>
									<div class="col-5">Dosen : {{ $peng_masyarakat["dosen"] }}</div>
									<div class="col-5">Tendik : {{ $peng_masyarakat["tendik"] }}</div>
									<div class="col-7">Mahasiswa : {{ $peng_masyarakat["mahasiswa"] }}</div>
								</div>
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-fw fa-street-view fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
		<a href="/admin/alumni" class="col-xl-4 col-md-6 mb-4 post-hover">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2 px-3">
							<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
								Alumni
							</div>
							<div class="h5 mb-0 text-gray-700">
								<div class="row">
									<div class="col-7">Data Alumni : {{ $alumni["data_alumni"] }}</div>
									<div class="col-7">Kegiatan : {{ $alumni["kegiatan"] }}</div>
								</div>
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-fw fa-users fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
		<a href="/admin/perlombaan" class="col-xl-4 col-md-6 mb-4 post-hover">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2 px-3">
							<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
								Perlombaan
							</div>
							<div class="h5 mb-0 text-gray-700">
								<div class="row">
									<div class="col-5">Total : {{ $perlombaan["total"] }}</div>
									<div class="col-5">Dosen : {{ $perlombaan["dosen"] }}</div>
									<div class="col-5">Tendik : {{ $perlombaan["tendik"] }}</div>
									<div class="col-7">Mahasiswa : {{ $perlombaan["mahasiswa"] }}</div>
								</div>
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-fw fa-trophy fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
		<a href="/admin/dosen_tendik" class="col-xl-4 col-md-6 mb-4 post-hover">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2 px-3">
							<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
								Dosen & Tendik
							</div>
							<div class="h5 mb-0 text-gray-700">
								<div class="row">
									<div class="col-5">Total : {{ $dosen_tendik["total"] }}</div>
									<div class="col-5">Dosen : {{ $dosen_tendik["dosen"] }}</div>
									<div class="col-5">Tendik : {{ $dosen_tendik["tendik"] }}</div>
								</div>
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-fw fa-user fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
@endsection