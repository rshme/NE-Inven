<form action="{{ route('peminjaman.store') }}" class="form-horizontal" method="POST" id="form-peminjaman">
	@csrf

	<label>Barang yang dipilih : </label>

	<div class="form-group">
		<label for="id_inventaris">
			Barang
		</label>
		<select name="id_inventaris" class="custom-select" id="id_inventaris">
			<option selected value="">Pilih Barang</option>
			@foreach(\App\Inventaris::where('jumlah', '>', 0)->get() as $barang)
				<option value="{{ $barang->id_inventaris }}">{{ $barang->nama }}</option>
			@endforeach
		</select>
	</div>

	<div class="form-group">
		<label for="jumlah">
			Jumlah
		</label>
		<input type="text" name="jumlah" class="form-control" id="jumlah" autocomplete="off">
	</div>

	<button class="btn btn-primary text-center mb-2" style="width:100%" id="btn-save">
		<i class="fas fa-plus"></i> Tambah Pinjaman
	</button>

	<div class="form-group">
		<label for="id_pegawai">
			Pegawai
		</label>
		<select name="id_pegawai" class="custom-select" id="id_pegawai">
			<option selected value="">Pilih Pegawai</option>
			@foreach(\App\Pegawai::all() as $pegawai)
				<option value="{{ $pegawai->id_pegawai }}">{{ $pegawai->nama_pegawai }}</option>
			@endforeach
		</select>
	</div>

	<div class="d-flex">
		<button type="submit" class="btn btn-primary ml-auto" id="action-primary">Tambah</button>
	</div>
</form>