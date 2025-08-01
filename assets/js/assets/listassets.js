let result = [];

masterassets();

$(document).on("change", "select[name='selectorganization']", function (e) {
    e.preventDefault();
    masterassets();
});

$('#modal_assets_add').on('shown.bs.modal', function () {
    $(this).find('input[type="text"], input[type="number"], input[type="file"], textarea').val('');
    $(this).find('select').prop('selectedIndex', 0).trigger('change');
    $(this).find('input[type="checkbox"], input[type="radio"]').prop('checked', false);
    $(this).find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');

    $.ajax({
		url    : url + "index.php/assets/listassets/masterlocation",
		method : "POST",
		cache  : false,
		success: function (data) {
			$("select[name='location_id']").html(data);
		}
	});
});

$('#modal_assets_edit').on('shown.bs.modal', function (event) {
    $(this).find('input[type="text"], input[type="number"], input[type="file"], textarea').val('');
    $(this).find('select').prop('selectedIndex', 0).trigger('change');
    $(this).find('input[type="checkbox"], input[type="radio"]').prop('checked', false);
    $(this).find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');

    var button                = $(event.relatedTarget);
    var datatransid           = button.attr("datatransid");
    var dataname              = button.attr("dataname");
    var datajenisid           = button.attr("datajenisid");
    var datatahunperolehan    = button.attr("datatahunperolehan");
    var datatanggalbeli       = button.attr("datatanggalbeli");
    var datavolume            = button.attr("datavolume");
    var datapenggunaan        = button.attr("datapenggunaan");
    var datanilaiasset        = button.attr("datanilaiasset");
    var datanilaipemeliharaan = button.attr("datanilaipemeliharaan");
    var datanilaibunga        = button.attr("datanilaibunga");
    var datawaktubunga        = button.attr("datawaktubunga");
    var datadepresiasi        = button.attr("datadepresiasi");
    var datanolaporanasset    = button.attr("datanolaporanasset");
    var datalokasi            = button.attr("datalokasi");
    var datavollistrik        = button.attr("datavollistrik");
    var dataoperasional       = button.attr("dataoperasional");
    var dataspesifikasi       = button.attr("dataspesifikasi");
    var datanoinventaris      = button.attr("datanoinventaris");
    var datastatusid          = button.attr("datastatusid");
    var dataserialnumber      = button.attr("dataserialnumber");
    var datasumberid          = button.attr("datasumberid");

    var dataair      = button.attr("dataair");
    var datalistrik  = button.attr("datalistrik");
    var datainternet = button.attr("datainternet");


    $("#modal_assets_edit_transid").val(datatransid);
    $("#modal_assets_edit_name").val(dataname);
    $("#modal_assets_edit_tahun").val(datatahunperolehan == null || datatahunperolehan === "null" ? "" : datatahunperolehan);
    $("#modal_assets_edit_tanggal").val(datatanggalbeli == null || datatanggalbeli === "null" ? "" : datatanggalbeli);
    $("#modal_assets_edit_volume").val(datavolume);
    $("#modal_assets_edit_penggunaan").val(datapenggunaan);
    $("#modal_assets_edit_nilaiasset").val(formatCurrency(datanilaiasset));
    $("#modal_assets_edit_nilaipemeliharaan").val(formatCurrency(datanilaipemeliharaan));
    $("#modal_assets_edit_nilaibunga").val(formatCurrency(datanilaibunga));
    $("#modal_assets_edit_waktubunga").val(datawaktubunga);
    $("#modal_assets_edit_depresiasi").val(datadepresiasi);
    $("#modal_assets_edit_laporanasset").val(datanolaporanasset);
    $("#modal_assets_edit_noinventaris").val(datanoinventaris);
    $("#modal_assets_edit_spesifikasi").val(dataspesifikasi == null || dataspesifikasi === "null" ? "" : dataspesifikasi);
    $("#modal_assets_edit_vollistrik").val(datavollistrik == null || datavollistrik === "null" ? "" : datavollistrik);
    $("#modal_assets_edit_sn").val(dataserialnumber == null || dataserialnumber === "null" ? "" : dataserialnumber);

    $("#modal_assets_edit_air").prop("checked", dataair === "Y");
    $("#modal_assets_edit_listrik").prop("checked", datalistrik === "Y");
    $("#modal_assets_edit_internet").prop("checked", datainternet === "Y");
    $("#modal_assets_edit_operasional").prop("checked", dataoperasional === "Y");


    $('input[name="categoryedit"][value="' + datajenisid + '"]').prop("checked", true);

    var $datastatusid = $('#modal_assets_edit_status').select2();
        $datastatusid.val(datastatusid).trigger('change');

    var $datasumberid = $('#modal_assets_edit_sumber').select2();
        $datasumberid.val(datasumberid).trigger('change');

    $.ajax({
		url    : url + "index.php/assets/listassets/masterlocation",
		method : "POST",
		cache  : false,
		success: function (data) {
			$("select[name='modal_assets_edit_location']").html(data);

            var $datalokasi = $('#modal_assets_edit_location').select2();
            $datalokasi.val(datalokasi).trigger('change');
		}
	});
});

flatpickr('[name="modal_assets_edit_tanggal"]', {
    enableTime: false,
    dateFormat: "d.m.Y",
    maxDate   : "today",
    onChange  : function(selectedDates, dateStr, instance) {
        instance.close();
    }
});

$(document).on("click", ".btn-view-rumus", function (e) {
    e.preventDefault();
    const index = $(this).data("index");
    if(typeof result[index] === "undefined"){
        console.error("Data tidak ditemukan untuk index:", index);
        toastr["error"]("Data rumus tidak ditemukan.");
        return;
    }

    const data      = result[index];
    generateRumusTable(data);
});

function masterassets() {
    var orgid = $("#selectorganization").val();
    $.ajax({
        url       : url + "index.php/assets/listassets/masterassets",
        data      : {orgid:orgid},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");

            $("#resultdatamasterassets_1").html("");
            $("#resultdatamasterassets_2").html("");
            $("#resultdatamasterassets_3").html("");
            $("#resultdatamasterassets_4").html("");
            $("#resultdatamasterassets_5").html("");
        },
        success: function (data) {
            let tableAlkes       = "";
            let tableBangunan    = "";
            let tableNonAlkes    = "";
            let tableRumahTangga = "";
            let tableSoftware    = "";

            if (data.responCode === "00") {
                    result    = data.responResult;
                let totalData = result.length;
                let dataValid = 0;
                generateRumusTable(result);

                for (let i in result) {
                    var getvariabel =  " datatransid='" + result[i].trans_id + "'"+
                                       " dataname='" + result[i].name + "'"+
                                       " datajenisid='" + result[i].jenis_id + "'"+
                                       " datatahunperolehan='" + result[i].tahun_perolehan + "'"+
                                       " datatanggalbeli='" + result[i].tglbeli + "'"+
                                       " dataserialnumber='" + result[i].serialnumber + "'"+
                                       " datavolume='" + (result[i].volume || "0") + "'"+
                                       " datapenggunaan='" + result[i].estimasi_penggunaan_day + "'"+
                                       " dataspesifikasi='" + result[i].spesifikasi + "'"+
                                       " datanilaiasset='" + result[i].nilai_perolehan + "'"+
                                       " datanilaipemeliharaan='" + result[i].nilai_pemeliharaan + "'"+
                                       " datanilaibunga='" + result[i].nilai_bunga_pinjaman + "'"+
                                       " datawaktubunga='" + result[i].waktu_bunga + "'"+
                                       " datadepresiasi='" + result[i].waktu_depresiasi + "'"+
                                       " datastatusid='" + result[i].status_id + "'"+
                                       " datasumberid='" + result[i].sumber_id + "'"+
                                       " dataair='" + result[i].air + "'"+
                                       " datalistrik='" + result[i].listrik + "'"+
                                       " datainternet='" + result[i].internet + "'"+
                                       " datavollistrik='" + result[i].vollistrik + "'"+
                                       " dataoperasional='" + result[i].operasional + "'"+
                                       " datanolaporanasset='" + (result[i].no_laporan_penilaian_assets || "") + "'"+
                                       " datanoinventaris='" + (result[i].noiventaris || "") + "'"+
                                       " datalokasi='" + result[i].location_id + "'";

                    let isValid =   result[i].costperpasien && result[i].costperpasien !== '0';
                    if (isValid) {
                        dataValid++;
                    }
                    
                    let row = "<tr>";
                        row += "<td class='ps-4'><div>" + (result[i].no_assets || "") + "</div><div>" + (result[i].noiventaris || "") + "</div><div>" + (result[i].no_laporan_penilaian_assets || "") + "</div></td>";
                        row += "<td><div>" + result[i].name + "</div><div class='fst-italic fs-9'>" + (result[i].spesifikasi || "") + "</div>" + (result[i].operasional === "Y" ? "<i class='bi-clock-history text-danger me-1'></i>" : "") + (result[i].air === "Y" ? "<i class='bi bi-droplet-fill text-primary me-1'></i>" : "") + (result[i].listrik === "Y" ? "<i class='bi bi-lightning-charge-fill text-warning me-1'></i>" : "") + (result[i].internet === "Y" ? "<i class='bi bi-wifi text-info'></i>" : "") + "</td>";
                        if (result[i].jenis_id != "2") {
                            row += "<td><div>"+(result[i].rincianasset || "")+"</div></td>";
                        }
                        row += "<td class='text-end'>" + (result[i].volume ? todesimal(result[i].volume) : "") + "</td>";
                        row += "<td class='text-center'><div>"+(result[i].tahun_perolehan || "")+"</div></td>";
                        row += "<td class='text-end'><span title='Nilai Perolehan'>" + (result[i].nilai_perolehan ? todesimal(result[i].nilai_perolehan) : "") + "</span></td>";
                        row += "<td class='text-end'><div><span title='Bunga Pinjaman'>" + (result[i].nilai_bunga_pinjaman ? todesimal(result[i].nilai_bunga_pinjaman)+"</span></div><div><span title='Bunga Pinjaman'>"+ (result[i].waktu_bunga || "") + " Tahun" : "") + "</span></div></td>";
                        row += "<td class='text-end'><span title='Biaya Pemeliharaan'>" + (result[i].nilai_pemeliharaan ? todesimal(result[i].nilai_pemeliharaan) : "") + "</span></td>";

                        // Tampilkan kolom harga per m² hanya jika jenis_id bukan 1 (bukan alkes)
                        if (result[i].jenis_id === "2") {
                            row += "<td class='text-end'>" + (result[i].nilaibangunanpermeter ? todesimal(result[i].nilaibangunanpermeter) : "0") + "</td>";
                        }

                        row += "<td class='text-end'>" + (result[i].waktu_depresiasi ? result[i].waktu_depresiasi : "") + "</td>";
                        row += "<td class='text-end'>" + (result[i].estimasi_penggunaan_day ? result[i].estimasi_penggunaan_day : "") + "</td>";
                        row += "<td class='text-end'><span title='Cost Per Pasien'>" + (result[i].costperpasien ? todesimal(result[i].costperpasien) : "0") + "</span></td>";
                        row += "<td><div class='badge badge-light-info badge-sm'>"+(result[i].sumber || "")+"</div></td>";
                        row += "<td><div class='badge badge-light-info badge-sm'>"+(result[i].statusassets || "")+"</div></td>";
                        row += "<td><div>" + (result[i].dibuatoleh || "") + "<div>" + (result[i].lastupdatedate || "" ) + "</div></td>";
                

                        row += "<td class='text-end pe-4'>";
                            row += "<div class='btn-group' role='group'>";
                                row += "<div class='btn-group' role='group'>";
                                    row += "<button id='btnGroupDropAction' type='button' class='btn btn-sm btn-light-primary dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                                    row += "<ul class='dropdown-menu' aria-labelledby='btnGroupDropAction'>";
                                        row += "<li><a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_assets_edit' " + getvariabel + "><i class='bi bi-pencil-square me-2 text-primary'></i>Edit</a></li>";
                                        row += "<li><a class='dropdown-item btn btn-sm text-danger'" + getvariabel + " onclick='hapusdata($(this));'><i class='bi bi-trash3 me-2 text-danger'></i>Delete</a></li>";
                                        row += "<li><a class='dropdown-item btn btn-sm text-info btn-view-rumus' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_rumus' data-index='"+i+"' ><i class='bi bi-eye me-2 text-info'></i>View Rumus</a></li>";
                                    row += "</ul>";
                                row += "</div>";
                                if (result[i].jenis_id === "2") {
                                    row += "<button type='button' class='btn btn-sm btn-light btn-icon toggle' data-kt-table-widget-4='expand_row'>";
                                        row += "<i class='bi bi-chevron-double-up fs-4 m-0 toggle-off'></i>";
                                        row += "<i class='bi bi-chevron-double-down fs-4 m-0 toggle-on'></i>";
                                    row += "</button>";
                                }
                            row += "</div>";
                        row += "</td>";
                    row += "</tr>";

                    if(result[i].jenis_id === "2" && result[i].rincianasset != null){
                        row += "<tr class='d-none'>";
                            row += "<td colspan='15'>";
                                row +="<div class='row'>";
                                    row +="<div class='col-xl-12'>";
                                        row +="<table class='table align-middle table-row-dashed fs-8 gy-2'>";
                                            row +="<thead>";
                                                row +="<tr class='fw-bolder bg-info align-middle text-white'>";
                                                    row +="<th class='ps-4 rounded-start rounded-end' colspan='10'>Rincian Asset @ "+result[i].name+"</th>";
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
                                                    row +="<th class='text-end'>Depresiasi</th>";
                                                    row +="<th class='text-end rounded-end pe-4'>Action</th>";
                                                row +="</tr>";
                                            row +="</thead>";
                                            
                                            let rincianRows = "";
                                            let rincianArray = result[i].rincianasset.split(";");
                                            rincianArray.forEach(function(item) {
                                                let parts = item.split(":");

                                                if(parts.length === 12){
                                                    let trans_id          = parts[0];
                                                    let no_assets         = parts[1];
                                                    let noiventaris       = parts[2];
                                                    let name              = parts[3];
                                                    let volume            = parts[4];
                                                    let tahun             = parts[5];
                                                    let nilaiasset        = parts[6];
                                                    let nilaibunga        = parts[7];
                                                    let nilaipemeliharaan = parts[8];
                                                    let depreasi          = parts[9];
                                                    let kategori          = parts[10];
                                                    let color             = parts[11];

                                                    let datarincian = 
                                                                        " datatransid='" + trans_id + "'" +
                                                                        " dataname='" + name + "'" +
                                                                        " datajenisid='1'" +
                                                                        " datatahunperolehan='" + tahun + "'" +
                                                                        " datavolume='" + volume + "'" +
                                                                        " datanilaiasset='" + nilaiasset + "'" +
                                                                        " datanilaibunga='" + nilaibunga + "'" +
                                                                        " datanilaipemeliharaan='" + nilaipemeliharaan + "'" +
                                                                        " datadepresiasi='" + depreasi + "'" +
                                                                        " datanoinventaris='" + noiventaris + "'" +
                                                                        " datalokasi='" + result[i].trans_id + "'";

                                                    rincianRows += "<tr>";
                                                        rincianRows += "<td class='ps-4'><div>"+no_assets+"</div><div>"+noiventaris+"</div></td>";
                                                        rincianRows += "<td>" + name + "</td>";
                                                        rincianRows += "<td><span class='badge badge-light-"+color+"'>" + kategori + "</span></td>";
                                                        rincianRows += "<td class='text-end'>"+volume+"</td>";
                                                        rincianRows += "<td class='text-center'>"+tahun+"</td>";
                                                        rincianRows += "<td class='text-end'>"+todesimal(nilaiasset)+"</td>";
                                                        rincianRows += "<td class='text-end'>"+todesimal(nilaibunga)+"</td>";
                                                        rincianRows += "<td class='text-end'>"+todesimal(nilaipemeliharaan)+"</td>";
                                                        rincianRows += "<td class='text-end'>"+depreasi+" Tahun</td>";
                                                        rincianRows += "<td class='text-end pe-4'><a class='btn btn-sm btn-light-info' href='#' data-bs-toggle='modal' data-bs-target='#modal_assets_edit' " + datarincian + "><i class='bi bi-pencil-square me-2'></i>Edit</a></td>";
                                                    rincianRows += "</tr>";
                                                }
                                            });
                                            row += "<tbody class='text-gray-600 fw-bold'>" + rincianRows + "</tbody>";
                                        row +="</table>";
                                    row +="</div>";
                                row +="</div>";
                            row += "</td>";
                        row += "</tr>";
                    }

                    if (result[i].jenis_id === "1") {
                        tableAlkes += row;
                    } else {
                        if (result[i].jenis_id === "2") {
                            tableBangunan += row;
                        }else{
                            if (result[i].jenis_id === "3") {
                                tableNonAlkes += row;
                            }else{
                                if (result[i].jenis_id === "4") {
                                    tableRumahTangga += row;
                                }else{
                                    tableSoftware += row;
                                }
                            }
                        }
                    }
                }

                let persenValid = Math.round((dataValid / totalData) * 100);
                console.log("Valid: " + dataValid + " dari total: " + totalData + " (" + persenValid + "%)");
                $("#progressbar").css("width", persenValid + "%").attr("aria-valuenow", persenValid).text(persenValid + "%");
            }else{
                $("#progressbar").css("width", "0%").attr("aria-valuenow", 0).text("0%");
            }

            $("#resultdatamasterassets_1").html(tableAlkes);
            $("#resultdatamasterassets_2").html(tableBangunan);
            $("#resultdatamasterassets_3").html(tableNonAlkes);
            $("#resultdatamasterassets_4").html(tableRumahTangga);
            $("#resultdatamasterassets_5").html(tableSoftware);

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

function generateRumusTable(resultItem) {
    // Clear isi sebelum render ulang
    $("#rumus").empty();
    $("#perhitungan").empty();

    const rumus = {
        perolehan: {
            tahunan: `\\( \\mathrm{round}\\left( \\frac{\\text{nilai aset}}{\\text{depresiasi}},\\ 0 \\right) = \\text{hasil} \\)`,
            bulanan: `\\( \\mathrm{round}\\left( \\frac{\\text{nilai aset}}{\\text{depresiasi} \\times \\text{12 bulan}},\\ 0 \\right) = \\text{hasil} \\)`,
            harian: `\\( \\mathrm{round}\\left( \\frac{\\text{bulanan}}{\\text{30 hari}},\\ 0 \\right) = \\text{hasil} \\)`,
            pasien: `\\( \\mathrm{round}\\left( \\frac{\\text{harian}}{\\text{estimasi penggunaan per hari}},\\ 0 \\right) = \\text{hasil} \\)`,
        },
        pinjaman: {
            tahunan: `\\( \\mathrm{round}\\left( \\frac{\\text{nilai bunga}}{\\text{jangka waktu}},\\ 0 \\right) = \\text{hasil} \\)`,
            bulanan: `\\( \\mathrm{round}\\left( \\frac{\\text{nilai bunga}}{\\text{jangka waktu} \\times \\text{12 bulan}},\\ 0 \\right) = \\text{hasil} \\)`,
            harian: `\\( \\mathrm{round}\\left( \\frac{\\text{bulanan}}{\\text{30 hari}},\\ 0 \\right) = \\text{hasil} \\)`,
            pasien: `\\( \\mathrm{round}\\left( \\frac{\\text{harian}}{\\text{estimasi penggunaan per hari}},\\ 0 \\right) = \\text{hasil} \\)`,
        },
        pemeliharaan: {
            tahunan: `\\( \\mathrm{round}\\left( \\frac{\\text{nilai pemeliharaan}}{\\text{depresiasi}},\\ 0 \\right) = \\text{hasil} \\)`,
            bulanan: `\\( \\mathrm{round}\\left( \\frac{\\text{nilai pemeliharaan}}{\\text{depresiasi} \\times \\text{12 bulan}},\\ 0 \\right) = \\text{hasil} \\)`,
            harian: `\\( \\mathrm{round}\\left( \\frac{\\text{bulanan}}{\\text{30 hari}},\\ 0 \\right) = \\text{hasil} \\)`,
            pasien: `\\( \\mathrm{round}\\left( \\frac{\\text{harian}}{\\text{estimasi penggunaan per hari}},\\ 0 \\right) = \\text{hasil} \\)`,
        },
    };

    const rumusTxt = {
        perolehan: {
            tahunan: `\\( \\mathrm{round}\\left( \\frac{${formatCurrency(resultItem.nilai_perolehan)}}{${resultItem.waktu_depresiasi} \\text{ Tahun}},\\ 0 \\right) = ${formatCurrency(resultItem.perolehantahunan)} \\)`,
            bulanan: `\\( \\mathrm{round}\\left( \\frac{${formatCurrency(resultItem.nilai_perolehan)}}{${resultItem.waktu_depresiasi} \\text{ Tahun} \\times 12 \\text{ bulan}},\\ 0 \\right) = ${formatCurrency(resultItem.perolehanbulanan)} \\)`,
            harian: `\\( \\mathrm{round}\\left( \\frac{${formatCurrency(resultItem.perolehanbulanan)}}{30 \\text{ hari}},\\ 0 \\right) = ${formatCurrency(resultItem.perolehanharian)} \\)`,
            pasien: `\\( \\mathrm{round}\\left( \\frac{${formatCurrency(resultItem.perolehanharian)}}{${resultItem.estimasi_penggunaan_day} \\text{ pasien/hari}},\\ 0 \\right) = ${formatCurrency(resultItem.perolehanpasien)} \\)`,
        },
        pinjaman: {
            tahunan: `\\( \\mathrm{round}\\left( \\frac{${formatCurrency(resultItem.nilai_bunga_pinjaman)}}{${resultItem.waktu_bunga} \\text{ Tahun}},\\ 0 \\right) = ${formatCurrency(resultItem.pinjamantahunan)} \\)`,
            bulanan: `\\( \\mathrm{round}\\left( \\frac{${formatCurrency(resultItem.nilai_bunga_pinjaman)}}{${resultItem.waktu_bunga} \\text{ Tahun} \\times 12 \\text{ bulan}},\\ 0 \\right) = ${formatCurrency(resultItem.pinjamanbulanan)} \\)`,
            harian: `\\( \\mathrm{round}\\left( \\frac{${formatCurrency(resultItem.pinjamanbulanan)}}{30 \\text{ hari}},\\ 0 \\right) = ${formatCurrency(resultItem.pinjamanharian)} \\)`,
            pasien: `\\( \\mathrm{round}\\left( \\frac{${formatCurrency(resultItem.pinjamanharian)}}{${resultItem.estimasi_penggunaan_day} \\text{ pasien/hari}},\\ 0 \\right) = ${formatCurrency(resultItem.pinjamanpasien)} \\)`,
        },
        pemeliharaan: {
            tahunan: `\\( \\mathrm{round}\\left( \\frac{${formatCurrency(resultItem.nilai_pemeliharaan)}}{${resultItem.waktu_depresiasi} \\text{ Tahun}},\\ 0 \\right) = ${formatCurrency(resultItem.pemeliharaantahunan)} \\)`,
            bulanan: `\\( \\mathrm{round}\\left( \\frac{${formatCurrency(resultItem.nilai_pemeliharaan)}}{${resultItem.waktu_depresiasi} \\text{ Tahun} \\times 12 \\text{ bulan}},\\ 0 \\right) = ${formatCurrency(resultItem.pemeliharaanbulanan)} \\)`,
            harian: `\\( \\mathrm{round}\\left( \\frac{${formatCurrency(resultItem.pemeliharaanbulanan)}}{30 \\text{ hari}},\\ 0 \\right) = ${formatCurrency(resultItem.pemeliharaanharian)} \\)`,
            pasien: `\\( \\mathrm{round}\\left( \\frac{${formatCurrency(resultItem.pemeliharaanharian)}}{${resultItem.estimasi_penggunaan_day} \\text{ pasien/hari}},\\ 0 \\right) = ${formatCurrency(resultItem.pemeliharaanpasien)} \\)`,
        },
    };

    const kategori = ["tahunan", "bulanan", "harian", "pasien"];
    let row = `<table class='table align-middle table-row-dashed fs-8 gy-2'>
        <thead>
            <tr class='fw-bolder align-middle text-white text-center'>
                <th class='bg-dark' colspan='4'>Rumus</th>
            </tr>
            <tr class='fw-bolder align-middle text-white'>
                <th class='bg-dark ps-4' style='width:20%'>Jenis</th>
                <th class='bg-dark' style='width:20%'>Depresiasi</th>
                <th class='bg-dark' style='width:20%'>Pinjaman</th>
                <th class='bg-dark' style='width:20%'>Pemeliharaan</th>
            </tr>
        </thead>
        <tbody class='text-gray-600 fw-bold'>`;

    kategori.forEach(k => {
        row += `<tr>
                    <td class='ps-4' rowspan='2'>${k.charAt(0).toUpperCase() + k.slice(1)}</td>
                    <td class='text-start ps-4'>${rumus.perolehan[k]}</td>
                    <td class='text-start ps-4'>${rumus.pinjaman[k]}</td>
                    <td class='text-start ps-4'>${rumus.pemeliharaan[k]}</td>
                </tr>
                <tr>
                    <td class='text-start ps-4'>${rumusTxt.perolehan[k]}</td>
                    <td class='text-start ps-4'>${rumusTxt.pinjaman[k]}</td>
                    <td class='text-start ps-4'>${rumusTxt.pemeliharaan[k]}</td>
                </tr>`;
    });

    row += `</tbody></table>`;
    $("#rumus").html(row);

    let perhitungan = "";
    perhitungan += `<table class='table align-middle table-row-dashed fs-8 gy-2'>`;

    // Logic header tabel dan isi
    if(resultItem.jenis_id === "2") {
        perhitungan += `
        <thead>
            <tr class='fw-bolder bg-info text-white'>
                <th class='ps-4 rounded-start rounded-end' colspan='9'>Rincian Asset @ ${resultItem.name}</th>
            </tr>
            <tr class='fw-bolder bg-info text-white'>
                <th class='ps-4'>No Assets</th>
                <th>Nama Asset</th>
                <th>Kategori</th>
                <th class='text-end'>Qty</th>
                <th class='text-center'>Tahun Perolehan</th>
                <th class='text-end'>Nilai Asset</th>
                <th class='text-end'>Bunga Pinjaman</th>
                <th class='text-end'>Pemeliharaan</th>
                <th class='text-end pe-4'>Depresiasi</th>
            </tr>
        </thead>`;
    } else {
        perhitungan += `
        <thead class='text-center'>
            <tr class='fw-bolder text-white'>
                <th class='bg-danger' colspan='4'>Depresiasi</th>
                <th class='bg-success' colspan='4'>Pinjaman</th>
                <th class='bg-primary' colspan='4'>Pemeliharaan</th>
                <th class='bg-info' rowspan='2'>Cost Per Pasien</th>
            </tr>
            <tr class='fw-bolder text-white'>
                <th class='bg-danger'>Tahunan</th>
                <th class='bg-danger'>Bulanan</th>
                <th class='bg-danger'>Harian</th>
                <th class='bg-danger'>Per Pasien</th>
                <th class='bg-success'>Tahunan</th>
                <th class='bg-success'>Bulanan</th>
                <th class='bg-success'>Harian</th>
                <th class='bg-success'>Per Pasien</th>
                <th class='bg-primary'>Tahunan</th>
                <th class='bg-primary'>Bulanan</th>
                <th class='bg-primary'>Harian</th>
                <th class='bg-primary'>Per Pasien</th>
            </tr>
        </thead>`;
    }

    // Isi body tabel
    let rincianRows = "";
    if (resultItem.jenis_id === "2" && resultItem.rincianasset) {
        let rincianArray = resultItem.rincianasset.split(";");
        rincianArray.forEach(function(item) {
            let parts = item.split(":");
            if (parts.length === 11) {
                rincianRows += `
                <tr>
                    <td class='ps-4'>${parts[1]}</td>
                    <td>${parts[2]}</td>
                    <td><span class='badge badge-light-${parts[10]}'>${parts[9]}</span></td>
                    <td class='text-end'>${parts[3]}</td>
                    <td class='text-center'>${parts[4]}</td>
                    <td class='text-end'>${todesimal(parts[5])}</td>
                    <td class='text-end'>${todesimal(parts[6])}</td>
                    <td class='text-end'>${todesimal(parts[7])}</td>
                    <td class='text-end pe-4'>${parts[8]} Tahun</td>
                </tr>`;
            }
        });
    } else {
        if (["1", "3", "4"].includes(resultItem.jenis_id)) {
            rincianRows += `
            <tr>
                <td class='text-end'>${todesimal(resultItem.perolehantahunan)}</td>
                <td class='text-end'>${todesimal(resultItem.perolehanbulanan)}</td>
                <td class='text-end'>${todesimal(resultItem.perolehanharian)}</td>
                <td class='text-end'>${todesimal(resultItem.perolehanpasien)}</td>
                <td class='text-end'>${todesimal(resultItem.pinjamantahunan)}</td>
                <td class='text-end'>${todesimal(resultItem.pinjamanbulanan)}</td>
                <td class='text-end'>${todesimal(resultItem.pinjamanharian)}</td>
                <td class='text-end'>${todesimal(resultItem.pinjamanpasien)}</td>
                <td class='text-end'>${todesimal(resultItem.pemeliharaantahunan)}</td>
                <td class='text-end'>${todesimal(resultItem.pemeliharaanbulanan)}</td>
                <td class='text-end'>${todesimal(resultItem.pemeliharaanharian)}</td>
                <td class='text-end'>${todesimal(resultItem.pemeliharaanpasien)}</td>
                <td class='text-end pe-4'>${todesimal(
                    Math.round(
                        parseFloat(resultItem.perolehanpasien) +
                        parseFloat(resultItem.pinjamanpasien) +
                        parseFloat(resultItem.pemeliharaanpasien)
                    )
                )}</td>
            </tr>`;
        }
    }

    perhitungan += `<tbody class='text-gray-600 fw-bold'>${rincianRows}</tbody></table>`;
    $("#perhitungan").html(perhitungan);

    MathJax.typeset(); // Ensure LaTeX is rendered
}

var KTCreateApp = (function () {

    return {
        insertform: function () {
            const stepperElement = document.querySelector("#modal_assets_add_stepper");
            const form           = document.querySelector("#forminsertassets");
            const btnSubmit      = document.querySelector("#btn_submit_assets");
            const btnNext        = stepperElement.querySelector('[data-kt-stepper-action="next"]');
            const btnPrev        = stepperElement.querySelector('[data-kt-stepper-action="previous"]');
        
            // Init Stepper
            const stepper = new KTStepper(stepperElement);

            stepper.on("kt.stepper.next", function (e) {
                const current = stepper.getCurrentStepIndex();
            
                if(current === 1){
                    const nama        = $("#name").val().trim();
                    const kategori    = $("input[name='category']:checked").val();
                    const inputVolume = $("#volume");
                    const depresiasi  = $("#depresiasi");
            
                    if (nama === "" || typeof kategori === "undefined") {
                        Swal.fire({
                            title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                            html             : "<b>Silakan lengkapi Nama atau kategori asset.</b>",
                            icon             : "error",
                            confirmButtonText: "Please Try Again",
                            buttonsStyling   : false,
                            timerProgressBar : true,
                            timer            : 5000,
                            customClass      : { confirmButton: "btn btn-danger" },
                            showClass        : { popup: "animate__animated animate__fadeInUp animate__faster" },
                            hideClass        : { popup: "animate__animated animate__fadeOutDown animate__faster" }
                        });
                        return;
                    }else{
                        if(kategori === "2"){
                            inputVolume.prop("readonly", false);     // Aktifkan input
                            inputVolume.val("");                     // Kosongkan jika perlu

                            depresiasi.prop("readonly", true);      // Disable input
                            depresiasi.val("20"); 
                        } else {
                            inputVolume.prop("readonly", true);      // Disable input
                            inputVolume.val("1");                    // Isi dengan 1
                        }
                    }
                }

                // if(current === 2){
                //     const estimasi = $("#estimasi_penggunaan").val();

                //     if (estimasi === "" || estimasi === "0") {
                //         Swal.fire({
                //             title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                //             html             : "<b>Silakan lengkapi Estimasi Penggunaan Asset Dalam Sehari.</b>",
                //             icon             : "error",
                //             confirmButtonText: "Please Try Again",
                //             buttonsStyling   : false,
                //             timerProgressBar : true,
                //             timer            : 5000,
                //             customClass      : { confirmButton: "btn btn-danger" },
                //             showClass        : { popup: "animate__animated animate__fadeInUp animate__faster" },
                //             hideClass        : { popup: "animate__animated animate__fadeOutDown animate__faster" }
                //         });
                //         return;
                //     }
                // }

                // if(current === 3){

                //     const nilaiasset = $("#nilai_perolehan").val().trim();
                //     const depresiasi = $("#depresiasi").val().trim();
            
                //     if (nilaiasset === "" || nilaiasset === "Rp. 0" || depresiasi === "" || depresiasi === "0") {
                //         Swal.fire({
                //             title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                //             html             : "<b>Silakan lengkapi Nilai Perolehan dan Depresiasi.</b>",
                //             icon             : "error",
                //             confirmButtonText: "Please Try Again",
                //             buttonsStyling   : false,
                //             timerProgressBar : true,
                //             timer            : 5000,
                //             customClass      : { confirmButton: "btn btn-danger" },
                //             showClass        : { popup: "animate__animated animate__fadeInUp animate__faster" },
                //             hideClass        : { popup: "animate__animated animate__fadeOutDown animate__faster" }
                //         });
                //         return;
                //     }
                // }


                e.goNext();
            });



            // Saat step berubah
            
            stepper.on("kt.stepper.changed", function () {
                const current = stepper.getCurrentStepIndex();
                if (current === 6) {
                    btnSubmit.classList.remove("d-none");
                    btnSubmit.classList.add("d-inline-block");
                    btnNext?.classList.add("d-none");
                } else {
                    btnSubmit.classList.add("d-none");
                    btnNext?.classList.remove("d-none");
                }
            });

            // Tombol Next — jangan panggil goNext lagi!
            btnNext?.addEventListener("click", function (e) {
                e.preventDefault();
                // Tidak perlu stepper.goNext() lagi di sini
                KTUtil.scrollTop();
            });
        
            // Tombol Previous
            btnPrev?.addEventListener("click", function (e) {
                e.preventDefault();
                stepper.goPrevious();
                KTUtil.scrollTop();
            });

            // Tombol Submit dengan AJAX
            btnSubmit.addEventListener("click", function (e) {
                e.preventDefault();
                btnSubmit.setAttribute("data-kt-indicator", "on");
                btnSubmit.disabled = true;

                const formData = new FormData(form);

                $.ajax({
                    url: url + "index.php/assets/listassets/insertassets",
                    method: "POST",
                    dataType: "JSON",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        toastr.clear();
                        toastr["info"]("Sending request...", "Please wait");
                    },
                    success: function (data) {
                        btnSubmit.removeAttribute("data-kt-indicator");
                        btnSubmit.disabled = false;

                        if (data.responCode === "00") {
                            masterassets();
                            $('#modal_assets_add').modal('hide');
                            stepperInstance.goTo(1); // reset ke step awal
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
        },
        editform: function () {
            const stepperElement = document.querySelector("#modal_assets_edit_stepper");
            const form           = document.querySelector("#formeditassets");
            const btnSubmit      = document.querySelector("#btn_edit_assets");
            const btnNext        = stepperElement.querySelector('[data-kt-stepper-action="next"]');
            const btnPrev        = stepperElement.querySelector('[data-kt-stepper-action="previous"]');
        
            // Init Stepper
            const stepper = new KTStepper(stepperElement);
        
            // Validasi sebelum next step
            stepper.on("kt.stepper.next", function (e) {
                const current = stepper.getCurrentStepIndex();
            
                if(current === 1){
                    const nama        = $("#modal_assets_edit_name").val().trim();
                    const kategori    = $("input[name='categoryedit']:checked").val();
                    const inputVolume = $("#modal_assets_edit_volume");
                    const depresiasi  = $("#modal_assets_edit_depresiasi");
            
                    if (nama === "" || typeof kategori === "undefined") {
                        Swal.fire({
                            title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                            html             : "<b>Silakan lengkapi Nama atau kategori asset.</b>",
                            icon             : "error",
                            confirmButtonText: "Please Try Again",
                            buttonsStyling   : false,
                            timerProgressBar : true,
                            timer            : 5000,
                            customClass      : { confirmButton: "btn btn-danger" },
                            showClass        : { popup: "animate__animated animate__fadeInUp animate__faster" },
                            hideClass        : { popup: "animate__animated animate__fadeOutDown animate__faster" }
                        });
                        return;
                    }else{
                        if(kategori === "2"){
                            inputVolume.prop("readonly", false);     // Aktifkan input
                            inputVolume.val("");                     // Kosongkan jika perlu

                            depresiasi.prop("readonly", true);      // Disable input
                            depresiasi.val("20"); 
                        } else {
                            inputVolume.prop("readonly", true);      // Disable input
                            inputVolume.val("1");                    // Isi dengan 1
                        }
                    }
                }

                // if(current === 2){
                //     const estimasi = $("#modal_assets_edit_penggunaan").val().trim();
            
                //     if (estimasi === "" || estimasi === "0") {
                //         Swal.fire({
                //             title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                //             html             : "<b>Silakan lengkapi Estimasi Penggunaan Asset Dalam Sehari.</b>",
                //             icon             : "error",
                //             confirmButtonText: "Please Try Again",
                //             buttonsStyling   : false,
                //             timerProgressBar : true,
                //             timer            : 5000,
                //             customClass      : { confirmButton: "btn btn-danger" },
                //             showClass        : { popup: "animate__animated animate__fadeInUp animate__faster" },
                //             hideClass        : { popup: "animate__animated animate__fadeOutDown animate__faster" }
                //         });
                //         return;
                //     }
                // }

                // if(current === 4){

                //     const nilaiasset = $("#modal_assets_edit_nilaiasset").val().trim();
                //     const depresiasi = $("#modal_assets_edit_depresiasi").val().trim();
            
                //     if (nilaiasset === "" || nilaiasset === "Rp. 0" || depresiasi === "" || depresiasi === "0") {
                //         Swal.fire({
                //             title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                //             html             : "<b>Silakan lengkapi Nilai Perolehan dan Depresiasi.</b>",
                //             icon             : "error",
                //             confirmButtonText: "Please Try Again",
                //             buttonsStyling   : false,
                //             timerProgressBar : true,
                //             timer            : 5000,
                //             customClass      : { confirmButton: "btn btn-danger" },
                //             showClass        : { popup: "animate__animated animate__fadeInUp animate__faster" },
                //             hideClass        : { popup: "animate__animated animate__fadeOutDown animate__faster" }
                //         });
                //         return;
                //     }
                // }


                e.goNext();
            });
            
        
            // Update tampilan tombol saat step berubah
            stepper.on("kt.stepper.changed", function () {
                const current = stepper.getCurrentStepIndex();
        
                if (current === 6) {
                    btnSubmit.classList.remove("d-none");
                    btnSubmit.classList.add("d-inline-block");
                    btnNext?.classList.add("d-none");
                } else {
                    btnSubmit.classList.add("d-none");
                    btnNext?.classList.remove("d-none");
                }
            });
        
            // Tombol Next — jangan panggil goNext lagi!
            btnNext?.addEventListener("click", function (e) {
                e.preventDefault();
                // Tidak perlu stepper.goNext() lagi di sini
                KTUtil.scrollTop();
            });
        
            // Tombol Previous
            btnPrev?.addEventListener("click", function (e) {
                e.preventDefault();
                stepper.goPrevious();
                KTUtil.scrollTop();
            });
        
            // Tombol Submit
            btnSubmit.addEventListener("click", function (e) {
                e.preventDefault();
                btnSubmit.setAttribute("data-kt-indicator", "on");
                btnSubmit.disabled = true;
        
                const formData = new FormData(form);
        
                $.ajax({
                    url: url + "index.php/assets/listassets/editassets",
                    method: "POST",
                    dataType: "JSON",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        toastr.clear();
                        toastr["info"]("Sending request...", "Please wait");
                    },
                    success: function (data) {
                        btnSubmit.removeAttribute("data-kt-indicator");
                        btnSubmit.disabled = false;
        
                        if (data.responCode === "00") {
                            masterassets();
                            $('#modal_assets_edit').modal('hide');
                            stepper.goTo(1); // Reset ke awal
                        }
        
                        toastr[data.responHead](data.responDesc, "INFORMATION");
                    },
                    complete: function () {
                        toastr.clear();
                    },
                    error: function () {
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
        }
    };
})();

document.addEventListener("DOMContentLoaded", function () {
    KTCreateApp.insertform();
    KTCreateApp.editform();
});

function hapusdata(btn) {
    Swal.fire({
        title             : 'Are you sure?',
        text              : "You won't be able to revert this!",
        icon              : 'warning',
        showCancelButton  : true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor : '#d33',
        confirmButtonText : 'Yes, proceed!',
        cancelButtonText  : 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            var datatransid = btn.attr("datatransid");

            $.ajax({
                url       : url+"index.php/assets/listassets/hapusdata",
                data      : {datatransid:datatransid},
                method    : "POST",
                dataType  : "JSON",
                cache     : false,
                beforeSend: function () {
                    toastr.clear();
                    toastr["info"]("Sending request...", "Please wait");
                },
                success: function (data) {
                    toastr.clear();
                    toastr[data.responHead](data.responDesc, "INFORMATION");
                },
                complete: function () {
                    masterassets();
                },
                error: function (xhr, status, error) {
                    showAlert(
                        "I'm Sorry",
                        error,
                        "error",
                        "Please Try Again",
                        "btn btn-danger"
                    );
                }
            });
        }
    });
    return false;
};