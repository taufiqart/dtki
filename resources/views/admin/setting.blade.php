@extends('admin.layouts.main')

@section('container')
	<div class="col-lg-8- p-3">
		<form method="post" action="{{ route('setting') }}" enctype="multipart/form-data" class="content-rounded">
			@method('put')
			@csrf
			<div class="mb-3">
				<label for="username" class="form-label">Username</label>
				<input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"  autofocus value="{{ old('username', Auth::user()->username) }}">
				@error('username')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="password" class="form-label">Password</label>
				<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"  autofocus value="{{ old('password') }}">
				@error('password')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
				<div class="form-check mt-1">
					<input type="checkbox" class="form-check-input" id="show-pass" onclick='show(this)'>
					<label for="show-pass" class="form-check-label">show password</label>
				</div>
			</div>
			<button type="submit" class="btn btn-success">Submit</button>
			<a href="{{ route('dashboard') }}" type="button" class="btn btn-primary">Cancel</a>
		</form>
	</div>
	<script>
		function show(el){
			let pass = document.querySelector('#password')
			el.checked?pass.type = 'text':pass.type = 'password'
		}
	</script>
@endsection