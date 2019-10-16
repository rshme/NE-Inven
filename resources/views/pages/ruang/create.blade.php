<form action="{{ route('ruang.store') }}" class="form-horizontal" method="POST" id="form-store">
	@csrf
	<div class="form-group">
		<label for="nama_ruang">
			Nama Ruang
		</label>
		<input type="text" name="nama_ruang" class="form-control" id="nama_ruang" autocomplete="off">
	</div>

	<div class="form-group">
		<label for="kode_ruang">
			Kode Ruang
		</label>
		<input type="text" name="kode_ruang" class="form-control" id="kode_ruang" autocomplete="off">
	</div>

	<div class="form-group">
		<label for="keterangan">
			Keterangan
		</label>
		<textarea class="form-control" name="keterangan" id="keterangan" rows="3" autocomplete="off"></textarea>
	</div>
	<div class="d-flex">
		<button type="submit" class="btn btn-primary ml-auto" id="action-primary">Tambah</button>
	</div>
</form>