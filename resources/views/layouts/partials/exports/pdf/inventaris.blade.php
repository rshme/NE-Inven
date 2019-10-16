@extends('layouts.pdf_template')

@section('content')
<table>
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Barang</th>
			<th>Jenis</th>
			<th>Ruangan</th>
			<th>Petugas</th>
			<th>Kondisi</th>
			<th>Jumlah</th>
			<th>Keterangan</th>
			<th>Kode Inventaris</th>
			<th>Tanggal Register</th>
		</tr>
	</thead>
	<tbody>
		@foreach($inventaris as $data)
			<tr>
				<td>{{ $loop->index + 1 }}</td>
				<td>{{ $data->nama }}</td>
				<td>{{ $data->jenis->nama_jenis }}</td>
				<td>{{ $data->ruang->nama_ruang }}</td>
				<td>{{ $data->petugas->nama_petugas }}</td>
				<td>{{ $data->kondisi }}</td>
				<td>{{ $data->jumlah }}</td>
				<td>{{ $data->keterangan }}</td>
				<td>
					@php
						$inven = explode('-', $data->kode_inventaris);

			            // data[1] = id_jenis, data[2] = id_ruang

			            $inven[1] = \App\Jenis::where('id_jenis', $inven[1])->first()['kode_jenis'];

			            $inven[2] = \App\Ruang::where('id_ruang', $inven[2])->first()['kode_ruang'];

			            echo implode('-', $inven);
					@endphp
				</td>
				<td>{{ $data->tanggal_register }}</td>
			</tr>
		@endforeach
	</tbody>
</table>
@endsection