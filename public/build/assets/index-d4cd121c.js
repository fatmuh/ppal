import{T as l}from"./tabulator_esm-e42c3e0e.js";(function(){const i=$("#kta-tabulator");if(i.length&&i.data("url")){let a=function(){let t=$("#tabulator-html-filter-value").val();e.setFilter([{field:"value",type:"like",value:t}])};const n=i.data("url");$('meta[name="csrf-token"]').attr("content");const e=new l("#kta-tabulator",{ajaxURL:n,ajaxContentType:"json",paginationMode:"remote",filterMode:"remote",sortMode:"remote",pagination:!0,paginationSize:10,paginationSizeSelector:[10,20,50,100],paginationCounter:"rows",layout:"fitColumns",responsiveLayout:"collapse",placeholder:"Data tidak ditemukan",selectable:!1,columns:[{title:"No",width:100,responsive:0,vertAlign:"middle",headerHozAlign:"center",hozAlign:"center",print:!1,download:!1,formatter:"rownum"},{title:"No. KTA",minWidth:100,responsive:0,field:"no_kta",vertAlign:"middle",headerHozAlign:"center",hozAlign:"center",print:!1,download:!1},{title:"Nama",minWidth:300,responsive:0,field:"full_name",vertAlign:"middle",headerHozAlign:"center",hozAlign:"center",print:!1,download:!1},{title:"Pangkat Terakhir",minWidth:150,responsive:0,field:"pangkat_terakhir",vertAlign:"middle",headerHozAlign:"center",hozAlign:"center",print:!1,download:!1},{title:"NIK",minWidth:150,responsive:0,field:"nik",vertAlign:"middle",headerHozAlign:"center",hozAlign:"center",print:!1,download:!1},{title:"Lihat Kartu",minWidth:150,responsive:0,field:"show_card",headerHozAlign:"center",vertAlign:"middle",print:!1,download:!1,formatter(t,r){return`<div class="flex items-center lg:justify-center">

                                    <a href="${t.getData().card.front}" target="_blank" class="rounded-md border border-primary px-3 py-1 text-primary mr-2">
                                    Depan
                                    </a><br>

                                    <a href="${t.getData().card.back}" target="_blank" class="rounded-md border border-primary px-3 py-1 text-primary">
                                    Belakang
                                    </a>

                                </div>`}},{title:"ACTIONS",minWidth:50,field:"actions",responsive:1,hozAlign:"center",headerHozAlign:"center",vertAlign:"middle",print:!1,download:!1,formatter(t,r){return`<div class="flex items-center lg:justify-center">

                            <a href="javascript:;" class="flex items-center mr-3 text-warning btn-kta-edit" data-url="${t.getData().urls.detail_url}" data-form-url="${t.getData().urls.update_url}">
                                <i data-lucide="pencil" class="w-4 h-4 mr-1"></i> Edit
                            </a>

                        </div>`}}]});e.on("renderComplete",()=>{createIcons({icons,attrs:{"stroke-width":1.5},nameAttr:"data-lucide"})}),window.addEventListener("resize",()=>{e.redraw(),createIcons({icons,"stroke-width":1.5,nameAttr:"data-lucide"})}),$("#tabulator-html-filter-value").on("keyup",helper.delayWithClear(function(t){t.preventDefault(),a()},700)),$("#tabulator-html-filter-reset").on("click",function(t){t.preventDefault(),$("#tabulator-html-filter-value").val(""),a()}),window.alertConfirm=function(t){Swal.fire({title:"Apakah Anda Yakin?",text:"Apakah anda ingin melanjutkan proses ini?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#E11D48",confirmButtonText:"Ya, lanjutkan!",cancelButtonText:"Tidak!"}).then(r=>{r.isConfirmed&&document.getElementById(t).submit()})}}})();(function(){$(document).on("click",".btn-kta-edit",function(n){n.preventDefault(),i("PATCH",$(this).data("form-url"));const e=$(this).data("url");axios.get(e).then(a=>{const t=a.data.data;$("input#no_kta").val(t.no_kta),$("input#full_name").val(t.full_name),$("input#ttl").val(t.ttl),$("#agama")[0].tomselect.setValue(t.agama),$("#gol_darah")[0].tomselect.setValue(t.gol_darah),$("input#pangkat_terakhir").val(t.pangkat_terakhir),$("input#nik").val(t.nik),$("input#tanda_jasa_tertinggi").val(t.tanda_jasa_tertinggi),$("input#tanggal_cetak").val(t.tanggal_cetak),t.foto&&$("#foto .form-upload img").attr("src",t.foto),t.ttd&&$("#ttd .form-upload img").attr("src",t.ttd),$("#istri_suami")[0].tomselect.setValue(t.istri_suami),$("input#nama_istri_suami").val(t.nama_istri_suami),$("input#nik_istri_suami").val(t.nik_istri_suami),$("input#wil_rayon").val(t.wil_rayon),$("input#alamat1").val(t.alamat1),$("input#alamat2").val(t.alamat2)}).catch(a=>{console.error(a),alert(a)}).finally(()=>{createIcons({icons,"stroke-width":1.5,nameAttr:"data-lucide"});const a=document.querySelector("#form-kta-modal");window.tailwind.Modal.getOrCreateInstance(a).toggle()})}),$(".btn-kta-add").on("click",function(n){n.preventDefault(),i("POST",$(this).data("form-url"));const e=document.querySelector("#form-kta-modal");window.tailwind.Modal.getOrCreateInstance(e).toggle()});function i(n="POST",e){const a=$("form#form-kta");a[0].reset(),a.find('input[name="_method"]').val(n),a.attr("action",e)}})();