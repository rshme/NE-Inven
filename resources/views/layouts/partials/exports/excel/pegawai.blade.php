<table>
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Pegawai</th>
			<th>NIP</th>
			<th>Alamat</th>
		</tr>
	</thead>
	<tbody>
		@foreach($pegawai as $data)
			<tr>
				<td>{{ $loop->index + 1 }}</td>
				<td>{{ $data->nama_pegawai }}</td>
				<td>{{ $data->nip }}</td>
				<td>{{ $data->alamat }}</td>
			</tr>
		@endforeach
	</tbody>
</table>