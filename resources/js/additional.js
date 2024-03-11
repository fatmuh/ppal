import Toastify from "toastify-js";

(function () {
    'use strict';

    if ($(".hide-unhide-text").length) {
        $(".hide-unhide-text").on('click', function (e) {
            e.preventDefault();

            const el = $(this);
            const input = $(".hide-unhide-text").parent().find('input');

            if (input.attr('type') === "password") {
                el.html('<i data-lucide="eye" class="w-6 h-6 absolute my-auto inset-y-0 mr-3 right-0 cursor-pointer text-slate-400/90"></i>');
                input.attr('type', 'text');
            } else {
                el.html('<i data-lucide="eye-off" class="w-6 h-6 absolute my-auto inset-y-0 mr-3 right-0 cursor-pointer text-slate-400/90"></i>');
                input.attr('type', 'password');
            }

            createIcons({
                icons,
                "stroke-width": 1.5,
                nameAttr: "data-lucide",
            });
        });
    }

    if ($("#success-notification-content").length) {
        Toastify({
            node: $("#success-notification-content")
                .clone()
                .removeClass("hidden")[0],
            duration: 5000,
            newWindow: true,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
        }).showToast();
    }

    if ($("#failed-notification-content").length) {
        Toastify({
            node: $("#failed-notification-content")
                .clone()
                .removeClass("hidden")[0],
            duration: 5000,
            newWindow: true,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
        }).showToast();
    }

    if ($(".btn-confirm").length) {
        $(".btn-confirm").on('click', function (e) {
            e.preventDefault();

            const form = $(this).parents('form');

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Apakah anda ingin melanjutkan proses ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#E11D48',
                confirmButtonText: 'Ya, lanjutkan!',
                cancelButtonText: "Tidak!",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.trigger('submit');
                }
            });
        });
    }

    if ($(".btn-confirm-custom").length) {
        $('.btn-confirm-custom').on('click', function(e) {
            e.preventDefault();
            let form = $(this).parents('form');
            Swal.fire({
                title: 'Apakah anda yakin?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#E11D48',
                confirmButtonText: 'Ya, lanjutkan!',
                cancelButtonText: "Tidak!",
                preConfirm: () => {
                        const g_button = $(this).val()
                        $("#g_button").val(g_button);
                }
            })
            .then((result) => {
                if (result.isConfirmed) {
                    form.trigger('submit');
                }
            })
        });
    }



    window.storageUrl = function(value){
        let csrf = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'POST',
            url: '/fetch-image',
            data: {
                value,
                _token: csrf }
        }).done(function (data) {
            window.open(data, '_blank');
        }).fail(function (jqXHR, textStatus, thrownError) {
            alert('Request failed: ' + textStatus)
        })
    }
})();
