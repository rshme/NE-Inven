<div class="container">
	<div class="row">
		<div class="col-md-4">
			<p class="mb-3">Nama Petugas :</p>
			<p class="mb-3">Level :</p>
			<p class="mb-3">Username :</p>
		</div>
		<div class="col-md-8">
			<p class="mb-3">{{ $data->nama_petugas }}</p>
			<p class="mb-3">{{ $data->level->nama_level }}</p>
			<p class="mb-3">{{ $data->user->username }}</p>
		</div>
	</div>
</div>