<!DOCTYPE html>
	<html>
		<head>
		<meta charset="UTF-8">
   	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   	    <meta name="csrf-token" content="{{ csrf_token() }}">
		<title>Nein | @yield('title')</title>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
		@stack('style')
		</head>
	<body>
		@include('layouts.partials.modal')

		@yield('content')

		<script src="{{ asset('js/app.js') }}"></script>
		<script src="{{ asset('vendor/sweetalert2.all.js') }}"></script>
		<script src="{{ asset('js/custom.js') }}"></script>
		@stack('script')
	</body>
	</html>		