	<div class="form-group">
		<label for="id_inventaris">
			Barang yang dipijam
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
			Jumlah yang dikembalikan
		</label>
		<input type="number" min="1" name="jumlah" class="form-control" id="jumlah" autocomplete="off">
	</div>