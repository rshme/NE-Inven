	<form action="{{ route('inventaris.excel.periode') }}" class="form-horizontal" method="GET" id="form-periode">
			@csrf

			<div class="form-group">
				<label for="begin">
					Dari
				</label>	
				<input type="date" class="form-control" id="begin" name="begin">
			</div>

			<div class="form-group">
				<label for="begin">
					Sampai
				</label>	
				<input type="date" class="form-control" id="until" name="until">
			</div>

			<div class="d-flex">
				<button type="submit" class="btn btn-primary ml-auto" id="btn-download">Download</button>
			</div>
		</form>