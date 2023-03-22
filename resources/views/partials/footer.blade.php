<div class="pb-6"></div>
<footer class="section_footer mt-auto pt-5">
	<div class="footer-top">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-sm-2 col-xs-5 m-4 m-md-0">
					<img src="/img/Lambang-DTKI-Putih.png" class="logo-in-footer">
				</div>
				<div class="col-sm-6">
					Industrial Chemical Engineering Department, FV-ITS
					@if($kontak)
					<br>{!! $kontak->alamat??null !!}
					<br>{!! $kontak->telepon??null !!}
					<br>Email: {!! $kontak->email??null !!}
					@endif
				</div>
				<div class="col-sm-2 col-xs-4 border-left-white-in-mobile">
					<div class="footer-top-content border-left-white">
						@if($kontak->media_sosial??null)						
						<div class="title-footer padding-left-35 text-center">Find us</div>						
						<ul>
							@foreach($kontak->media_sosial as $sosmed)
							<li class="d-inline ">
								<a href="{{ $sosmed["url"] }}" class="text-white" target="_blank" title="{{ $sosmed["title"] }}">
									<i class="fab {{ $sosmed["icon"] }} h3"></i>
								</a>
							</li>
							@endforeach
						</ul>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="copyright text-center">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
				Copyright &copy; 2021 Industrial Chemical Engineering Department, FV-ITS, Institut Teknologi Sepuluh Nopember</div>
			</div>
		</div>
	</div>
</footer>