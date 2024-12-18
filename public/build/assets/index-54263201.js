import{T as s}from"./tabulator_esm-e42c3e0e.js";(function(){const r=$("#kta-tabulator");if(r.length&&r.data("url")){let n=function(){let a=$("#tabulator-html-filter-value").val(),o=$("#tabulator-html-filter-name").val(),d=$("#tabulator-html-filter-nik").val();t.setFilter([{field:"value",type:"like",value:a},{field:"name",type:"like",value:o},{field:"nik",type:"like",value:d}])};const l=r.data("url"),i=r.data("role"),e=$('meta[name="csrf-token"]').attr("content"),t=new s("#kta-tabulator",{ajaxURL:l,ajaxContentType:"json",paginationMode:"remote",filterMode:"remote",sortMode:"remote",pagination:!0,paginationSize:10,paginationSizeSelector:[10,20,50,100,250],paginationCounter:"rows",layout:"fitColumns",responsiveLayout:"collapse",placeholder:"Data tidak ditemukan",selectable:!1,columns:[{title:"No",width:100,responsive:0,vertAlign:"middle",headerHozAlign:"center",hozAlign:"center",print:!1,download:!1,formatter:"rownum"},{title:"No. KTA",width:220,responsive:0,field:"no_kta",vertAlign:"middle",headerHozAlign:"center",hozAlign:"center",print:!1,download:!1},{title:"Nama",width:280,responsive:0,field:"full_name",vertAlign:"middle",headerHozAlign:"center",hozAlign:"center",print:!1,download:!1},{title:"NIK",minWidth:150,responsive:0,field:"nik",vertAlign:"middle",headerHozAlign:"center",hozAlign:"center",print:!1,download:!1},{title:"Lihat Kartu",width:200,responsive:0,field:"show_card",headerHozAlign:"center",vertAlign:"middle",print:!1,download:!1,formatter(a,o){return`<div class="flex items-center lg:justify-center">

                                    <a href="${a.getData().card.front}" target="_blank" class="rounded-md border border-primary px-3 py-1 text-primary mr-2">
                                    Depan
                                    </a><br>

                                    <a href="${a.getData().card.back}" target="_blank" class="rounded-md border border-primary px-3 py-1 text-primary">
                                    Belakang
                                    </a>

                                </div>`}},{title:"ACTIONS",minWidth:50,field:"actions",responsive:1,hozAlign:"center",headerHozAlign:"center",vertAlign:"middle",print:!1,download:!1,formatter(a,o){return i===1?`<div class="flex items-center lg:justify-center">

                            <a href="javascript:;" class="flex items-center mr-3 text-blue-700 detail-kta" data-href="${a.getData().urls.data_url}">
                                <i data-lucide="list" class="w-4 h-4 mr-1"></i> Detail
                            </a>

                            <a href="javascript:;" class="flex items-center mr-3 text-yellow-600 btn-kta-edit" data-url="${a.getData().urls.detail_url}" data-form-url="${a.getData().urls.update_url}">
                                <i data-lucide="pencil" class="w-4 h-4 mr-1"></i> Edit
                            </a>

                            <a href="javascript:void(0);" class="flex items-center text-danger mr-3" onclick="alertConfirm('delete-kta-form-${a.getData().id}')">
                                <i data-lucide="trash" class="w-4 h-4 mr-1"></i> Delete
                            </a>

                            <form id="delete-kta-form-${a.getData().id}" action="${a.getData().urls.delete_url}" method="POST">
                                <input type="hidden" name="_token" value="${e}">
                                <input type="hidden" name="_method" value="DELETE">
                            </form>

                        </div>`:`<div class="flex items-center lg:justify-center">

                            <a href="javascript:;" class="flex items-center mr-3 text-blue-700 detail-kta" data-href="${a.getData().urls.data_url}">
                                <i data-lucide="list" class="w-4 h-4 mr-1"></i> Detail
                            </a>

                            <a href="javascript:;" class="flex items-center mr-3 text-yellow-600 btn-kta-edit" data-url="${a.getData().urls.detail_url}" data-form-url="${a.getData().urls.update_url}">
                                <i data-lucide="pencil" class="w-4 h-4 mr-1"></i> Edit
                            </a>

                        </div>`}}]});t.on("renderComplete",()=>{createIcons({icons,attrs:{"stroke-width":1.5},nameAttr:"data-lucide"})}),window.addEventListener("resize",()=>{t.redraw(),createIcons({icons,"stroke-width":1.5,nameAttr:"data-lucide"})}),$("#tabulator-html-filter-value").on("keyup",helper.delayWithClear(function(a){a.preventDefault(),n()},700)),$("#tabulator-html-filter-name").on("keyup",helper.delayWithClear(function(a){a.preventDefault(),n()},700)),$("#tabulator-html-filter-nik").on("keyup",helper.delayWithClear(function(a){a.preventDefault(),n()},700)),$("#tabulator-html-filter-reset").on("click",function(a){a.preventDefault(),$("#tabulator-html-filter-value").val(""),$("#tabulator-html-filter-name").val(""),$("#tabulator-html-filter-nik").val(""),n()}),window.alertConfirm=function(a){Swal.fire({title:"Apakah Anda Yakin?",text:"Apakah anda ingin melanjutkan proses ini?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#E11D48",confirmButtonText:"Ya, lanjutkan!",cancelButtonText:"Tidak!"}).then(o=>{o.isConfirmed&&document.getElementById(a).submit()})}}})();(function(){$(document).on("click",".btn-kta-edit",function(l){l.preventDefault(),r("PATCH",$(this).data("form-url"));const i=$(this).data("url");axios.get(i).then(e=>{const t=e.data.data;$("input#no_kta").val(t.no_kta),$("input#full_name").val(t.full_name),$("input#ttl").val(t.ttl),$("input#agama").val(t.agama),$("#gol_darah")[0].tomselect.setValue(t.gol_darah),$("input#pangkat_terakhir").val(t.pangkat_terakhir),$("input#nik").val(t.nik),$("input#tanda_jasa_tertinggi").val(t.tanda_jasa_tertinggi),$("input#tanggal_cetak").val(t.tanggal_cetak),t.foto&&$("#foto .form-upload img").attr("src",t.foto),t.ttd&&$("#ttd .form-upload img").attr("src",t.ttd),$("#istri_suami")[0].tomselect.setValue(t.istri_suami),$("input#nama_istri_suami").val(t.nama_istri_suami),$("input#nik_istri_suami").val(t.nik_istri_suami),$("input#wil_rayon").val(t.wil_rayon),$("input#alamat1").val(t.alamat1),$("input#alamat2").val(t.alamat2)}).catch(e=>{console.error(e),alert(e)}).finally(()=>{createIcons({icons,"stroke-width":1.5,nameAttr:"data-lucide"});const e=document.querySelector("#form-kta-modal");window.tailwind.Modal.getOrCreateInstance(e).toggle()})}),$(".btn-kta-add").on("click",function(l){l.preventDefault(),r("POST",$(this).data("form-url"));const i=document.querySelector("#form-kta-modal");window.tailwind.Modal.getOrCreateInstance(i).toggle()}),$(document).on("click",".detail-kta",function(){const l=$(this).data("href"),i=document.querySelector("#kta-detail-modal"),e=tailwind.Modal.getOrCreateInstance(i);$("#detail-kta-header-title").text("Detail Data KTA"),$.ajax({url:l,type:"GET",datatype:"html"}).done(function(t){$("#kta-detail-modal .modal-body").empty().html(t),e.toggle()}).fail(function(t,n,a){alert("Request failed: "+n)})});function r(l="POST",i){const e=$("form#form-kta");e[0].reset(),e.find('input[name="_method"]').val(l),e.attr("action",i)}})();
