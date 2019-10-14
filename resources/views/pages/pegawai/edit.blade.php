<form action="{{ route('pegawai.update', $data->id_pegawai) }}" class="form-horizontal" method="POST" id="form-edit">
	{{ method_field('PUT') }}
	@csrf
	<div class="form-group">
		<label for="nama_pegawai">
			Nama Pegawai
		</label>
		<input type="text" name="nama_pegawai" value="{{ $data->nama_pegawai }}" class="form-control" id="nama_pegawai">
	</div>

	<div class="form-group">
		<label for="nip">
			Nip
		</label>
		<input type="text" name="nip" class="form-control" id="nip" placeholder="Kosongkan jika tidak ada perubahan">
	</div>

	<div class="form-group">
		<label for="alamat">
			Alamat
		</label>
		<textarea class="form-control" name="alamat" id="alamat" rows="3">{{ $data->alamat }}</textarea>
	</div>

	<div class="d-flex">
		<button type="submit" class="btn btn-primary ml-auto" id="action-primary">Edit</button>
	</div>
</form>