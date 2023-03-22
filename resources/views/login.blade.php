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
		{{-- <link rel="stylesheet" href="/css/animate.css"> --}}
		<link rel="stylesheet" href="/css/update.css">
		<link rel="stylesheet" href="/css/fontawesome/css/all.min.css">
	</head>
	{{-- Bootstrap Icons --}}
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
	
	<body class="pt-5 min-vh-100 d-flex flex-column" style="background:#f5f5f5f5;">
		<div class="container">
			<div class="p-2 row justify-content-center align-items-center">
				<div class="col-12 col-md-6 col-lg-5 content-rounded overflow-hidden shadow">
					<div class="w-100 m-auto">
						<div class="p-5">
							<div class="text-center">
								<h1 class="h1 mb-4">Login</h1>
							</div>
							@if (session()->has('error'))
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									{{ session('error') }}
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
							@endif
							<form method="POST" action="/admin/login" class="w-100">
								@csrf
								<div class="form-group">
									<input type="text" class="form-control post-rounded p-2 px-3 p-lg-3 w-100" name="username" placeholder="Username" required autofocus>
								</div>
								<div class="form-group">
									<input type="password" class="form-control post-rounded p-2 px-3 p-lg-3 w-100" name="password" placeholder="Password" required>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary w-100">Login</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="mt-auto mb-4">
			<h1 class="h5 text-center text-muted">&copy; 2022</h1>
		</div>
	</body>
	<script src="/js/bootstrap.js"></script>
	<script>
	</script>
</html>