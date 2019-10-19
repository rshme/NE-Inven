	<div class="form-group">
		<label for="id_inventaris">
			Barang
		</label>
		<select name="id_inventaris" class="custom-select" id="id_inventaris">
			<option selected value="">Pilih Barang</option>
			@foreach($data as $barang)
				@if($barang->detail->jumlah > 0)
					<option value="{{ $barang->detail->id_inventaris }}">{{ $barang->detail->inventaris->nama }}</option>
				@endif
			@endforeach
		</select>
	</div>

	<div class="form-group">
		<label for="jumlah">
			Jumlah
		</label>
		<input type="text" name="jumlah" class="form-control" id="jumlah" autocomplete="off">
	</div>