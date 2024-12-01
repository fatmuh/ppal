import {TabulatorFull as Tabulator} from "tabulator-tables";

(function() {
    "use strict"

    const tableEl = $("#kta-tabulator");

    if (tableEl.length && tableEl.data('url')) {
        const url = tableEl.data('url');
        const role = tableEl.data('role');
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        const tabulator = new Tabulator("#kta-tabulator", {
            ajaxURL: url,
            ajaxContentType: "json",
            paginationMode: "remote",
            filterMode: "remote",
            sortMode: "remote",
            pagination: true,
            paginationSize: 10,
            paginationSizeSelector: [10, 20, 50, 100, 250],
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
                    width: 220,
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
                    width: 280,
                    responsive: 0,
                    field: "full_name",
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
                    width: 200,
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
                        if(role === 1) {
                            return `<div class="flex items-center lg:justify-center">

                            <a href="javascript:;" class="flex items-center mr-3 text-blue-700 detail-kta" data-href="${cell.getData().urls.data_url}">
                                <i data-lucide="list" class="w-4 h-4 mr-1"></i> Detail
                            </a>

                            <a href="javascript:;" class="flex items-center mr-3 text-yellow-600 btn-kta-edit" data-url="${cell.getData().urls.detail_url}" data-form-url="${cell.getData().urls.update_url}">
                                <i data-lucide="pencil" class="w-4 h-4 mr-1"></i> Edit
                            </a>

                            <a href="javascript:void(0);" class="flex items-center text-danger mr-3" onclick="alertConfirm('delete-kta-form-${cell.getData().id}')">
                                <i data-lucide="trash" class="w-4 h-4 mr-1"></i> Delete
                            </a>

                            <form id="delete-kta-form-${cell.getData().id}" action="${cell.getData().urls.delete_url}" method="POST">
                                <input type="hidden" name="_token" value="${CSRF_TOKEN}">
                                <input type="hidden" name="_method" value="DELETE">
                            </form>

                        </div>`
                        } else {
                            return `<div class="flex items-center lg:justify-center">

                            <a href="javascript:;" class="flex items-center mr-3 text-blue-700 detail-kta" data-href="${cell.getData().urls.data_url}">
                                <i data-lucide="list" class="w-4 h-4 mr-1"></i> Detail
                            </a>

                            <a href="javascript:;" class="flex items-center mr-3 text-yellow-600 btn-kta-edit" data-url="${cell.getData().urls.detail_url}" data-form-url="${cell.getData().urls.update_url}">
                                <i data-lucide="pencil" class="w-4 h-4 mr-1"></i> Edit
                            </a>

                        </div>`
                        }
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
            let name = $("#tabulator-html-filter-name").val();
            let nik = $("#tabulator-html-filter-nik").val();
            tabulator.setFilter([
                {field:'value', type:'like', value:value},
                {field:'name', type:'like', value:name},
                {field:'nik', type:'like', value:nik},
            ]);
        }

        $("#tabulator-html-filter-value").on('keyup', helper.delayWithClear(function(e){
            e.preventDefault();
            filterHTMLForm();
        }, 700));

        $("#tabulator-html-filter-name").on('keyup', helper.delayWithClear(function(e){
            e.preventDefault();
            filterHTMLForm();
        }, 700));

        $("#tabulator-html-filter-nik").on('keyup', helper.delayWithClear(function(e){
            e.preventDefault();
            filterHTMLForm();
        }, 700));

        $("#tabulator-html-filter-reset").on("click", function (e) {
            e.preventDefault();
            $("#tabulator-html-filter-value").val("");
            $("#tabulator-html-filter-name").val("");
            $("#tabulator-html-filter-nik").val("");
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
