import {TabulatorFull as Tabulator} from "tabulator-tables";

(function() {
    "use strict"

    const tableEl = $("#kta-tabulator");

    if (tableEl.length && tableEl.data('url')) {
        const url = tableEl.data('url');
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        const tabulator = new Tabulator("#kta-tabulator", {
            ajaxURL: url,
            ajaxContentType: "json",
            paginationMode: "remote",
            filterMode: "remote",
            sortMode: "remote",
            pagination: true,
            paginationSize: 10,
            paginationSizeSelector: [10, 20, 50, 100],
            paginationCounter: "rows",
            layout: "fitColumns",
            responsiveLayout: "collapse",
            placeholder: "Data tidak ditemukan",
            // persistence: true,
            selectable: false,
            columns: [
                {
                    title: "No",
                    width: 100,
                    responsive: 0,
                    vertAlign: "middle",
                    headerHozAlign: "center",
                    hozAlign: "center",
                    print: false,
                    download: false,
                    formatter:"rownum"
                },
                {
                    title: "No. KTA",
                    minWidth: 100,
                    responsive: 0,
                    field: "no_kta",
                    vertAlign: "middle",
                    headerHozAlign: "center",
                    hozAlign: "center",
                    print: false,
                    download: false,
                },
                {
                    title: "Nama",
                    minWidth: 300,
                    responsive: 0,
                    field: "full_name",
                    vertAlign: "middle",
                    headerHozAlign: "center",
                    hozAlign: "center",
                    print: false,
                    download: false,
                },
                {
                    title: "Pangkat Terakhir",
                    minWidth: 150,
                    responsive: 0,
                    field: "pangkat_terakhir",
                    vertAlign: "middle",
                    headerHozAlign: "center",
                    hozAlign: "center",
                    print: false,
                    download: false,
                },
                {
                    title: "NIK",
                    minWidth: 150,
                    responsive: 0,
                    field: "nik",
                    vertAlign: "middle",
                    headerHozAlign: "center",
                    hozAlign: "center",
                    print: false,
                    download: false,
                },
                {
                    title: "Lihat Kartu",
                    minWidth: 150,
                    responsive: 0,
                    field: "show_card",
                    headerHozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div class="flex items-center lg:justify-center">

                                    <a href="${cell.getData().card.front}" target="_blank" class="rounded-md border border-primary px-3 py-1 text-primary mr-2">
                                    Depan
                                    </a><br>

                                    <a href="${cell.getData().card.back}" target="_blank" class="rounded-md border border-primary px-3 py-1 text-primary">
                                    Belakang
                                    </a>

                                </div>`;
                    },
                },
                {
                    title: "ACTIONS",
                    minWidth: 50,
                    field: "actions",
                    responsive: 1,
                    hozAlign: "center",
                    headerHozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                            return `<div class="flex items-center lg:justify-center">

                            <a href="javascript:;" class="flex items-center mr-3 text-warning btn-kta-edit" data-url="${cell.getData().urls.detail_url}" data-form-url="${cell.getData().urls.update_url}">
                                <i data-lucide="pencil" class="w-4 h-4 mr-1"></i> Edit
                            </a>

                        </div>`
                    },
                },
            ]
        });

        tabulator.on("renderComplete", () => {
            createIcons({
                icons,
                attrs: {
                    "stroke-width": 1.5,
                },
                nameAttr: "data-lucide",
            });
        });

        // Redraw table onresize
        window.addEventListener("resize", () => {
            tabulator.redraw();
            createIcons({
                icons,
                "stroke-width": 1.5,
                nameAttr: "data-lucide",
            });
        });

        // Filter function
        function filterHTMLForm() {
            let value = $("#tabulator-html-filter-value").val();
            tabulator.setFilter([
                {field:'value', type:'like', value:value},
            ]);
        }

        $("#tabulator-html-filter-value").on('keyup', helper.delayWithClear(function(e){
            e.preventDefault();
            filterHTMLForm();
        }, 700));

        $("#tabulator-html-filter-reset").on("click", function (e) {
            e.preventDefault();
            $("#tabulator-html-filter-value").val("");
            filterHTMLForm();
        });

        window.alertConfirm = function (formId) {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Apakah anda ingin melanjutkan proses ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#E11D48',
                confirmButtonText: 'Ya, lanjutkan!',
                cancelButtonText: "Tidak!",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    }
})()
