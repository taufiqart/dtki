@extends('admin.layouts.main')

@section('container')
	<div class="col-lg-8-">
		<form method="post" action="{{ $url }}/{{ $data->id }}" enctype="multipart/form-data">
			@method('put')
			@csrf
			<div class="mb-3 card rounded">
				<div class="p-3">
					<div class="mb-3">
						<label for="role_name" class="form-label">Role Name</label>
							{{-- {{ dd($kepala_lab) }} --}}
						<select class="form-select form-select-sm form-control" name="role_name" id="role_name" aria-label=".form-select-sm example">
							@if($data->role_name == 'Kepala Lab' || !$kepala_lab)
							<option {{ old('role_name') == 'Kepala Lab' ? 'selected' : '' }} value="Kepala Lab">Kepala Lab</option>
							@endif
							<option {{ old('role_name') == 'Anggota Lab' ? 'selected' : '' }} value="Anggota Lab">Anggota Lab</option>
						</select>
					</div>
					<div class="mb-2">
						<label for="image" class="form-label">Image</label>
						@if ($data->image)
							<img src="{{ $data->image }}" alt="" class="img-preview img-fluid mb-3 col-md-5 d-block">
						@else
							<img src="" alt="" class="img-preview img-fluid mb-3 col-md-5 d-block">
						@endif
						<input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage(this)">
						<div class="invalid-feedback"></div>
						@error('image')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
					<div class="mb-2">
						<label for="nama" class="form-label">Nama</label>
						<input class="form-control @error('title') is-invalid @enderror" type="text" id="nama" name="nama" value="{{ old('nama', $data->nama) }}" required autofocus>
						@error('nama')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
					<div class="mb-2">
						<label for="nip" class="form-label">Nip</label>
						<input class="form-control @error('title') is-invalid @enderror" type="text" id="nip" name="nip" value="{{ old('nip', $data->nip) }}" required autofocus>
						@error('nip')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
					<div class="mb-2">
						<label for="email" class="form-label">Email</label>
						<input class="form-control @error('title') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email', $data->email) }}">
						@error('email')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
					<div class="mb-2">
						<label for="jabatan" class="form-label">Gol./Jabatan</label>
						<input class="form-control @error('title') is-invalid @enderror" type="text" id="jabatan" name="jabatan" value="{{ old('jabatan', $data->jabatan) }}">
						@error('jabatan')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
				</div>
			</div>
			<button type="submit" class="btn btn-success">Submit</button>
			<a href="{{ $url }}" type="button" class="btn btn-primary">Cancel</a>
		</form>
	</div>
@endsection


