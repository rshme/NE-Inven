@extends('layouts.dashboard')

@section('title')
	| Pengembalian
@endsection

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-md-4">
								<h4>Pengembalian</h4>
							</div>
							<div class="col-md-8 d-flex">
								<a href="{{ route('pengembalian.create') }}" class="btn btn-primary ml-auto" id="btn-create">
									<i class="fas fa-plus"></i> Tambah Pengembalian
								</a>

								@if(auth()->user()->petugas->id_level === 1)
									<a href="{{ route('pengembalian.excel') }}" class="btn btn-success ml-3"
									@if(count($pengembalian) === 0)
										onclick="event.preventDefault();
										alert('Data Kosong');
										"
									@endif
									>
										<i class="fas fa-table"></i> Download Excel
									</a>

									<a href="{{ route('pengembalian.pdf') }}" class="btn btn-danger ml-3">
										<i class="fas fa-file-pdf"></i> Download PDF
									</a>
									<a href="#" class="btn btn-warning ml-3" id="btn-print" data-title="Data Peminjaman">
										<i class="fas fa-print"></i> Print Laporan
									</a>
								@endif
							</div>
						</div>
					</div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-stripped" id="tablePeminjaman">
							<thead>
								<tr>
									<th>
										No
									</th>
									<th>
										Pegawai
									</th>
									<th>
										Barang
									</th>
									<th>
										Sisa Pinjaman
									</th>
									<th>
										Tanggal Pinjam
									</th>
									<th>
										Tanggal Kembali
									</th>
									<th>
										Status
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
               $('#tablePeminjaman').DataTable({
                    responsive: true,
                    processing:true,
                    serverSide:true,
                    ajax: "{{ route('pengembalian.data') }}",
                    columns : [
                         {data: "DT_RowIndex", orderable: false, searchable: false},
                         {data: "pegawai", name:"pegawai"},
                         {data: "barang", name:"barang"},
                         {data: "sisa", name:"sisa"},
                         {data: "tgl_pinjam", name:"tanggal_pinjam"},
                         {data: "tgl_kembali", name:"tanggal_kembali"},
                         {data: "status_peminjaman", name:"status_peminjaman"},
                         {data:'action', orderable: false, searchable: false},
                    ]
               });  
          });
	</script>

@endpush