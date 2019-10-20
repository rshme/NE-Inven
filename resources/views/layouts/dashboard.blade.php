<!DOCTYPE html>
	<html>
		<head>
			<meta charset="UTF-8">
	   	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	   	    <meta name="csrf-token" content="{{ csrf_token() }}">
			<title>Ne - In | Dashboard @yield('title')</title>
			<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
			<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
			<link rel="stylesheet" type="text/css" media="screen and (max-width:768px)" href="{{ asset('css/tablet.css') }}">
			<link rel="stylesheet" type="text/css" href="{{ asset('css/all.css') }}">
			<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/datatables.min.css') }}">
			@stack('style')
		</head>
	<body>

		@include('layouts.partials.modal_periode')

		<div class="header">
			<div class="left">
				<h3>NE ~ Inven</h3>
			</div>
			<div class="right">
				<li class="dropdown" style="padding:0;list-style: none">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->petugas->nama_petugas }} <span class="caret"></span>
                    </a>

                     <ul class="dropdown-menu" role="menu">
                         <li>
                            <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            	<i class="fas fa-power-off"></i> Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" style="display: none;">
                               {{ csrf_field() }}
                            </form>
                          </li>
                        </ul>
                </li>
			</div>
		</div>
		@include('layouts.partials.modal')

		<div class="row dashboard">
			<div class="left">
				@include('layouts.partials.sidebar')
			</div>
			<div class="right">
				@yield('content')
			</div>
		</div>

		<script src="{{ asset('js/app.js') }}"></script>
		<script src="{{ asset('vendor/datatables/js/datatables.min.js') }}"></script>
		<script src="{{ asset('vendor/sweetalert2.all.js') }}"></script>
		<script src="{{ asset('vendor/printThis.js') }}"></script>
		<script src="{{ asset('js/custom.js') }}"></script>
		@stack('script')
		<script>

			$.fn.dataTable.ext.errMode = 'none';
			
			// printThis
			$('body').on('click', '#btn-print', function(e){

				$('table th:last-child').hide();

				$('table').css({
					'text-align':'center'
				});

				setTimeout(()=>{
					$('table th:last-child').show();
					$('table').css({
						'text-align':'left'
					});
				}, 2000);

				const title = $(this).data('title');

				$('table').printThis({
			        importCSS: true, // import parent page css
			        importStyle: true, // import style tags
			        loadCSS: "{{ asset('css/app.css') }}",
			        pageTitle: title, // add title to print page
			    }); 
			});
		</script>
	</body>
	</html>		