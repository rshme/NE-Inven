<!-- Modal -->
<div class="modal fade" id="modalPeriode" tabindex="-1" role="dialog" aria-labelledby="modalPeriodeTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalPeriodeTitle">Periode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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
				<button type="submit" class="btn btn-primary ml-auto" id="action-primary">Download</button>
			</div>
		</form>
      </div>
    </div>
  </div>
</div>