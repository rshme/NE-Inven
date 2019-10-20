<div class="container">
	<div class="row">
		<div class="col-md-6">
			<p class="mb-3">Nama Peminjam :</p>
			<p class="mb-3">Barang Yang Dipinjam :</p>
			<p class="mb-3">Sisa Pinjaman :</p>
			<p class="mb-3">Tanggal Peminjaman :</p>
			<p class="mb-3">Tanggal Pengembalian :</p>
			<p class="mb-3">Status Pengembalian:</p>
		</div>
		<div class="col-md-6">
			<p class="mb-3">{{ $data->pegawai->nama_pegawai }}</p>
			<p class="mb-3">{{ $data->detail->inventaris->nama }}</p>
			<p class="mb-3">{{ $data->detail->jumlah }}</p>
			<p class="mb-3">{{ \Date::parse($data->tanggal_pinjam)->format('d-m-Y') }}</p>
			<p class="mb-3">
				@if($data->tanggal_kembali !== NULL)
					{{ \Date::parse($data->tanggal_kembali)->format('d-m-Y') }}
				@else
					-
				@endif
			</p>
			<p class="mb-3">{{ $data->status_peminjaman }}</p>
		</div>
	</div>
</div>