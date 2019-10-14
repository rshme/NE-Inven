@extends('layouts.dashboard')

@section('title')
	| Ruang
@endsection

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12 col-12">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-md-4 col-4">
								<h4>Ruang</h4>
							</div>
							<div class="col-md-8 col-8 d-flex justify-content-end">
								<a href="{{ route('ruang.create') }}" class="btn btn-primary" id="btn-create">
									<i class="fas fa-plus"></i> Tambah Ruang
								</a>

								<a href="{{ route('ruang.excel') }}" class="btn btn-success ml-3">
									<i class="fas fa-table"></i> Download Excel
								</a>

								<a href="#" class="btn btn-danger ml-3">
									<i class="fas fa-file-pdf"></i> Download PDF
								</a>

								<a href="#" class="btn btn-warning ml-3" id="btn-print" data-title="Data Ruangan">
									<i class="fas fa-print"></i> Print Laporan
								</a>
							</div>
						</div>
					</div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-stripped" id="tableRuang">
							<thead>
								<tr>
									<th>
										No
									</th>
									<th>
										Nama Ruang
									</th>
									<th>
										Kode Ruang
									</th>
									<th>
										Keterangan
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
               $('#tableRuang').DataTable({
                    responsive: true,
                    processing:true,
                    serverSide:true,
                    ajax: "{{ route('ruang.data') }}",
                    columns : [
                         {data: "DT_RowIndex", orderable: false, searchable: false},
                         {data: "nama_ruang"},
                         {data:'kode_ruang'},
                         {data:'keterangan'},
                         {data:'action', orderable: false, searchable: false},
                    ]
               });  
          });
	</script>

@endpush