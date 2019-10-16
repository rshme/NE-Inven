@extends('layouts.pdf_template')

@section('content')
	<table>
		<thead>
		<tr>
			<th>No</th>
			<th>Nama Petugas</th>
			<th>Level</th>
		</tr>
		</thead>
		<tbody>
			@foreach($petugas as $data)
				<tr>
					<td>{{ $loop->index + 1 }}</td>
					<td>{{ $data->nama_petugas }}</td>
					<td>{{ $data->level->nama_level }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection