$(document).on('submit','.form', function(event) {
    event.preventDefault();
    const form = $(this);
    const url = $(this).attr('action');
    $.ajax({
        url: url,
        type: 'POST',
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $(form).find('button[type="submit"]').attr('disabled', 'disabled');
            $(form).find('button[type="submit"]').html(`<span class="spinner-border spinner-border-sm" role="status"></span>`);
        },
        success: function(response) {
            $(form).find('button[type="submit"]').html('Simpan');
            $(form).find('button[type="submit"]').removeAttr('disabled');
            if (response.success == false) {
                alertError();
                let error = '';
                $.each(response.message, function(key, item) {
                    error += '<li>'
                    error += item;
                    error += '</li>'
                });
                $("#pesanError").html(error);
            } else {
                alertSuccess(response.message);
                setTimeout(() => {
                    $(".notifikasi").html('');
                }, 3000);
                if (response.redirect) {
                    location.href = response.redirect;
                }

                if (response.reload_table) {
                    $(".modal").modal('hide');
                    $("table").DataTable().ajax.reload();
                }

                if (response.reload) {
                    location.reload();
                }
            }
        },
        error: function(response) {
            console.clear();
            $(form).find('button[type="submit"]').html('SIMPAN');
            $(form).find('button[type="submit"]').removeAttr('disabled');
            alertError();
            let focus = true;
            $.each(response.responseJSON.errors, function(i, e) {
                $('#pesanError').append(`<li>` + e + `</li>`);
                if (!$("[name='" + i + "']").hasClass('is-invalid')) {
                    $("[name='" + i + "']").addClass('is-invalid');
                    $("[name='" + i + "']").siblings('.invalid-feedback').html(e);
                    if ($("[name='" + i + "']").is(':radio')) {
                        $("[name='" + i + "']").parent().parent().siblings('.invalid-feedback').html(e);
                    }
                    if ($("[name='" + i + "']").is(':checkbox')) {
                        $("[name='" + i + "']").parent().parent().siblings('.invalid-feedback').html(e);
                    }
                    if ($("[name='" + i + "']").is('select')) {
                        $("[name='" + i + "']").siblings('.select2').children('.selection').children('.select2-selection').css('border-color', '#FF5370');
                    }
                    if (focus) {
                        $("[name='" + i + "']").focus();
                        focus = false;
                    }
                }
            });
        }
    });
});

function formCRUD(judul, alamat, slug, callback) {
    $(document).on('click', `#hapus-${slug}`, function(event) {
        event.preventDefault();
        let id = [];
        if (confirm("Apakah anda yakin ingin menghapus data ini?")) {
            $(`.check-${slug}:checked`).each(function() {
                id.push($(this).val());
            });
            if (id.length > 0) {
                $.ajax({
                    url: BASEURL + "/" + alamat,
                    method: 'delete',
                    data: {
                        _token: CSRF,
                        id: id,
                    },
                    success: function(response) {
                        if (response.success) {
                            alertSuccess(response.message);
                            if($(`.table-${slug}`).DataTable) {
                                $(`.table-${slug}`).DataTable().ajax.reload();
                                $(`#check_all-${slug}`).prop('checked', false);
                            } else {
                                location.reload();
                            }
                        }
                    }
                });
            } else {
                alertFail('Harap pilih salah satu');
            }
        }
    });

    $(document).on('click', `#check_all-${slug}`, function() {
        if (this.checked) {
            $(`.check-${slug}`).prop('checked', true);
        } else {
            $(`.check-${slug}`).prop('checked', false);
        }
    });

    $(`#tambah-${slug}`).click(function(event) {
        event.preventDefault();
        $(`#modal-${slug}Label`).html('Tambah ' + judul);
        $(`#form-${slug}`).find('.invalid-feedback').html('');
        for (const iterator of $(`#form-${slug}`).find('.form-control')) {
            $(iterator).removeClass('is-invalid');
        }
        $(`#form-${slug}`)[0].reset();
        $(`#form-${slug}`).attr('action', BASEURL + '/' + alamat);
        $(`#form-${slug}`).children('input[name="_method"]').val('post');
    });

    $(document).on('click', `.ubah-${slug}`, function(event) {
        event.preventDefault();
        $(`#form-${slug}`).find('.invalid-feedback').html('');
        const btn = $(this);
        $(btn).html(`<span class="spinner-border spinner-border-sm" role="status"></span>`);
        $.get(BASEURL + '/' + alamat + '/' + $(this).data('id'), function(response) {
            if (response.success) {
                $(btn).html(`<i class="fas fa-edit"></i>`);
                $(`#modal-${slug}`).modal('show');
                $(`#modal-${slug}Label`).html('Ubah ' + judul);
                for (const iterator of $(`#form-${slug}`).find('.form-control')) {
                    $(iterator).removeClass('is-invalid');
                }
                callback(response);
                $(`#form-${slug}`).attr('action', BASEURL + '/' + alamat + '/' + $(btn).data('id'));
                $(`#form-${slug}`).children('input[name="_method"]').val('put');
            }
        });
    });
}
