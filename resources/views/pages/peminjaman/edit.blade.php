<form action="{{ route('peminjaman.update', $data->id_peminjaman) }}" class="form-horizontal" method="POST" id="form-edit">
	{{ method_field('PUT') }}
	@csrf
	<div class="form-group">
		<label for="id_pegawai">
			Peminjam
		</label>
		<select name="id_pegawai" class="custom-select" id="id_pegawai">
			<option selected value="{{ $data->id_pegawai }}">{{ $data->pegawai->nama_pegawai }}</option>
			@foreach(\App\Pegawai::all() as $pegawai)
				@if($pegawai->id_pegawai !== $data->id_pegawai)
					<option value="{{ $pegawai->id_pegawai }}">{{ $pegawai->nama_pegawai }}</option>
				@endif
			@endforeach
		</select>
	</div>

	<div class="form-group">
		<label for="id_inventaris">
			Barang
		</label>
		<select name="id_inventaris" class="custom-select" id="id_inventaris">
			<option selected value="{{ $data->detail->id_inventaris }}">{{ $data->detail->inventaris->nama }}</option>
			@foreach(\App\Inventaris::all() as $inventaris)
				@if($inventaris->id_inventaris !== $data->detail->id_inventaris)
					<option value="{{ $inventaris->id_inventaris }}">{{ $inventaris->nama }}</option>
				@endif
			@endforeach
		</select>
	</div>

	<div class="form-group">
		<label for="jumlah">
			Jumlah
		</label>
		<input type="text" name="jumlah" value="{{ $data->detail->jumlah }}" class="form-control" id="jumlah" autocomplete="off">
	</div>

{{-- 	<div class="form-group">
		<label for="status_peminjaman">
			Status Pengembalian
		</label>
		<select name="status_peminjaman" class="custom-select" id="status_peminjaman">
			<option selected value="{{ $data->status_peminjaman }}">
				{{ str_replace('_', ' ', ucfirst($data->status_peminjaman)) }}
			</option>
			@if($data->status_peminjaman === 'Belum Kembali')
				<option value="Sudah Kembali">Sudah Kembali</option>
			@elseif($data->status_peminjaman === 'Sudah Kembali')
				<option value="Belum Kembali">Belum Kembali</option>
			@endif
		</select>
	</div> --}}

	<div class="d-flex">
		<button type="submit" class="btn btn-primary ml-auto" id="action-primary">Edit</button>
	</div>
</form>