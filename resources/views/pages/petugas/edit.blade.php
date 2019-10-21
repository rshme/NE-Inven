<form action="{{ route('petugas.update', $data->id_petugas) }}" class="form-horizontal" method="POST" id="form-edit">
	{{ method_field('PUT') }}
	@csrf
	<div class="form-group">
		<label for="nama_petugas">
			Nama Petugas
		</label>
		<input type="text" name="nama_petugas" value="{{ $data->nama_petugas }}" class="form-control" id="nama_petugas" autocomplete="off">
	</div>

	<div class="form-group">
		<label for="id_level">
			Level
		</label>
		<select name="id_level" class="custom-select">
			<option selected value="{{ $data->level->id_level }}">{{ $data->level->nama_level }}</option>
			@foreach($levels as $level)
				@if($data->level->id_level !== $level->id_level)
					<option value="{{ $level->id_level }}">{{ $level->nama_level }}</option>
				@endif
			@endforeach
		</select>
	</div>

	<div class="form-group">
		<label for="username">
			Username
		</label>
		<input type="text" name="username" placeholder="Kosongkan jika tidak ada perubahan" class="form-control" id="username" autocomplete="off">
	</div>

	<div class="form-group">
		<label for="password">
			Password
		</label>
		<input type="password" name="password" placeholder="Kosongkan jika tidak ada perubahan" class="form-control" id="password">
	</div>

	<div class="d-flex">
		<button type="submit" class="btn btn-primary ml-auto" id="action-primary">Edit</button>
	</div>
</form>