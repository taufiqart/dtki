@if($kegiatan->count())
	@foreach($kegiatan as $data)
		{{-- <div class="col-6 col-md-4 col-lg-3 mb-3" onclick="window.location='/alumni/kegiatan/{{ $data->slug }}'">
			<div class="card animated">
				<div class="row g-0 justify-content-center align-items-center">
					<div class="col-12">
						<div class="m-2 post-image bg-size-2-1" style="background-image: url('{{ $data->image  }}'); height: 150px;">
						</div>
					</div>
					<div class="col-sm-12 col-md-12" style="">
						<div class="card-body">
							<h5 class="card-title overflow-hidden" style="height: 50px;"><a href="/alumni/kegiatan/{{ $data->slug }}">{{ $data->title }}</a></h5>
							<p class="card-text overflow-hidden" style="max-height: 100px;">{{ $data->excerpt }}</p>
							<p class="card-text"><small class="text-muted">{{ $data->created_at->diffForHumans() }}</small></p>
						</div>
					</div>
				</div>
			</div>
		</div> --}}
		<div class="col-6 col-md-4 col-lg-3 mb-2 px-2 post-hover" onclick="window.location='/alumni/kegiatan/{{ $data->slug }}' ">
			<div class="animated post-rounded height height-md">
				<div class="mb-2" style="">
					<img class="shadow-sm rounded max-height-img max-height-img-md" src="{{ $data->image }}" alt="" style="width: 100%; margin: 0 auto;">
				</div>
				<div class="overflow-hidden" style="max-height:140px;">
					<a href="/alumni/kegiatan/{{ $data->slug }}"><h6 class="post-title overflow-hidden" style="max-height: 55px;" >{{ $data->title }}</h6></a>
					<p class="overflow-hidden post-excerpt" style="max-height: 80px;">{{ $data->excerpt }}</p>
				</div>
				<div class="post-date-div">
					<p class="post-date">{{ $data->created_at->diffForHumans() }}</p>
				</div>
			</div>
		</div>
	@endforeach
@else
	<p class="text-center">data tidak ditemukan.</p>
@endif
<div class="d-flex justify-content-center">
	{{ $kegiatan->onEachSide(1)->links() }}
</div>