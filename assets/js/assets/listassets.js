masterassets();

$('#modal_assets_add').on('shown.bs.modal', function () {
    // Reset semua input, textarea, select, dan file input
    $(this).find('input[type="text"], input[type="number"], input[type="file"], textarea').val('');
    $(this).find('select').prop('selectedIndex', 0).trigger('change'); // untuk reset select
    $(this).find('input[type="checkbox"], input[type="radio"]').prop('checked', false); // reset checkbox & radio

    // Optional: reset form validation feedback
    $(this).find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
});

function masterassets() {
    $.ajax({
        url: url + "index.php/assets/listassets/masterassets",
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatamasterassets_1").html("");
            $("#resultdatamasterassets_2").html("");
            $("#resultdatamasterassets_3").html("");
            $("#resultdatamasterassets_4").html("");
        },
        success: function (data) {
            let tableAlkes       = "";
            let tableBangunan    = "";
            let tableNonAlkes    = "";
            let tableRumahTangga = "";

            if (data.responCode === "00") {
                let result = data.responResult;

                for (let i in result) {
                    let row = "<tr>";
                    row += "<td class='ps-4'><div>" + (result[i].no_assets || "") + "</div><div>" + (result[i].no_laporan_penilaian_assets || "") + "</div></td>";
                    row += "<td><div>" + result[i].name + "</div><div class='fst-italic fs-9'>" + (result[i].spesifikasi || "") + "</div></td>";
                    if (result[i].jenis_id != "2") {
                        row += "<td>" + (result[i].rincianasset || "") + "</td>";
                    }
                    row += "<td class='text-end'>" + (result[i].volume ? todesimal(result[i].volume) : "") + "</td>";
                    row += "<td class='text-center'>" + (result[i].tahun_pembuatan || "") + "</td>";
                    row += "<td class='text-end'><span title='Nilai Perolehan'>" + (result[i].nilai_perolehan ? todesimal(result[i].nilai_perolehan) : "") + "</span></td>";
                    row += "<td class='text-end'><span title='Bunga Pinjaman'>" + (result[i].nilai_bunga_pinjaman ? todesimal(result[i].nilai_bunga_pinjaman) + " / " + (result[i].waktu_bunga || "") + " Tahun" : "") + "</span></td>";
                    row += "<td class='text-end'><span title='Biaya Pemeliharaan'>" + (result[i].nilai_pemeliharaan ? todesimal(result[i].nilai_pemeliharaan) + " / Bulan" : "") + "</span></td>";

                    // Tampilkan kolom harga per m² hanya jika jenis_id bukan 1 (bukan alkes)
                    if (result[i].jenis_id === "2") {
                        row += "<td class='text-end'>" + (result[i].nilaibangunanpermeter ? todesimal(result[i].nilaibangunanpermeter) : "0") + "</td>";
                    }

                    row += "<td class='text-end'>" + (result[i].waktu_depresiasi ? result[i].waktu_depresiasi + " Tahun" : "") + "</td>";
                    row += "<td class='text-end'>" + (result[i].estimasi_penggunaan_day ? result[i].estimasi_penggunaan_day + " / Hari" : "") + "</td>";
                    row += "<td class='text-end'><span title='Cost Per Pasien'>" + (result[i].cost ? todesimal(result[i].cost) : "") + "</span></td>";
                    row += "<td><div>" + (result[i].dibuatoleh || "") + "<div>" + result[i].tgldibuat + "</div></td>";
                    
                    row += "<td class='text-end pe-4'>";
                    row += "<button type='button' class='btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px' data-kt-table-widget-4='expand_row'>";
                    row += "<i class='bi bi-chevron-double-up fs-4 m-0 toggle-off'></i>";
                    row += "<i class='bi bi-chevron-double-down fs-4 m-0 toggle-on'></i>";
                    row += "</button>";
                    row += "</td>";
                    
                    row += "</tr>";

                    // Buat baris detail (expandable)
                    row += "<tr class='d-none'>";
                    row += "<td colspan='13'>";
                        row +="<div class='row'>";
                            row +="<div class='col-xl-12'>";
                                row +="<table class='table align-middle table-row-dashed fs-8 gy-2'>";

                                    if(result[i].jenis_id==="2"){
                                        row +="<thead>";
                                            row +="<tr class='fw-bolder bg-info align-middle text-white'>";
                                                row +="<th class='ps-4 rounded-start rounded-end' colspan='9'>Rincian Asset @ "+result[i].name+"</th>";
                                            row +="</tr>";
                                            row +="<tr class='fw-bolder bg-info align-middle text-white'>";
                                                row +="<th class='ps-4 rounded-start'>No Assets</th>";
                                                row +="<th>Nama Asset</th>";
                                                row +="<th>Kategori</th>";
                                                row +="<th class='text-end'>Qty</th>";
                                                row +="<th class='text-center'>Tahun Perolehan</th>";
                                                row +="<th class='text-end'>Nilai Asset</th>";
                                                row +="<th class='text-end'>Bunga Pinjaman</th>";
                                                row +="<th class='text-end'>Pemeliharaan</th>";
                                                row +="<th class='text-end rounded-end pe-4'>Depresiasi</th>";
                                            row +="</tr>";
                                        row +="</thead>";
                                    }else{
                                        row +="<thead class='text-center'>";
                                            row +="<tr class='fw-bolder align-middle text-white'>";
                                                row +="<th class='bg-danger' colspan='4'>Depresiasi</th>";
                                                row +="<th class='bg-success'colspan='4'>Pinjaman</th>";
                                                row +="<th class='bg-primary' colspan='4'>Pemeliharaan</th>";
                                            row +="</tr>";
                                            row +="<tr class='fw-bolder align-middle text-white'>";
                                                row +="<th class='bg-danger'>Tahunan</th>";
                                                row +="<th class='bg-danger'>Bulanan</th>";
                                                row +="<th class='bg-danger'>Harian</th>";
                                                row +="<th class='bg-danger'>Per Pasien</th>";
                                                row +="<th class='bg-success'>Tahunan</th>";
                                                row +="<th class='bg-success'>Bulanan</th>";
                                                row +="<th class='bg-success'>Harian</th>";
                                                row +="<th class='bg-success'>Per Pasien</th>";
                                                row +="<th class='bg-primary'>Tahunan</th>";
                                                row +="<th class='bg-primary'>Bulanan</th>";
                                                row +="<th class='bg-primary'>Harian</th>";
                                                row +="<th class='bg-primary'>Per Pasien</th>";
                                            row +="</tr>";
                                        row +="</thead>";
                                    }
                                    

                                    // Parsing rincianasset dan isi tbody
                                    let rincianRows = "";
                                    if (result[i].jenis_id === "2" && result[i].rincianasset !=null) {
                                        let rincianArray = result[i].rincianasset.split(";");
                                        rincianArray.forEach(function(item) {
                                            let parts = item.split(":");

                                            if(parts.length === 11){
                                                let trans_id          = parts[0];
                                                let no_assets         = parts[1];
                                                let name              = parts[2];
                                                let volume            = parts[3];
                                                let tahun             = parts[4];
                                                let nilaiasset        = parts[5];
                                                let nilaibunga        = parts[6];
                                                let nilaipemeliharaan = parts[7];
                                                let depreasi          = parts[8];
                                                let kategori          = parts[9];
                                                let color             = parts[10];

                                                rincianRows += "<tr>";
                                                rincianRows += "<td class='ps-4'>" + no_assets + "</td>";
                                                rincianRows += "<td>" + name + "</td>";
                                                rincianRows += "<td><span class='badge badge-light-"+color+"'>" + kategori + "</span></td>";
                                                rincianRows += "<td class='text-end'>"+volume+"</td>";
                                                rincianRows += "<td class='text-center'>"+tahun+"</td>";
                                                rincianRows += "<td class='text-end'>"+todesimal(nilaiasset)+"</td>";
                                                rincianRows += "<td class='text-end'>"+todesimal(nilaibunga)+"</td>";
                                                rincianRows += "<td class='text-end'>"+todesimal(nilaipemeliharaan)+"</td>";
                                                rincianRows += "<td class='text-end pe-4'>"+depreasi+" Tahun</td>";
                                                rincianRows += "</tr>";
                                            }
                                        });
                                    }else{
                                        if (result[i].jenis_id === "1" || result[i].jenis_id === "3" || result[i].jenis_id === "4"){
                                            rincianRows += "<tr>";

                                            rincianRows += "<td class='text-end'>" + todesimal(result[i].perolehantahunan) + "</td>";
                                            rincianRows += "<td class='text-end'>" + todesimal(result[i].perolehanbulanan) + "</td>";
                                            rincianRows += "<td class='text-end'>" + todesimal(result[i].perolehanharian) + "</td>";
                                            rincianRows += "<td class='text-end'>" + todesimal(result[i].perolehanpasien) + "</td>";

                                            rincianRows += "<td class='text-end'>" + todesimal(result[i].pinjamantahunan) + "</td>";
                                            rincianRows += "<td class='text-end'>" + todesimal(result[i].pinjamanbulanan) + "</td>";
                                            rincianRows += "<td class='text-end'>" + todesimal(result[i].pinjamanharian) + "</td>";
                                            rincianRows += "<td class='text-end'>" + todesimal(result[i].pinjamanpasien) + "</td>";

                                            rincianRows += "<td class='text-end'>" + todesimal(result[i].pemeliharaantahunan) + "</td>";
                                            rincianRows += "<td class='text-end'>" + todesimal(result[i].pemeliharaanbulanan) + "</td>";
                                            rincianRows += "<td class='text-end'>" + todesimal(result[i].pemeliharaanharian) + "</td>";
                                            rincianRows += "<td class='text-end'>" + todesimal(result[i].pemeliharaanpasien) + "</td>";

                                            rincianRows += "</tr>";
                                        }
                                        
                                    }

                                    row += "<tbody class='text-gray-600 fw-bold'>" + rincianRows + "</tbody>";
                                    
                                row +="</table>";
                            row +="</div>";
                        row +="</div>";
                    row += "</td>";
                    row += "</tr>";

                    if (result[i].jenis_id === "1") {
                        tableAlkes += row;
                    } else {
                        if (result[i].jenis_id === "2") {
                            tableBangunan += row;
                        }else{
                            if (result[i].jenis_id === "3") {
                                tableNonAlkes += row;
                            }else{
                                tableRumahTangga += row;
                            }
                        }
                    }
                }
            }

            $("#resultdatamasterassets_1").html(tableAlkes);
            $("#resultdatamasterassets_2").html(tableBangunan);
            $("#resultdatamasterassets_3").html(tableNonAlkes);
            $("#resultdatamasterassets_4").html(tableRumahTangga);

            document.querySelectorAll("[data-kt-table-widget-4='expand_row']").forEach(button => {
                button.addEventListener('click', function() {
                    const tr = this.closest('tr');
                    const nextTr = tr.nextElementSibling;
            
                    // Check if the next row is expanded
                    const isExpanded = !nextTr.classList.contains('d-none');
            
                    // Close any previously expanded rows if it's not the same row that is clicked
                    if (!isExpanded) {
                        document.querySelectorAll("[data-kt-table-widget-4='subtable_template']").forEach(openRow => {
                            openRow.classList.add('d-none');
                            openRow.removeAttribute('data-kt-table-widget-4');
            
                            const openButton = openRow.previousElementSibling.querySelector("[data-kt-table-widget-4='expand_row']");
                            if (openButton) {
                                openButton.classList.remove('active');
                                openButton.closest('tr').setAttribute('aria-expanded', 'false');
                            }
                        });
                    }
            
                    // Toggle the clicked row
                    if (!isExpanded || (isExpanded && tr.getAttribute('aria-expanded') === 'true')) {
                        if (isExpanded) {
                            nextTr.classList.add('d-none');
                            tr.setAttribute('aria-expanded', 'false');
                            nextTr.removeAttribute('data-kt-table-widget-4');
                            this.classList.remove('active');
                        } else {
                            nextTr.classList.remove('d-none');
                            tr.setAttribute('aria-expanded', 'true');
                            nextTr.setAttribute('data-kt-table-widget-4', 'subtable_template');
                            this.classList.add('active');
                        }
                    }
                });
            });

            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
            toastr.clear();
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html: "<b>" + error + "</b>",
                icon: "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling: false,
                timerProgressBar: true,
                timer: 5000,
                customClass: { confirmButton: "btn btn-danger" },
                showClass: { popup: "animate__animated animate__fadeInUp animate__faster" },
                hideClass: { popup: "animate__animated animate__fadeOutDown animate__faster" }
            });
        }
    });
    return false;
}


// function masterassets(){
//     $.ajax({
//         url       : url+"index.php/assets/listassets/masterassets",
//         method    : "POST",
//         dataType  : "JSON",
//         cache     : false,
//         beforeSend: function () {
//             toastr.clear();
//             toastr["info"]("Sending request...", "Please wait");
//             $("#resultdatamasterassets").html("");
//         },
//         success:function(data){
//             let tableresult;

//             if(data.responCode==="00"){
//                 let result        = data.responResult;
//                 for(var i in result){
//                     let total_nilai_asset = (
//                         (parseFloat(result[i].nilai_perolehan || 0)) +
//                         (parseFloat(result[i].nilai_bunga_pinjaman || 0)) +
//                         (parseFloat(result[i].nilai_pemeliharaan || 0)) -
//                         (parseFloat(result[i].nilai_residu || 0))
//                     );

//                     tableresult +="<tr>";
//                     tableresult +="<td class='ps-4'>"+(result[i].no_assets ? result[i].no_assets : "")+"</td>";
//                     tableresult +="<td><div>"+result[i].name+"</div><div class='fst-italic fs-9'>"+(result[i].spesifikasi ? result[i].spesifikasi : "")+"</div></td>";
//                     tableresult +="<td><div class='badge badge-light-info'>"+(result[i].kategori ? result[i].kategori : "")+"</div></td>";
//                     tableresult +="<td>"+(result[i].serial_number ? result[i].serial_number : "")+"</td>";
//                     tableresult +="<td class='text-center'>"+(result[i].tahun_pembuatan ? result[i].tahun_pembuatan : "")+"</td>";
//                     tableresult +="<td class='text-center'>"+(result[i].tglpembelian ? result[i].tglpembelian : "")+"</td>";
//                     tableresult +="<td>"+(result[i].nilai_ekonomis ? result[i].nilai_ekonomis+" Tahun" : "")+"</td>";
//                     tableresult +="<td>"+(result[i].masa_bunga ? result[i].masa_bunga+" Tahun" : "")+"</td>";
//                     tableresult +="<td class='text-end'>"+(result[i].nilai_perolehan ? todesimal(result[i].nilai_perolehan) : "")+"</td>";
//                     tableresult +="<td class='text-end'>"+(result[i].nilai_bunga_pinjaman ? todesimal(result[i].nilai_bunga_pinjaman) : "")+"</td>";
//                     tableresult +="<td class='text-end'>"+(result[i].nilai_pemeliharaan ? todesimal(result[i].nilai_pemeliharaan) : "")+"</td>";
//                     tableresult +="<td class='text-end'>"+(result[i].nilai_perijinan ? todesimal(result[i].nilai_perijinan) : "")+"</td>";
//                     tableresult +="<td class='text-end'>"+(result[i].nilai_konsultan ? todesimal(result[i].nilai_konsultan) : "")+"</td>";
//                     tableresult +="<td class='text-end'>"+(result[i].pajak ? todesimal(result[i].pajak) : "")+"</td>";
//                     tableresult +="<td class='text-end'>"+(result[i].nilai_residu ? todesimal(result[i].nilai_residu) : "")+"</td>";
//                     tableresult +="<td class='text-end'>"+todesimal(total_nilai_asset)+"</td>";
//                     tableresult +="<td class='text-center'>"+(result[i].estimasi_penggunaan_day ? result[i].estimasi_penggunaan_day+" Pasien / Hari" : "")+"</td>";
//                     tableresult +="<td><div>"+(result[i].dibuatoleh ? result[i].dibuatoleh : "")+"<div>"+result[i].tgldibuat+"</div></td>";


//                     // tableresult +="<td class='text-end'>"+(result[i].depresiasi_tahun ? todesimal(result[i].depresiasi_tahun) : "")+"</td>";
//                     // tableresult +="<td class='text-end'>"+(result[i].depresiasi_bulan ? todesimal(result[i].depresiasi_bulan) : "")+"</td>";
//                     // tableresult +="<td class='text-end'>"+(result[i].depresiasi_hari ? todesimal(result[i].depresiasi_hari) : "")+"</td>";
//                     // tableresult +="<td class='text-end'>"+(result[i].depresiasi_pasien ? todesimal(result[i].depresiasi_pasien) : "")+"</td>";

//                     // tableresult +="<td class='text-end'>"+(result[i].pemeliharaan_tahun ? todesimal(result[i].pemeliharaan_tahun) : "")+"</td>";
//                     // tableresult +="<td class='text-end'>"+(result[i].pemeliharaan_bulan ? todesimal(result[i].pemeliharaan_bulan) : "")+"</td>";
//                     // tableresult +="<td class='text-end'>"+(result[i].pemeliharaan_hari ? todesimal(result[i].pemeliharaan_hari) : "")+"</td>";
//                     // tableresult +="<td class='text-end'>"+(result[i].pemeliharaan_pasien ? todesimal(result[i].pemeliharaan_pasien) : "")+"</td>";

//                     // tableresult +="<td class='text-end'>"+(result[i].bunga_tahun ? todesimal(result[i].bunga_tahun) : "0")+"</td>";
//                     // tableresult +="<td class='text-end'>"+(result[i].bunga_bulan ? todesimal(result[i].bunga_bulan) : "0")+"</td>";
//                     // tableresult +="<td class='text-end'>"+(result[i].bunga_hari ? todesimal(result[i].bunga_hari) : "0")+"</td>";
//                     // tableresult +="<td class='text-end'>"+(result[i].bunga_pasien ? todesimal(result[i].bunga_pasien) : "0")+"</td>";

//                     // tableresult += "<td class='text-end'>" + todesimal((parseFloat(result[i].depresiasi_pasien) || 0) + (parseFloat(result[i].pemeliharaan_pasien) || 0) + (parseFloat(result[i].bunga_pasien) || 0)) + "</td>";
//                     // tableresult +="<td class='text-end'>"+(result[i].depresiasi_saat_ini ? todesimal(result[i].depresiasi_saat_ini) : "")+"</td>";
//                     // tableresult += "<td class='text-end " + ((result[i].nilai_buku_sisa < 0) ? "table-success" : "") + "'>" + (result[i].nilai_buku_sisa != null ? todesimal(Math.abs(result[i].nilai_buku_sisa)) : "") + "</td>";

//                     // tableresult +="<td>"+(result[i].dibuatoleh ? result[i].dibuatoleh : "")+"</td>";
//                     tableresult +="</tr>";
//                 }
//             }


//             $("#resultdatamasterassets").html(tableresult);
//             toastr[data.responHead](data.responDesc, "INFORMATION");
//         },
//         complete: function () {
// 			toastr.clear();
// 		},
//         error: function(xhr, status, error) {
//             Swal.fire({
//                 title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
//                 html             : "<b>"+error+"</b>",
//                 icon             : "error",
//                 confirmButtonText: "Please Try Again",
//                 buttonsStyling   : false,
//                 timerProgressBar : true,
//                 timer            : 5000,
//                 customClass      : {confirmButton: "btn btn-danger"},
//                 showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
//                 hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
//             });
// 		}		
//     });
//     return false;
// };

var KTCreateApp = (function () {
    var modal, stepperElement, form, btnSubmit, btnNext, stepper;

    return {
        init: function () {
            stepperElement = document.querySelector("#kt_modal_create_app_stepper");
            if (!stepperElement) return;

            form      = document.querySelector("#forminsertassets");
            btnSubmit = stepperElement.querySelector('[data-kt-stepper-action="submit"]');
            btnNext   = stepperElement.querySelector('[data-kt-stepper-action="next"]');

            // Init Stepper
            stepper = new KTStepper(stepperElement);

            // Step changed
            stepper.on("kt.stepper.changed", function () {
                const current = stepper.getCurrentStepIndex();

                if (current === 5) {
                    btnSubmit.classList.remove("d-none");
                    btnSubmit.classList.add("d-inline-block");
                    btnNext.classList.add("d-none");
                } else {
                    btnSubmit.classList.add("d-none");
                    btnNext.classList.remove("d-none");
                }
            });

            // Next button
            btnNext.addEventListener("click", function (e) {
                e.preventDefault();
                stepper.goNext();
                KTUtil.scrollTop();
            });

            // Submit button with AJAX
            btnSubmit.addEventListener("click", function (e) {
                e.preventDefault();
                btnSubmit.setAttribute("data-kt-indicator", "on");
                btnSubmit.disabled = true;

                const formData = new FormData(form);

                $.ajax({
                    url: url + "index.php/assets/listassets/insertassets", // ganti sesuai controller kamu
                    method     : "POST",
                    dataType   : "JSON",
                    data       : formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        toastr.clear();
                        toastr["info"]("Sending request...", "Please wait");
                    },
                    success:function (data) {
                        btnSubmit.removeAttribute("data-kt-indicator");
                        btnSubmit.disabled = false;

                        if(data.responCode === "00"){
                            masterassets();
                            $('#modal_assets_add').modal('hide');
                            stepper.goTo(1);
                        }

                        toastr[data.responHead](data.responDesc, "INFORMATION");
                    },
                    complete: function () {
                        toastr.clear();
                    },
                    error: function (xhr, status, error) {
                        btnSubmit.removeAttribute("data-kt-indicator");
                        btnSubmit.disabled = false;

                        Swal.fire({
                            text: "Terjadi kesalahan sistem. Coba lagi nanti.",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    }
                });
            });

            // Previous button
            const btnPrev = stepperElement.querySelector('[data-kt-stepper-action="previous"]');
            btnPrev.addEventListener("click", function (e) {
                e.preventDefault();
                stepper.goPrevious();
                KTUtil.scrollTop();
            });
        }
    };
})();


KTUtil.onDOMContentLoaded(function () {
    KTCreateApp.init();
});


// $(document).on("submit", "#forminsertassets", function (e) {
// 	e.preventDefault();
// 	var form = $(this);
//     var url  = $(this).attr("action");

// 	$.ajax({
//         url       : url,
//         data      : form.serialize(),
//         method    : "POST",
//         dataType  : "JSON",
//         cache     : false,
//         beforeSend: function () {
//             toastr.clear();
//             toastr["info"]("Sending request...", "Please wait");
// 			$("#btn_assets_add").addClass("disabled");
//         },
// 		success: function (data) {
//             if(data.responCode == "00"){
//                 masterassets();
//                 $('#modal_assets_add').modal('hide');
// 			}

//             toastr.clear();
// 			toastr[data.responHead](data.responDesc, "INFORMATION");
// 		},
//         complete: function () {
//             toastr.clear();
//             $("#btn_assets_add").removeClass("disabled");
// 		},
//         error: function(xhr, status, error) {
//             Swal.fire({
//                 title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
//                 html             : "<b>"+error+"</b>",
//                 icon             : "error",
//                 confirmButtonText: "Please Try Again",
//                 buttonsStyling   : false,
//                 timerProgressBar : true,
//                 timer            : 5000,
//                 customClass      : {confirmButton: "btn btn-danger"},
//                 showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
//                 hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
//             });
// 		}		
// 	});
//     return false;
// });