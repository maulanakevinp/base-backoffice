document.addEventListener("keydown", function(event) {
    if (event.keyCode == 27) {
        $('.alert-dismissible').remove();
        $(".modal").modal('hide');
    }
});

$(document).on("change", "input", function(event) {
    $(this).attr('value', this.value);
    $(this).removeClass('is-invalid');
    $(this).siblings('.invalid-feedback').html('');
    if ($(this).is(':radio')) {
        $(this).parent().parent().siblings('.invalid-feedback').html('');
    }
    $('.alert-dismissible').remove();
});

$(document).on("change", "select", function(event) {
    const select = $(this).attr('value', this.value);
    $.each(this, function(key, item) {
        if ($(item).val() == $(select).attr('value')) {
            $(this).attr('selected', $(this).prop('selected'));
        } else {
            $(this).attr('selected', $(this).prop('selected'));
        };
    });
    $(this).removeClass('is-invalid');
    $(this).siblings('.invalid-feedback').html('');
    $(this).siblings('.select2').children('.selection').children('.select2-selection').css('border-color', '#e2e5e8');
    $('.alert-dismissible').remove();
});

$(document).on("change", "textarea", function(event) {
    $(this).html(event.target.value);
    $(this).removeClass('is-invalid');
    $(this).siblings('.invalid-feedback').html('');
    $('.alert-dismissible').remove();
});

$(document).on("click", "input[type='checkbox']", function() {
    $(this).tooltip('hide');
    $(this).attr('checked', $(this).prop('checked'));
});

$(document).on('click', '.hapus-data', function(event) {
    event.preventDefault();
    $('#modal-hapus').modal('show');
    $('#nama-hapus').html('Apakah Anda yakin ingin menghapus ' + $(this).data('nama') + '???');
    $('#form-hapus').attr('action', $(this).data('action'));
});

$(document).on("submit", "form", function() {
    $(this).find("button:submit").attr('disabled', 'disabled');
    $(this).find("button:submit").html(`<span class="spinner-border spinner-border-sm" role="status"></span>`);
});

$(document).on('change','.custom-file-input', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
 });

function alertSuccess(pesan) {
    $('.notifikasi').html(`
        <div class="alert alert-success alert-dismissible fade show">
            <span class="alert-icon"><i class="fas fa-check-circle"></i> <strong>Berhasil</strong></span>
            <span class="alert-text">
                ${pesan}
            </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `);
}

function alertFail(pesan) {
    $('.notifikasi').html(`
        <div class="alert alert-danger alert-dismissible fade show">
            <span class="alert-icon"><i class="fas fa-times-circle"></i> <strong>Gagal</strong></span>
            <span class="alert-text">
                ${pesan}
            </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `);
}

function alertError() {
    $('.notifikasi').html(`
        <div class="alert alert-danger alert-dismissible fade show">
            <span class="alert-icon"><i class="fas fa-times-circle"></i> <strong>Gagal</strong></span>
            <span class="alert-text">
                <ul id="pesanError"></ul>
            </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `);
}

function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function hanyaHuruf(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if ((charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && charCode > 32)
        return false;
    return true;
}

function uploadImage(inputFile) {
    if (inputFile.files && inputFile.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(inputFile).siblings('img').attr("src", e.target.result);
        }
        reader.readAsDataURL(inputFile.files[0]);
    }
}

function diffTime(start, end) {
    start = start.split(":");
    end = end.split(":");
    var startDate = new Date(0, 0, 0, start[0], start[1], 0);
    var endDate = new Date(0, 0, 0, end[0], end[1], 0);
    var diff = endDate.getTime() - startDate.getTime();
    var hours = Math.floor(diff / 1000 / 60 / 60);
    diff -= hours * 1000 * 60 * 60;
    var minutes = Math.floor(diff / 1000 / 60);

    return (hours < 9 ? "0" : "") + hours + ":" + (minutes < 9 ? "0" : "") + minutes;
}

function kriteria() {
    switch ($("#kriteria").val()) {
        case 'periode':
            $("#periode").show();
            $("#rentang-waktu").hide();
            $("#bulan").hide();
            $("#tahun").hide();
            break;
        case 'rentang-waktu':
            $("#periode").hide();
            $("#rentang-waktu").show();
            $("#bulan").hide();
            $("#tahun").hide();
            break;
        case 'bulan':
            $("#periode").hide();
            $("#rentang-waktu").hide();
            $("#bulan").show();
            $("#tahun").hide();
            break;
        case 'tahun':
            $("#periode").hide();
            $("#rentang-waktu").hide();
            $("#bulan").hide();
            $("#tahun").show();
            break;
    }
}

function kriteria_jadwal() {
    switch ($("#kriteria").val()) {
        case 'periode':
            $(".periode").show();
            $(".rentang-waktu").hide();
            $(".bulan").hide();
            $(".tahun").hide();
            break;
        case 'rentang-waktu':
            $(".periode").hide();
            $(".rentang-waktu").show();
            $(".bulan").hide();
            $(".tahun").hide();
            break;
        case 'bulan':
            $(".periode").hide();
            $(".rentang-waktu").hide();
            $(".bulan").show();
            $(".tahun").hide();
            break;
        case 'tahun':
            $(".periode").hide();
            $(".rentang-waktu").hide();
            $(".bulan").hide();
            $(".tahun").show();
            break;
        default:
            $(".periode").hide();
            $(".rentang-waktu").hide();
            $(".bulan").hide();
            $(".tahun").hide();
            break;
    }
}

function kriteria_laporan() {
    var url = new URL(window.location.href);
    switch (url.searchParams.get("kriteria")) {
        case 'periode':
            return 'periode ' + url.searchParams.get("periode").replaceAll('-',' ');
        case 'rentang-waktu':
            let awal = new Date(url.searchParams.get("tanggal_awal"));
            let akhir = new Date(url.searchParams.get("tanggal_akhir"));
            return awal.toLocaleString('id-ID',{dateStyle: 'long'}) + ' s/d ' + akhir.toLocaleString('id-ID',{dateStyle: 'long'});
        case 'bulan':
            let bulan = new Date(url.searchParams.get("bulan"));
            return 'bulan ' + bulan.toLocaleString("id-ID", {month: 'long'}) + ' ' + bulan.toLocaleString("id-ID", {year: 'numeric'});
        case 'tahun':
            return 'tahun ' + url.searchParams.get("tahun");
    }
}

function angka(str) {
    let res = str.replace('Rp. ', '');
    let angka = res.replaceAll('.', '');
    let nilai = parseFloat(angka);
    if (isNaN(nilai)) {
        nilai = 0;
    }
    return nilai;
}

function jumlah(nama) {
    let nilai = 0;
    $(`.${nama}`).each(function() {
        nilai += angka($(this).html());
    });
    return nilai;
}

function printDiv(div,html) {

    var divToPrint=document.getElementById(div);
    var newWin=window.open('','Print-Window');
    newWin.document.open();
    newWin.document.write(`
        <html>
            <head>
                <link rel="stylesheet" href="${BASEURL}/assets/css/style.css">
            </head>
            <body onload="window.print()">${html}${divToPrint.innerHTML}</body>
        </html>
    `);
    newWin.document.close();
}

function roundToTwo(num) {
    return +(Math.round(num + "e+2")  + "e-2");
}