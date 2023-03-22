@extends('layouts.main')

@section('container')
	<div class="pb-6"></div>
	<div class="pb-6"></div>
	<div class="container-fluid p-0 m-auto align-items-center">
		<div class="p-0 m-0 row justify-content-center align-items-center">
			<div class="col-lg-7 col-xl-5 col-md-auto">
				<div class="card overflow-hidden border-0 shadow-cs border-radius-rounded">
					<div class="card-body p-0">
						<div class="row">
							<div class="col-lg-6 d-none d-lg-block logo-image"></div>
							<div class="col-lg-6 col-md-auto">
								<div class="p-4 pl-lg-0">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4">Login</h1>
									</div>
									<form method="POST" action="/satki/login" class="user">
										<div class="form-group">
											<input type="email" class="form-control form-control-user" name="email" placeholder="E-Mail Address" value="" required autofocus>
										</div>
										<div class="form-group">
											<input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
										</div>
										{{-- <div class="form-group">
											<div class="custom-control custom-checkbox small">
												<input type="checkbox" class="custom-control-input" name="remember" id="remember" >
												<label class="custom-control-label" for="remember">Remember Me</label>
											</div>
										</div> --}}
										<div class="form-group">
											<button type="submit" class="btn btn-primary btn-user btn-block">
											Login
											</button>
										</div>
									</form>
									<hr>
									<div class="text-center">
										<a class="small" href="/satki/password/reset">
											Forgot Password?
										</a>
									</div>
									
									{{-- <div class="text-center">
										<a class="small" href="/satki/register">Create an Account!</a>
									</div> --}}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
