<form action="{{ route('pegawai.store') }}" class="form-horizontal" method="POST" id="form-store">
	@csrf

	<div class="form-group">
		<label for="nama_pegawai">
			Nama Pegawai
		</label>
		<input type="text" name="nama_pegawai" class="form-control" id="nama_pegawai" autocomplete="off">
	</div>

	<div class="form-group">
		<label for="nama_pegawai">
			Nip
		</label>
		<input type="text" name="nip" class="form-control" id="nip" autocomplete="off">
	</div>

	<div class="form-group">
		<label for="alamat">
			Alamat
		</label>
		<textarea class="form-control" name="alamat" id="alamat" rows="3" autocomplete="off"></textarea>
	</div>
	<div class="d-flex">
		<button type="submit" class="btn btn-primary ml-auto" id="action-primary">Tambah</button>
	</div>
</form>