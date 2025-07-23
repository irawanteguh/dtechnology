let result = [];

masterassets();

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

    $.ajax({
		url    : url + "index.php/assets/listassets/masterlocation",
		method : "POST",
		cache  : false,
		success: function (data) {
			$("select[name='modal_assets_edit_location']").html(data);
		}
	});

    var button                = $(event.relatedTarget);
    var datatransid           = button.attr("datatransid");
    var dataname              = button.attr("dataname");
    var datajenisid           = button.attr("datajenisid");
    var datatahunperolehan    = button.attr("datatahunperolehan");
    var datavolume            = button.attr("datavolume");
    var datapenggunaan        = button.attr("datapenggunaan");
    var datanilaiasset        = button.attr("datanilaiasset");
    var datanilaipemeliharaan = button.attr("datanilaipemeliharaan");
    var datanilaibunga        = button.attr("datanilaibunga");
    var datawaktubunga        = button.attr("datawaktubunga");
    var datadepresiasi        = button.attr("datadepresiasi");
    var datanolaporanasset    = button.attr("datanolaporanasset");
    var datalokasi            = button.attr("datalokasi");

    $("#modal_assets_edit_transid").val(datatransid);
    $("#modal_assets_edit_name").val(dataname);
    $("#modal_assets_edit_tahun").val(datatahunperolehan);
    $("#modal_assets_edit_volume").val(datavolume);
    $("#modal_assets_edit_penggunaan").val(datapenggunaan);
    $("#modal_assets_edit_nilaiasset").val(formatCurrency(datanilaiasset));
    $("#modal_assets_edit_nilaipemeliharaan").val(formatCurrency(datanilaipemeliharaan));
    $("#modal_assets_edit_nilaibunga").val(formatCurrency(datanilaibunga));
    $("#modal_assets_edit_waktubunga").val(datawaktubunga);
    $("#modal_assets_edit_depresiasi").val(datadepresiasi);
    $("#modal_assets_edit_laporanasset").val(datanolaporanasset);

    var $datalokasi = $('#modal_assets_edit_location').select2();
        $datalokasi.val(datalokasi).trigger('change');

    $('input[name="categoryedit"][value="' + datajenisid + '"]').prop("checked", true);
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
                result = data.responResult;
                generateRumusTable(result);

                for (let i in result) {
                    var getvariabel =  " datatransid='" + result[i].trans_id + "'"+
                                       " dataname='" + result[i].name + "'"+
                                       " datajenisid='" + result[i].jenis_id + "'"+
                                       " datatahunperolehan='" + result[i].tahun_perolehan + "'"+
                                       " datavolume='" + (result[i].volume || "0") + "'"+
                                       " datapenggunaan='" + result[i].estimasi_penggunaan_day + "'"+
                                       " datanilaiasset='" + result[i].nilai_perolehan + "'"+
                                       " datanilaipemeliharaan='" + result[i].nilai_pemeliharaan + "'"+
                                       " datanilaibunga='" + result[i].nilai_bunga_pinjaman + "'"+
                                       " datawaktubunga='" + result[i].waktu_bunga + "'"+
                                       " datadepresiasi='" + result[i].waktu_depresiasi + "'"+
                                       " datanolaporanasset='" + (result[i].no_laporan_penilaian_assets || "") + "'"+
                                       " datalokasi='" + result[i].location_id + "'";
                    
                    let row = "<tr>";
                        row += "<td class='ps-4'><div>" + (result[i].no_assets || "") + "</div><div>" + (result[i].no_laporan_penilaian_assets || "") + "</div></td>";
                        row += "<td><div>" + result[i].name + "</div><div class='fst-italic fs-9'>" + (result[i].spesifikasi || "") + "</div></td>";
                        if (result[i].jenis_id != "2") {
                            row += "<td>" + (result[i].rincianasset || "") + "</td>";
                        }
                        row += "<td class='text-end'>" + (result[i].volume ? todesimal(result[i].volume) : "") + "</td>";
                        row += "<td class='text-center'>" + (result[i].tahun_perolehan || "") + "</td>";
                        row += "<td class='text-end'><span title='Nilai Perolehan'>" + (result[i].nilai_perolehan ? todesimal(result[i].nilai_perolehan) : "") + "</span></td>";
                        row += "<td class='text-end'><div><span title='Bunga Pinjaman'>" + (result[i].nilai_bunga_pinjaman ? todesimal(result[i].nilai_bunga_pinjaman)+"</span></div><div><span title='Bunga Pinjaman'>"+ (result[i].waktu_bunga || "") + " Tahun" : "") + "</span></div></td>";
                        row += "<td class='text-end'><span title='Biaya Pemeliharaan'>" + (result[i].nilai_pemeliharaan ? todesimal(result[i].nilai_pemeliharaan) + " / Bulan" : "") + "</span></td>";

                        // Tampilkan kolom harga per m² hanya jika jenis_id bukan 1 (bukan alkes)
                        if (result[i].jenis_id === "2") {
                            row += "<td class='text-end'>" + (result[i].nilaibangunanpermeter ? todesimal(result[i].nilaibangunanpermeter) : "0") + "</td>";
                        }

                        row += "<td class='text-end'>" + (result[i].waktu_depresiasi ? result[i].waktu_depresiasi + " Tahun" : "") + "</td>";
                        row += "<td class='text-end'>" + (result[i].estimasi_penggunaan_day ? result[i].estimasi_penggunaan_day + " / Hari" : "") + "</td>";
                        row += "<td class='text-end'><span title='Cost Per Pasien'>" + todesimal(
                                                                                                    Math.round(
                                                                                                        parseFloat(result[i].perolehanpasien) +
                                                                                                        parseFloat(result[i].pinjamanpasien) +
                                                                                                        parseFloat(result[i].pemeliharaanpasien)
                                                                                                    )
                                                                                                ) + "</span></td>";
                        row += "<td><div>" + (result[i].dibuatoleh || "") + "<div>" + result[i].tgldibuat + "</div></td>";
                

                        row += "<td class='text-end pe-4'>";
                            row += "<div class='btn-group' role='group'>";
                                row += "<button id='btnGroupDropAction' type='button' class='btn btn-sm btn-light-primary dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                                row += "<ul class='dropdown-menu' aria-labelledby='btnGroupDropAction'>";
                                    row += "<li><a class='dropdown-item dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_assets_edit' " + getvariabel + "><i class='bi bi-pencil-square me-2 text-primary'></i>Edit</a></li>";
                                    row += "<li><a class='dropdown-item dropdown-item btn btn-sm text-info btn-view-rumus' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_rumus' data-index='"+i+"' ><i class='bi bi-eye me-2 text-info'></i>View Rumus</a></li>";
                                row += "</ul>";
                            row += "</div>";
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

            if (window.MathJax) {
                MathJax.typesetPromise();
            }

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
            pasien: `\\( \\mathrm{round}\\left( \\frac{${formatCurrency(resultItem.perolehanharian)}}{${resultItem.estimasi_penggunaan_day} \\text{ pasien/hari}},\\ 0 \\right) = ${rp(resultItem.perolehanpasien)} \\)`,
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
    var stepper, form, nextBtn, prevBtn, stepperInstance;
    return {
        insertform: function () {
            const stepperElement  = document.querySelector("#modal_assets_add_stepper");
            const form            = document.querySelector("#forminsertassets");
            const btnNext         = stepperElement.querySelector('[data-kt-stepper-action="next"]');
            const btnPrev         = stepperElement.querySelector('[data-kt-stepper-action="previous"]');
            const btnSubmit       = document.querySelector("#btn_submit_assets");

            // Inisialisasi stepper
            const stepperInstance = new KTStepper(stepperElement);

            // Saat step berubah
            stepperInstance.on("kt.stepper.changed", function () {
                const current = stepperInstance.getCurrentStepIndex(); // pakai stepperInstance

                if (current === 5) {
                    btnSubmit.classList.remove("d-none");
                    btnSubmit.classList.add("d-inline-block");
                    btnNext.classList.add("d-none");
                } else {
                    btnSubmit.classList.add("d-none");
                    btnNext.classList.remove("d-none");
                }
            });

            // Tombol Next
            btnNext.addEventListener("click", function (e) {
                e.preventDefault();
                stepperInstance.goNext(); // pakai stepperInstance
                KTUtil.scrollTop();
            });

            // Tombol Previous
            btnPrev.addEventListener("click", function (e) {
                e.preventDefault();
                stepperInstance.goPrevious();
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

            // Saat step berubah
            stepper.on("kt.stepper.changed", function () {
                const current = stepper.getCurrentStepIndex();

                if (current === 5) {
                    btnSubmit.classList.remove("d-none");
                    btnSubmit.classList.add("d-inline-block");
                    btnNext?.classList.add("d-none");
                } else {
                    btnSubmit.classList.add("d-none");
                    btnNext?.classList.remove("d-none");
                }
            });

            // Tombol Next
            btnNext?.addEventListener("click", function (e) {
                e.preventDefault();
                stepper.goNext();
                KTUtil.scrollTop();
            });

            // Tombol Previous
            btnPrev?.addEventListener("click", function (e) {
                e.preventDefault();
                stepper.goPrevious();
                KTUtil.scrollTop();
            });

            // Tombol Submit AJAX
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
                            stepper.goTo(1); // Reset ke step awal
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