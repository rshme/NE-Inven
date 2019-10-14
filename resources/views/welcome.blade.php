@extends('layouts.dashboard')

@section('content')
	<section id="property">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="row">
						@foreach($properties as $property)
							<div class="col-3">
								<div class="card">
									<div class="card-header">
										<h5 class="text-center" style="font-weight:bold;">{{ $property->nama }}</h5>
									</div>
									<div class="card-body">
										<p>Jumlah : {{ $property->jumlah  }}</p>
										<p>Terakhir Diperbaharui : <br>{{ \Jenssegers\Date\Date::parse($property->updated_at)->format('d F Y') }}</p>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection