<form action="{{ route('level.update', $data->id_level) }}" class="form-horizontal" method="POST" id="form-edit">
	{{ method_field('PUT') }}
	@csrf
	<div class="form-group">
		<label for="nama_level">
			Nama Level
		</label>
		<input type="text" name="nama_level" value="{{ $data->nama_level }}" class="form-control" id="nama_level">
	</div>

	<div class="d-flex">
		<button type="submit" class="btn btn-primary ml-auto" id="action-primary">Edit</button>
	</div>
</form>