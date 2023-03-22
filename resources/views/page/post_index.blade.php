@if($all_data->count())
	<div class="col-12 mb-2 px-2 post-hover" onclick="window.location='{{ $url }}/{{ $all_data[0]->slug }}' ">
		<div class="animated post-rounded overflow-hidden">
			<div class="mb-2 overflow-hidden rounded shadow-sm" style="max-height:400px;">
				<img class="shadow-sm rounded" src="{{ $all_data[0]->image }}" alt="" style="width: 100%; margin: 0 auto;">
			</div>
			<div class="overflow-hidden mb-4 mb-md-2 text-center" style="max-height:140px;">
				<a href="{{ $url }}/{{ $all_data[0]->slug }}"><h6 class="post-title overflow-hidden" style="max-height: 55px;" >{{ $all_data[0]->title }}</h6></a>
				<p class="overflow-hidden post-excerpt" style="max-height: 80px;">{!! $all_data[0]->body !!}</p>
			</div>
			<div class="post-date-div">
				<p class="post-date text-center">{{ $all_data[0]->created_at->diffForHumans() }}</p>
			</div>
		</div>
	</div>
	@foreach($all_data->skip(1) as $data)
	<div class="col-6 col-md-4 mb-2 px-2 post-hover" onclick="window.location='{{ $url }}/{{ $data->slug }}' ">
		<div class="animated post-rounded height height-md">
			<div class="mb-2 text-center" style="">
				<img class="shadow-sm rounded max-height-img max-height-img-md text-center" src="{{ $data->image }}" alt="" style="max-width: 100%; margin: 0 auto;">
			</div>
			<div class="overflow-hidden" style="max-height:140px;">
				<a href="{{ $url }}/{{ $data->slug }}"><h6 class="post-title overflow-hidden" style="max-height: 55px;" >{{ $data->title }}</h6></a>
				<p class="overflow-hidden post-excerpt" style="max-height: 60px;">{!! $data->excerpt !!}</p>
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
	{{ $all_data->onEachSide(1)->links() }}
</div>