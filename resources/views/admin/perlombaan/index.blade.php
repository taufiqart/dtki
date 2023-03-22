
<div class="row">
	<div class="container justify-content-center p-3" style=" margin: 0 auto;">
		@if($perlombaan->count())
		<table class="table table-sm align-items-center">
			<thead>
				<tr>
					<th scope="col">Image</th>
					<th scope="col">Article</th>
					<th scope="col">Category</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($perlombaan as $data)
				<tr class="border-bottom pt-3 animated">
					<td class="col-2 p-2"><img style="width: 50%;" src="{{ $data->image }}" alt=""></td>
					<td>
						<h5>
							<a target="_blank" href="/perlombaan/{{ $data->slug }}">{{ $data->title }}</a>
						</h5>
						<p class="d-none d-md-inline">{{ $data->excerpt }}</p>
						<p>{{ $data->created_at->diffForHumans() }}</p>
					</td>
					<th>{{ $data->category }}</th>
					<td>
						<div class="d-md-flex justify-content-space-between align-items-center">
							<a href="/admin/perlombaan/{{ $data->slug }}/edit" class="btn btn-warning m-1 d-inline-block">
								<i class="fas fa-w fa-edit"></i>
							</a>
							
							<form action="/admin/perlombaan/{{ $data->slug }}" method="post" class="d-inline">
								@method('delete')
								@csrf
								<button class="btn btn-danger m-1 fa-w d-inline-block" onclick="return confirm('Are you sure?')">
									<i class="fas fa-trash"></i>
								</button>
							</form>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@else
			<p class="text-center fs-4">data tidak ditemukan.</p>
		@endif
	</div>
</div>
<div class="d-flex justify-content-center">
	{{ $perlombaan->links() }}
</div>