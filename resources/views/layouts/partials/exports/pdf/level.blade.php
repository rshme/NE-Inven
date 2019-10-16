@extends('layouts.pdf_template')

@section('content')
	<table>
		<thead>
		<tr>
			<th>No</th>
			<th>Nama Level</th>
		</tr>
		</thead>
		<tbody>
			@foreach($level as $data)
				<tr>
					<td>{{ $loop->index + 1 }}</td>
					<td>{{ $data->nama_level }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection