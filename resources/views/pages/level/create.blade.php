<form action="{{ route('level.store') }}" class="form-horizontal" method="POST" id="form-store">
	@csrf
	<div class="form-group">
		<label for="nama_level">
			Nama Level
		</label>
		<input type="text" name="nama_level" class="form-control" id="nama_level">
	</div>

	<div class="d-flex">
		<button type="submit" class="btn btn-primary ml-auto" id="action-primary">Tambah</button>
	</div>
</form>