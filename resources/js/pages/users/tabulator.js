import {TabulatorFull as Tabulator} from "tabulator-tables";

(function() {
    "use strict"

    const tableEl = $("#users-tabulator");

    if (tableEl.length && tableEl.data('url')) {
        const url = tableEl.data('url');
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        const tabulator = new Tabulator("#users-tabulator", {
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
                    title: "Nama",
                    minWidth: 300,
                    responsive: 0,
                    field: "name",
                    vertAlign: "middle",
                    headerHozAlign: "center",
                    hozAlign: "center",
                    print: false,
                    download: false,
                },
                {
                    title: "Email",
                    minWidth: 300,
                    responsive: 0,
                    field: "email",
                    vertAlign: "middle",
                    headerHozAlign: "center",
                    hozAlign: "center",
                    print: false,
                    download: false,
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

                            <a href="javascript:;" class="flex items-center mr-3 text-yellow-600 btn-users-edit" data-url="${cell.getData().urls.detail_url}" data-form-url="${cell.getData().urls.update_url}">
                                <i data-lucide="pencil" class="w-4 h-4 mr-1"></i> Edit
                            </a>

                            <a href="javascript:void(0);" class="flex items-center text-danger mr-3" onclick="alertConfirm('delete-users-form-${cell.getData().id}')">
                                <i data-lucide="trash" class="w-4 h-4 mr-1"></i> Delete
                            </a>

                            <form id="delete-users-form-${cell.getData().id}" action="${cell.getData().urls.delete_url}" method="POST">
                                <input type="hidden" name="_token" value="${CSRF_TOKEN}">
                                <input type="hidden" name="_method" value="DELETE">
                            </form>

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
            let email = $("#tabulator-html-filter-email").val();
            tabulator.setFilter([
                {field:'value', type:'like', value:value},
                {field:'email', type:'like', value:email},
            ]);
        }

        $("#tabulator-html-filter-value").on('keyup', helper.delayWithClear(function(e){
            e.preventDefault();
            filterHTMLForm();
        }, 700));

        $("#tabulator-html-filter-email").on('keyup', helper.delayWithClear(function(e){
            e.preventDefault();
            filterHTMLForm();
        }, 700));

        $("#tabulator-html-filter-reset").on("click", function (e) {
            e.preventDefault();
            $("#tabulator-html-filter-value").val("");
            $("#tabulator-html-filter-email").val("");
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
