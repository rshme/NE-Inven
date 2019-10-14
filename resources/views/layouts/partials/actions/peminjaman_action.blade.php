<a class="btn-show" title="Peminjaman {{ $model->pegawai->nama_pegawai }}" href="{{$url_show}}">
	<i class="fas fa-eye text-inverse"></i>
</a>
<a class="btn-edit" title="Peminjaman {{ $model->pegawai->nama_pegawai }}" href="{{$url_edit}}">
	<i class="fas fa-pen text-success"></i>
</a>
<a id="btn-delete" title="Peminjaman {{ $model->pegawai->nama_pegawai }}" href="{{ $url_delete }}">
	<i class="fas fa-trash text-danger"></i>
</a>