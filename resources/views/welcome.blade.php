@extends('layouts.dashboard')

@section('content')
	<section id="property">
		<div class="container">
			<div class="row ml-1">
				<div class="col-12">
					<div class="row">
						<div class="col-3 mb-4">
							<div class="card">
								<div class="card-header">
									<h3 class="text-center" style="font-weight:bold; padding: 0; margin: 0">
										NE - Inven
									</h3>
								</div>
								<div class="card-body" style="margin-bottom: -10px;">
									<p><b>NE - Inven</b> (NESAS Inventaris) merupakan sebuah aplikasi pengolahan inventaris yang bertujuan untuk mengefektifkan proses pendataan inventaris</p>
								</div>
							</div>
						</div>

						<div class="col-3 mb-4">
							<div class="card">
								<div class="card-header">
									<h5 class="text-center" style="font-weight:bold;">
									<i class="fas fa-box"></i><br> Inventaris
									</h5>
								</div>
								<div class="card-body">
									<p>Jumlah : {{ count(\App\Inventaris::all()) }}</p>
									<p>Terakhir Diperbaharui : <br>{{ \Jenssegers\Date\Date::parse(\App\Inventaris::orderBy('created_at', 'desc')->first()['created_at'])->format('d F Y') }}</p>
								</div>
							</div>
						</div>

						<div class="col-3 mb-4">
							<div class="card">
								<div class="card-header">
									<h5 class="text-center" style="font-weight:bold;"><i class="fas fa-clipboard"></i><br> Peminjaman</h5>
								</div>
								<div class="card-body">
									<p>Jumlah : {{ count(\App\Peminjaman::where('status_peminjaman', 'Belum Kembali')->get()) }}</p>
									<p>Terakhir Diperbaharui : <br>{{ \Jenssegers\Date\Date::parse(\App\Peminjaman::where('status_peminjaman', 'Sudah Kembali')->orderBy('updated_at', 'desc')->first()['updated_at'])->format('d F Y') }}</p>
								</div>
							</div>
						</div>

						<div class="col-3 mb-4">
							<div class="card">
								<div class="card-header">
									<h5 class="text-center" style="font-weight:bold;"><i class="fas fa-clipboard"></i><br> Pengembalian</h5>
								</div>
								<div class="card-body">
									<p>Jumlah : {{ count(\App\Peminjaman::where('status_peminjaman', 'Sudah Kembali')->get()) }}</p>
									<p>Terakhir Diperbaharui : <br>{{ \Jenssegers\Date\Date::parse(\App\Peminjaman::where('status_peminjaman', 'Belum Kembali')->orderBy('updated_at', 'desc')->first()['updated_at'])->format('d F Y') }}</p>
								</div>
							</div>
						</div>

						<div class="col-3 mb-4">
							<div class="card">
								<div class="card-header">
									<h5 class="text-center" style="font-weight:bold;"><i class="fas fa-book"></i><br> Jenis Inventaris</h5>
								</div>
								<div class="card-body">
									<p>Jumlah : {{ count(\App\Jenis::all()) }}</p>
									<p>Terakhir Diperbaharui : <br>{{ \Jenssegers\Date\Date::parse(\App\Jenis::orderBy('updated_at', 'desc')->first()['updated_at'])->format('d F Y') }}</p>
								</div>
							</div>
						</div>

						<div class="col-3 mb-4">
							<div class="card">
								<div class="card-header">
									<h5 class="text-center" style="font-weight:bold;"><i class="fas fa-home"></i><br> Ruangan</h5>
								</div>
								<div class="card-body">
									<p>Jumlah : {{ count(\App\Ruang::all()) }}</p>
									<p>Terakhir Diperbaharui : <br>{{ \Jenssegers\Date\Date::parse(\App\Ruang::orderBy('updated_at', 'desc')->first()['updated_at'])->format('d F Y') }}</p>
								</div>
							</div>
						</div>

						<div class="col-3 mb-4">
							<div class="card">
								<div class="card-header">
									<h5 class="text-center" style="font-weight:bold;"><i class="fas fa-user"></i><br> Pegawai</h5>
								</div>
								<div class="card-body">
									<p>Jumlah : {{ count(\App\Pegawai::all()) }}</p>
									<p>Terakhir Diperbaharui : <br>{{ \Jenssegers\Date\Date::parse(\App\Pegawai::orderBy('updated_at', 'desc')->first()['updated_at'])->format('d F Y') }}</p>
								</div>
							</div>
						</div>

						<div class="col-3 mb-4">
							<div class="card">
								<div class="card-header">
									<h5 class="text-center" style="font-weight:bold;"><i class="fas fa-user"></i><br> Petugas</h5>
								</div>
								<div class="card-body">
									<p>Jumlah : {{ count(\App\Petugas::all()) }}</p>
									<p>Terakhir Diperbaharui : <br>{{ \Jenssegers\Date\Date::parse(\App\Petugas::orderBy('updated_at', 'desc')->first()['updated_at'])->format('d F Y') }}</p>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>
@endsection