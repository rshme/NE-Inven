<form action="{{ route('jenis.update', $data->id_jenis) }}" class="form-horizontal" method="POST" id="form-edit">
	{{ method_field('PUT') }}
	@csrf
	<div class="form-group">
		<label for="nama_jenis">
			Nama Jenis
		</label>
		<input type="text" name="nama_jenis" value="{{ $data->nama_jenis }}" class="form-control" id="nama_jenis" autocomplete="off">
	</div>

	<div class="form-group">
		<label for="kode_jenis">
			Kode Jenis
		</label>
		<input type="text" name="kode_jenis" class="form-control" id="kode_jenis" placeholder="Kosongkan jika tidak ada perubahan" autocomplete="off">
	</div>

	<div class="form-group">
		<label for="keterangan">
			Keterangan
		</label>
		<textarea class="form-control" name="keterangan" id="keterangan" rows="3" autocomplete="off">{{ $data->keterangan }}</textarea>
	</div>
	<div class="d-flex">
		<button type="submit" class="btn btn-primary ml-auto" id="action-primary">Edit</button>
	</div>
</form>