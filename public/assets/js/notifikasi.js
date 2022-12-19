$(document).ready(function () {
    $.get(BASEURL + '/notifikasi', function (response) {
        $(".noti-body").html('');
        $("#badge-notifikasi").html('');

        if (response.total_notifikasi > 0) {
            $("#badge-notifikasi").html('<span class="sr-only"></span>');
        } else {
            $(".noti-body").append(`
                <li class="notification text-center">
                    Anda Belum Memiliki Notifikasi
                </li>
            `);
        }
    });
});

function cuti_append(item) {
    return `<li class="notification">
                <div class="media">
                    <img class="img-radius" src="${item.foto_profil}" alt="Foto Profil ${ item.nama }">
                    <div class="media-body">
                        <p><strong>${ item.nama }</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>${ item.waktu }</span></p>
                        <p>Pengajuan Cuti <br>
                            <i class="fas fa-calendar"></i> ${ item.jadwal }
                            ${ item.status }
                        </p>
                        <form action="${ item.form }" method="post">
                            <input type="hidden" name="_token" value="${CSRF}">
                            <input type="hidden" name="_method" value="put">
                            <button type="submit" class="btn btn-link btn-sm p-0 text-primary" onclick="submit();" style="font-size:0.8rem">Tandai Telah Dibaca</button>
                        </form>
                    </div>
                </div>
            </li>`;
}
