@extends('layouts.pdf_template')

@section('content')
	<table>
		<thead>
		<tr>
			<th>No</th>
			<th>Nama Ruang</th>
			<th>Kode Ruang</th>
			<th>Keterangan</th>
		</tr>
		</thead>
		<tbody>
			@foreach($ruang as $data)
				<tr>
					<td>{{ $loop->index + 1 }}</td>
					<td>{{ $data->nama_ruang }}</td>
					<td>{{ $data->kode_ruang }}</td>
					<td>{{ $data->keterangan }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection