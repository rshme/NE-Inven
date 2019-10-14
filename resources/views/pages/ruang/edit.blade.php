<form action="{{ route('ruang.update', $data->id_ruang) }}" class="form-horizontal" method="POST" id="form-edit">
	{{ method_field('PUT') }}
	@csrf
	<div class="form-group">
		<label for="nama_ruang">
			Nama Ruangan
		</label>
		<input type="text" name="nama_ruang" value="{{ $data->nama_ruang }}" class="form-control" id="nama_ruang">
	</div>

	<div class="form-group">
		<label for="kode_ruang">
			Kode Ruangan
		</label>
		<input type="text" name="kode_ruang" class="form-control" id="kode_ruang" placeholder="Kosongkan jika tidak ada perubahan">
	</div>

	<div class="form-group">
		<label for="keterangan">
			Keterangan
		</label>
		<textarea class="form-control" name="keterangan" id="keterangan" rows="3">{{ $data->keterangan }}</textarea>
	</div>
	<div class="d-flex">
		<button type="submit" class="btn btn-primary ml-auto" id="action-primary">Edit</button>
	</div>
</form>