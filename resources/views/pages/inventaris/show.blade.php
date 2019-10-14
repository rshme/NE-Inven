<div class="container">
	<div class="row">
		<div class="col-md-4">
			<p class="mb-3">Nama Barang :</p>
			<p class="mb-3">Jenis Barang :</p>
			<p class="mb-3">Ruangan :</p>
			<p class="mb-3">Petugas :</p>
			<p class="mb-3">Kondisi :</p>
			<p class="mb-3">Keterangan :</p>
			<p class="mb-3">Jumlah :</p>
			<p class="mb-3">Kode Inventaris :</p>
		</div>
		<div class="col-md-8">
			<p class="mb-3">{{ $data->nama }}</p>
			<p class="mb-3">{{ $data->jenis->nama_jenis }}</p>
			<p class="mb-3">{{ $data->ruang->nama_ruang }}</p>
			<p class="mb-3">{{ $data->petugas->nama_petugas }}</p>
			<p class="mb-3">{{ ucfirst($data->kondisi) }}</p>
			<p class="mb-3">{{ $data->keterangan }}</p>
			<p class="mb-3">{{ $data->jumlah }}</p>
			<p class="mb-3">{{ $kode_inventaris }}</p>
		</div>
	</div>
</div>