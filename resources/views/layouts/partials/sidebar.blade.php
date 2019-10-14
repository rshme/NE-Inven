<div class="sidebar-wrapper">
	<ul class="sidebar-ul">
		@if(auth()->user()->petugas->id_level === 1)
			<li class="sidebar-item">
				<a href="{{ route('inventaris.index') }}"><i class="fas fa-box mr-2"></i> Inventaris</a>
			</li>
			<li class="sidebar-item">
				<a href="{{ route('jenis.index') }}"><i class="fas fa-book mr-2"></i> Jenis</a>
			</li>
			<li class="sidebar-item">
				<a href="{{ route('level.index') }}"><i class="fas fa-key mr-2"></i>Level</a>
			</li>
			<li class="sidebar-item">
				<a href="{{ route('pegawai.index') }}"><i class="fas fa-user mr-2"></i> Pegawai</a>
			</li>
			<li class="sidebar-item">
				<a href="{{ route('petugas.index') }}"><i class="fas fa-user mr-2"></i> Petugas</a>
			</li>
		@endif
		<li class="sidebar-item">
			<a href="{{ route('peminjaman.index') }}"><i class="fas fa-clipboard mr-2"></i> Peminjaman</a>
		</li>
		@if(auth()->user()->petugas->id_level === 1)
			<li class="sidebar-item">
				<a href="{{ route('ruang.index') }}"><i class="fas fa-home mr-2"></i> Ruang</a>
			</li>
		@endif
	</ul>
</div>