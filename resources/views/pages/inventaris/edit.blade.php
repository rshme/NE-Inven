<form action="{{ route('inventaris.update', $data->id_inventaris) }}" class="form-horizontal" method="POST" id="form-edit">
	{{ method_field('PUT') }}
	@csrf
	<div class="form-group">
		<label for="nama">
			Nama Barang
		</label>
		<input type="text" name="nama" value="{{ $data->nama }}" class="form-control" id="nama" autocomplete="off">
	</div>

	<div class="form-group">
		<label for="id_jenis">
			Jenis Barang
		</label>
		<select name="id_jenis" class="custom-select" id="id_jenis">
			<option selected value="{{ $data->jenis->id_jenis }}">{{ $data->jenis->nama_jenis }}</option>
			@foreach(\App\Jenis::all() as $jenis)
				@if($data->jenis->id_jenis !== $jenis->id_jenis)
					<option value="{{ $jenis->id_jenis }}">{{ $jenis->nama_jenis }}</option>
				@endif
			@endforeach
		</select>
	</div>

	<div class="form-group">
		<label for="id_ruang">
			Ruangan
		</label>
		<select name="id_ruang" class="custom-select" id="id_ruang">
			<option selected value="{{ $data->ruang->id_ruang }}">{{ $data->ruang->nama_ruang }}</option>
			@foreach(\App\ruang::all() as $ruang)
				@if($data->ruang->id_ruang !== $ruang->id_ruang)
					<option value="{{ $ruang->id_ruang }}">{{ $ruang->nama_ruang }}</option>
				@endif
			@endforeach
		</select>
	</div>

	<div class="form-group">
		<label for="kondisi">
			Kondisi
		</label>
		<select name="kondisi" class="custom-select" id="kondisi">
			<option selected value="{{ $data->kondisi }}">{{ ucfirst($data->kondisi) }}</option>
			<option value="baik">Baik</option>
			<option value="rusak_ringan">Rusak Ringan</option>
			<option value="rusak_parah">Rusak Parah</option>
		</select>
	</div>

	<div class="form-group">
		<label for="jumlah">
			Jumlah
		</label>
		<input type="text" name="jumlah" value="{{ $data->jumlah }}" class="form-control" id="jumlah" autocomplete="off">
	</div>

	<div class="form-group">
		<label for="keterangan">
			Keterangan
		</label>
		<textarea class="form-control" name="keterangan" id="keterangan" rows="3" autocomplete="off">{{ $data->keterangan }}</textarea>
	</div>

	<div class="form-group">
		<label for="tanggal_register">
			Tanggal Register
		</label>
		<input type="date" name="tanggal_register" value="{{ $data->tanggal_register }}" class="form-control" id="tanggal_register">
	</div>
	<div class="d-flex">
		<button type="submit" class="btn btn-primary ml-auto" id="action-primary">Edit</button>
	</div>
</form>