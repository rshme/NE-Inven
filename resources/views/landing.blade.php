@extends('layouts.master')

@push('style')
<style>
	#particle-js{
		position:absolute;
		top:0;
		width:0;
		width: 100%;
		height:100%;
		z-index:5;
	}
</style>
@endpush

@section('title')
	Landing Page
@endsection

@section('content')
	<section id="hero">
		<div class="content">
			<h1 class="hero-title">
				NE ~ Inven
			</h1>
			<p>
				Aplikasi Pendataan Inventaris Barang Sekolah
			</p>
			<a class="btn-login" href="{{ route('getlogin') }}">
				Masuk
			</a>
		</div>
	</section>
	<div id="particle-js">
	</div>
@endsection

@push('script')
	<script src="{{ asset('vendor/particles.js') }}"></script>
	<script>
		particlesJS.load('particle-js', '{{ asset('vendor/particlesjs-config.json') }}');
	</script>
@endpush