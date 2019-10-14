$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

window.Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});

// show modal

$('body').on('click', '.btn-login', function(e){
	e.preventDefault();

	const url = $(this).attr('href');

	$.ajax({
		url:url,
		dataType: 'html',
		success: function(res){
			$('#mymodal .modal-title').text('Sign In');
			$('#mymodal #action-secondary').hide();
			$('#mymodal .modal-body').html(res);
			$('#mymodal').modal('show');
		}
	});
})

$('body').on('submit', '#form-login', function(e){
	e.preventDefault();
	
	const url = $(this).attr('action'),
		form = $('#form-login').serialize();

		$('form').find('.form-group').removeClass('has-errors');
		$('span.help-block').remove();

	$.ajax({
		url: url,
		type:'POST',
		data:form,
		success: function(res)
		{
			$('#mymodal').modal('hide');
			// $('#action-primary').removeAttr('data');
			Toast.fire({
			  type: 'success',
			  title: 'Login Berhasil'
			});

			setTimeout(()=>{
				window.location.href = '/dashboard';
			}, 3100);

		},

		error: function(xhr){
			const errors = xhr.responseJSON;

			if (xhr.status === 401) {
				$('#form-login .errors').html(
					`<span class="help-block">`+errors.msg+`</span>`
				);
			}

			$.each(errors.errors, function(key, value){
				$('#'+key)
				.closest('.form-group')
				.addClass('has-errors')
				.append(
					`<span class="help-block">`+value+`</span>`
				);
			});
		}
	})
})

$('body').on('click', '#btn-create', function(e){
	e.preventDefault();

	const url = $(this).attr('href');

	$.ajax({
		url:url,
		dataType: 'html',
		success: function(res){
			$('#mymodal .modal-title').text('Tambah Data');
			$('#mymodal .modal-body').html(res);
			$('#mymodal').modal('show');
		}
	});
})

$('body').on('submit', '#form-store', function(e){
	e.preventDefault();

	const url = $(this).attr('action'),
		form = $(this).serialize();

	$('form').find('.form-group').removeClass('has-errors');
	$('form').find('.help-block').remove();

	$.ajax({
		url:url,
		type:'POST',
		data: form,
		success: function(res){
			$('#mymodal').modal('hide');

			Swal.fire({
				title:'Sukses !',
				type:'success',
				text:res.msg,
				showConfirmButton: false,
				timer: 2000
			});

			$('#tablePegawai').DataTable().ajax.reload();
			$('#tableJenis').DataTable().ajax.reload();
			$('#tableRuang').DataTable().ajax.reload();
			$('#tablePetugas').DataTable().ajax.reload();
			$('#tableInventaris').DataTable().ajax.reload();
			$('#tablePeminjaman').DataTable().ajax.reload();
			$('#tableLevel').DataTable().ajax.reload();
		},

		error: function(xhr){
			const errors = xhr.responseJSON;

			$.each(errors.errors, function(key, value){
				$('#' + key)
				.closest('.form-group')
				.addClass('has-errors')
				.append(
					`<span class="help-block">`+value+`</span>`
				)
			});
		}
	});
})

$('body').on('click', '.btn-edit', function(e){
	e.preventDefault();

	const url = $(this).attr('href');

	const data = $(this).attr('title');

	$.ajax({
		url:url,
		dataType: 'html',
		success: function(res){
			$('#mymodal .modal-title').text('Edit '+data);
			$('#mymodal .modal-body').html(res);
			$('#mymodal').modal('show');
		}
	});
})

$('body').on('submit', '#form-edit', function(e){
	e.preventDefault();

	const url = $(this).attr('action'),
		form = $(this).serialize();

	$('form').find('.form-group').removeClass('has-errors');
	$('form').find('.help-block').remove();

	$.ajax({
		url:url,
		type:'POST',
		data: form,
		success: function(res){
			$('#mymodal').modal('hide');

			Swal.fire({
				title:'Sukses !',
				type:'success',
				text:res.msg,
				showConfirmButton: false,
				timer: 2000
			});

			$('#tablePegawai').DataTable().ajax.reload();
			$('#tableRuang').DataTable().ajax.reload();
			$('#tableJenis').DataTable().ajax.reload();
			$('#tablePetugas').DataTable().ajax.reload();
			$('#tableInventaris').DataTable().ajax.reload();
			$('#tablePeminjaman').DataTable().ajax.reload();
			$('#tableLevel').DataTable().ajax.reload();
		},

		error: function(xhr){
			const errors = xhr.responseJSON;

			$.each(errors.errors, function(key, value){
				$('#' + key)
				.closest('.form-group')
				.addClass('has-errors')
				.append(
					`<span class="help-block">`+value+`</span>`
				)
			});
		}
	});
})

$('body').on('click', '#btn-delete', function(e){
	e.preventDefault();

	const url = $(this).attr('href');

	const data = $(this).attr('title');

	Swal.fire({
		title:'Anda Yakin ?',
		type:'warning',
		text:data + ' Akan Dihapus Permanen',
		showCancelButton: true,
		confirmButtonColor:'#EF2E2E',
		cancelButtonColor:'#8A8A8A',
		confirmButtonText:'Ya, Hapus !',
		cancelButtonText:'Batal',
	})
	.then(res=>{
		if (res.value) {
			$.ajax({
				url:url,
				type:'POST',
				data: {
					'_method':'DELETE'
				},
				success: function(res){
					$('#mymodal').modal('hide');

					Swal.fire({
						title:'Sukses !',
						type:'success',
						text:res.msg,
						showConfirmButton: false,
						timer: 1800
					});

					$('#tablePegawai').DataTable().ajax.reload();
					$('#tableJenis').DataTable().ajax.reload();
					$('#tableRuang').DataTable().ajax.reload();
					$('#tableInventaris').DataTable().ajax.reload();
					$('#tablePetugas').DataTable().ajax.reload();
					$('#tablePeminjaman').DataTable().ajax.reload();
					$('#tableLevel').DataTable().ajax.reload();
				}
			});
		}
	})
})

$('body').on('click', '.btn-show', function(e){
	e.preventDefault();

	const url = $(this).attr('href');

	const data = $(this).attr('title');

	$.ajax({
		url:url,
		dataType: 'html',
		success: function(res){
			$('#mymodal .modal-title').text('Detail '+data);
			$('#mymodal .modal-body').html(res);
			$('#mymodal').modal('show');
		}
	});
});