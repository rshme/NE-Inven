<form action="{{ route('pengembalian.store') }}" class="form-horizontal" method="POST" id="form-store">
	@csrf

	<div class="form-group">
		<label for="id_pegawai">
			Pegawai
		</label>
		<select name="id_pegawai" class="custom-select pegawai" id="id_pegawai" data-url="{{ route('pengembalian.search') }}">
			<option selected value="">Pilih Pegawai</option>
			@foreach(\App\Pegawai::with(['peminjaman'])->get() as $pegawai)
				<option value="{{ $pegawai->id_pegawai }}">{{ $pegawai->nama_pegawai }}</option>
			@endforeach
		</select>
	</div>

	<div id="pengembalian">
		
	</div>

	<div class="d-flex">
		<button type="submit" class="btn btn-primary ml-auto" id="action-primary">Tambah</button>
	</div>
</form>