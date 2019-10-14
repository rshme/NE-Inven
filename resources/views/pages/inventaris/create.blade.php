<form action="{{ route('inventaris.store') }}" class="form-horizontal" method="POST" id="form-store">
	@csrf

	<div class="form-group">
		<label for="nama">
			Nama Barang
		</label>
		<input type="text" name="nama" class="form-control" id="nama">
	</div>

	<div class="form-group">
		<label for="id_jenis">
			Jenis Barang
		</label>
		<select name="id_jenis" class="custom-select" id="id_jenis">
			<option selected value="">Pilih Jenis Barang</option>
			@foreach($all_jenis as $jenis)
				<option value="{{ $jenis->id_jenis }}">{{ $jenis->nama_jenis }}</option>
			@endforeach
		</select>
	</div>

	<div class="form-group">
		<label for="id_ruang">
			Ruangan
		</label>
		<select name="id_ruang" class="custom-select" id="id_ruang">
			<option selected value="">Pilih Ruangan</option>
			@foreach($all_ruang as $ruang)
				<option value="{{ $ruang->id_ruang }}">{{ $ruang->nama_ruang }}</option>
			@endforeach
		</select>
	</div>

	<div class="form-group">
		<label for="kondisi">
			Kondisi
		</label>
		<select name="kondisi" class="custom-select" id="kondisi">
			<option selected value="">Kondisi Barang</option>
			<option value="baik">Baik</option>
			<option value="rusak_ringan">Rusak Ringan</option>
			<option value="rusak_parah">Rusak Parah</option>
		</select>
	</div>

	<div class="form-group">
		<label for="keterangan">
			Keterangan
		</label>
		<textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
	</div>

	<div class="form-group">
		<label for="jumlah">
			Jumlah
		</label>
		<input type="text" name="jumlah" class="form-control" id="jumlah">
	</div>

	<div class="d-flex">
		<button type="submit" class="btn btn-primary ml-auto" id="action-primary">Tambah</button>
	</div>
</form>