@extends('layouts.pdf_template')

@section('content')
	<table>
		<thead>
		<tr>
			<th>No</th>
			<th>Nama Jenis</th>
			<th>Kode Jenis</th>
			<th>Keterangan</th>
		</tr>
		</thead>
		<tbody>
			@foreach($jenis as $data)
				<tr>
					<td>{{ $loop->index + 1 }}</td>
					<td>{{ $data->nama_jenis }}</td>
					<td>{{ $data->kode_jenis }}</td>
					<td>{{ $data->keterangan }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection