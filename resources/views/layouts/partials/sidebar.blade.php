<div class="sidebar-wrapper">
	<ul class="sidebar-ul">
		<li class="sidebar-item">
			<a href="{{ route('dashboard') }}"><i class="fas fa-ellipsis-h mr-2"></i> <span>Dashboard</span> </a>
		</li>
		<li class="sidebar-item">
			<a href="{{ route('inventaris.index') }}"><i class="fas fa-box mr-2"></i> <span>Inventaris</span> </a>
		</li>
		<li class="sidebar-item">
			<a href="{{ route('peminjaman.index') }}"><i class="fas fa-clipboard mr-2"></i> <span>Peminjaman</span></a>
		</li>
		<li class="sidebar-item">
			<a href="{{ route('pengembalian.index') }}"><i class="fas fa-clipboard mr-2"></i> <span>Pengembalian</span></a>
		</li>
		@if(auth()->user()->petugas->id_level === 1)
			<li class="sidebar-item">
				<a href="{{ route('jenis.index') }}"><i class="fas fa-book mr-2"></i> <span>Jenis</span></a>
			</li>
			<li class="sidebar-item">
				<a href="{{ route('ruang.index') }}"><i class="fas fa-home mr-2"></i> <span>Ruang</span></a>
			</li>
		{{-- <li class="sidebar-item">
				<a href="{{ route('level.index') }}"><i class="fas fa-key mr-2"></i> <span>Level</span></a>
			</li> --}}
			<li class="sidebar-item">
				<a href="{{ route('pegawai.index') }}"><i class="fas fa-user mr-2"></i> <span>Pegawai</span></a>
			</li>
			<li class="sidebar-item">
				<a href="{{ route('petugas.index') }}"><i class="fas fa-user mr-2"></i> <span>Petugas</span></a>
			</li>
		@endif
{{-- 		<li class="sidebar-item menu-collapse">
			<i class="fas fa-play mr-2"></i>  <span>Collapse Menu</span>
		</li> --}}
	</ul>
</div>