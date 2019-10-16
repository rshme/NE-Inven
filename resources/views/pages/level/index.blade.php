@extends('layouts.dashboard')

@section('title')
	| Level
@endsection

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-md-4">
								<h4>Level</h4>
							</div>
							<div class="col-md-8 d-flex justify-content-end">
								<a href="{{ route('level.create') }}" class="btn btn-primary" id="btn-create">
									<i class="fas fa-plus"></i> Tambah Level
								</a>

								<a href="{{ route('level.excel') }}" class="btn btn-success ml-3">
									<i class="fas fa-table"></i> Download Excel
								</a>

								<a href="{{ route('level.pdf') }}" class="btn btn-danger ml-3">
									<i class="fas fa-file-pdf"></i> Download PDF
								</a>

								<a href="#" class="btn btn-warning ml-3" id="btn-print" data-title="Data Level Petugas">
									<i class="fas fa-print"></i> Print Laporan
								</a>
							</div>
						</div>
					</div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-stripped" id="tableLevel">
							<thead>
								<tr>
									<th>
										No
									</th>
									<th>
										Nama Level
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
               $('#tableLevel').DataTable({
                    responsive: true,
                    processing:true,
                    serverSide:true,
                    ajax: "{{ route('level.data') }}",
                    columns : [
                         {data: "DT_RowIndex", orderable: false, searchable: false},
                         {data: "nama"},
                         {data: "action", orderable: false, searchable: false},
                    ]
               });  
          });
	</script>

@endpush