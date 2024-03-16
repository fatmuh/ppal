import "./tabulator";

(function () {
    "use strict";

    $(document).on('click', '.btn-kta-edit', function (e) {
        e.preventDefault();

        formReset("PATCH", $(this).data('form-url'));

        const url = $(this).data('url');

        axios.get(url).then((res) => {
            const data = res.data.data;

            $("input#no_kta").val(data.no_kta);
            $("input#full_name").val(data.full_name);
            $("input#ttl").val(data.ttl);
            $("input#agama").val(data.agama);
            $('#gol_darah')[0].tomselect.setValue(data.gol_darah);
            $("input#pangkat_terakhir").val(data.pangkat_terakhir);
            $("input#nik").val(data.nik);
            $("input#tanda_jasa_tertinggi").val(data.tanda_jasa_tertinggi);
            $("input#tanggal_cetak").val(data.tanggal_cetak);
            if (data.foto) {
                $('#foto .form-upload img').attr('src', data.foto);
            }
            if (data.ttd) {
                $('#ttd .form-upload img').attr('src', data.ttd);
            }
            $('#istri_suami')[0].tomselect.setValue(data.istri_suami);
            $("input#nama_istri_suami").val(data.nama_istri_suami);
            $("input#nik_istri_suami").val(data.nik_istri_suami);
            $("input#wil_rayon").val(data.wil_rayon);
            $("input#alamat1").val(data.alamat1);
            $("input#alamat2").val(data.alamat2);

        }).catch((err) => {
            console.error(err);
            alert(err);
        }).finally(() => {
            createIcons({
                icons,
                "stroke-width": 1.5,
                nameAttr: "data-lucide",
            });

            const el = document.querySelector("#form-kta-modal");
            const modal = window.tailwind.Modal.getOrCreateInstance(el);
            modal.toggle();
        });
    });

    $(".btn-kta-add").on('click', function (e) {
        e.preventDefault();

        formReset("POST", $(this).data('form-url'));

        const el = document.querySelector("#form-kta-modal");
        const modal = window.tailwind.Modal.getOrCreateInstance(el);
        modal.toggle();
    });

    $(document).on('click', '.detail-kta', function () {
        const url = $(this).data('href');
        const el = document.querySelector("#kta-detail-modal");
        const modal = tailwind.Modal.getOrCreateInstance(el);
        $('#detail-kta-header-title').text('Detail Data KTA');
        $.ajax({
                url,
                type: 'GET',
                datatype: 'html',
            })
            .done(function (data) {
                $("#kta-detail-modal .modal-body").empty().html(data)
                modal.toggle();
            }).fail(function (jqXHR, textStatus, thrownError) {
                alert('Request failed: ' + textStatus)
            });
    });

    function formReset(method = 'POST', url) {
        const form = $("form#form-kta");
        form[0].reset();

        form.find("input[name=\"_method\"]").val(method);
        form.attr("action", url);
    }
})();
