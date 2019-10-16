<form action="{{ route('petugas.store') }}" class="form-horizontal" method="POST" id="form-store">
	@csrf

	<div class="form-group">
		<label for="nama_petugas">
			Nama Petugas
		</label>
		<input type="text" name="nama_petugas" class="form-control" id="nama_petugas" autocomplete="off">
	</div>

	<div class="form-group">
		<label for="id_level">
			Level
		</label>
		<select class="custom-select" name="id_level" id="id_level">
			<option selected value="">Pilih Level Petugas</option>
			@foreach($levels as $level)
				<option value="{{ $level->id_level }}">{{ $level->nama_level }}</option>
			@endforeach
		</select>
	</div>

	<div class="form-group">
		<label for="username">
			Username
		</label>
		<input type="text" name="username" class="form-control" id="username" autocomplete="off">
	</div>

	<div class="form-group">
		<label for="password">
			Password
		</label>
		<input type="password" name="password" class="form-control" id="password">
	</div>

	<div class="d-flex">
		<button type="submit" class="btn btn-primary ml-auto" id="action-primary">Tambah</button>
	</div>
</form>