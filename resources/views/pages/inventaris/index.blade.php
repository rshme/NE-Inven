@extends('layouts.dashboard')

@section('title')
	| Inventaris
@endsection

@section('content')

@include('layouts.partials.periode_show')

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-md-4">
								<h4>Inventaris</h4>
							</div>
							<div class="col-md-8 d-flex">
								<a href="{{ route('inventaris.create') }}" class="btn btn-primary ml-auto" id="btn-create">
									<i class="fas fa-plus"></i> Tambah Inventaris
								</a>

								@if(auth()->user()->petugas->id_level === 1)
									<div class="dropdown ml-3">
									  <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									    <i class="fas fa-able"></i> Download Excel
									  </button>
									  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									    <a class="dropdown-item" id="print-periode">Periode</a>
									    <a class="dropdown-item" href="{{ route('inventaris.excel') }}">Semua</a>
									  </div>
									</div>

									<a href="{{ route('inventaris.pdf') }}" class="btn btn-danger ml-3">
										<i class="fas fa-file-pdf"></i> Download PDF
									</a>

									<a href="#" class="btn btn-warning ml-3" id="btn-print" data-title="Data Inventaris">
										<i class="fas fa-print"></i> Print Laporan
									</a>
								@endif
							</div>
						</div>
					</div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-stripped" id="tableInventaris">
							<thead>
								<tr>
									<th>
										No
									</th>
									<th>
										Nama Barang
									</th>
									<th>
										Jenis
									</th>
									<th>
										Ruang
									</th>
									<th>
										Petugas
									</th>
									<th>
										Kondisi
									</th>
									<th>
										Keterangan
									</th>
									<th>
										Jumlah
									</th>
									<th>
										Tanggal Register
									</th>
									<th>
										Kode Inventaris
									</th>
									<th>
										Aksi
									</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('script')

	<script>
		 $(document).ready(function(){
               $('#tableInventaris').DataTable({
                    responsive: true,
                    processing:true,
                    serverSide:true,
                    ajax: "{{ route('inventaris.data') }}",
                    columns : [
                         {data: "DT_RowIndex", orderable: false, searchable: false},
                         {data: "nama"},
                         {data: "jenis"},
                         {data: "ruang"},
                         {data: "petugas"},
                         {data: "kondisi"},
                         {data: "keterangan"},
                         {data: "jumlah"},
                         {data: "tanggal_register"},
                         {data: "kode"},
                         {data: "action", orderable: false, searchable: false},
                    ]
               });  
          });
	</script>

@endpush