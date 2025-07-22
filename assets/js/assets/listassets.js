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

                        row += "<button type='button' class='btn btn-sm btn-light-primary' data-bs-toggle='modal' data-bs-target='#modal_assets_edit' "+getvariabel+">Edit</button>";

                        row += "<button type='button' class='btn btn-sm btn-light btn-icon toggle' data-kt-table-widget-4='expand_row'>";
                        row += "<i class='bi bi-chevron-double-up fs-4 m-0 toggle-off'></i>";
                        row += "<i class='bi bi-chevron-double-down fs-4 m-0 toggle-on'></i>";
                        row += "</button>";

                        row += "</div>";
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
                                                    row +="<th class='bg-info' rowspan='2'>Cost Per Pasien</th>";
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

                                                
                                                rincianRows += "<td class='text-end pe-4'>" + todesimal(
                                                                    Math.round(
                                                                        parseFloat(result[i].perolehanpasien) +
                                                                        parseFloat(result[i].pinjamanpasien) +
                                                                        parseFloat(result[i].pemeliharaanpasien)
                                                                    )
                                                                ) + "</td>";


                                                rincianRows += "</tr>";
                                            }
                                        }
                                        row += "<tbody class='text-gray-600 fw-bold'>" + rincianRows + "</tbody>";
                                    row +="</table>";
                                row +="</div>";

                                // 📌 A. Perolehan Aset
                                let rumusPerolehanTahunan = "\\( \\mathrm{round}\\left( \\frac{\\text{nilai aset}}{\\text{depresiasi}},\\ 0 \\right) = \\text{hasil} \\)";
                                let rumusPerolehanTahunanTxt = "\\( \\mathrm{round}\\left( \\frac{\\text{Rp. " + todesimal(result[i].nilai_perolehan) + "}}{\\text{" + result[i].waktu_depresiasi + " Tahun}},\\ 0 \\right) = \\text{Rp. " + todesimal(result[i].perolehantahunan) + "} \\)";

                                let rumusPerolehanBulanan = "\\( \\mathrm{round}\\left( \\frac{\\text{nilai aset}}{\\text{depresiasi} \\times \\text{12 bulan}},\\ 0 \\right) = \\text{hasil} \\)";
                                let rumusPerolehanBulananTxt = "\\( \\mathrm{round}\\left( \\frac{\\text{Rp. " + todesimal(result[i].nilai_perolehan) + "}}{\\text{" + result[i].waktu_depresiasi + " Tahun} \\times \\text{12 bulan}},\\ 0 \\right) = \\text{Rp. " + todesimal(result[i].perolehanbulanan) + "} \\)";

                                let rumusPerolehanHarian = "\\( \\mathrm{round}\\left( \\frac{\\text{bulanan}}{\\text{30 hari}},\\ 0 \\right) = \\text{hasil} \\)";
                                let rumusPerolehanHarianTxt = "\\( \\mathrm{round}\\left( \\frac{\\text{Rp. " + todesimal(result[i].perolehanbulanan) + "}}{\\text{30 hari}},\\ 0 \\right) = \\text{Rp. " + todesimal(result[i].perolehanharian) + "} \\)";

                                let rumusPerolehanPasien = "\\( \\mathrm{round}\\left( \\frac{\\text{harian}}{\\text{estimasi penggunaan per hari}},\\ 0 \\right) = \\text{hasil} \\)";
                                let rumusPerolehanPasienTxt = "\\( \\mathrm{round}\\left( \\frac{\\text{Rp. " + todesimal(result[i].perolehanharian) + "}}{\\text{" + result[i].estimasi_penggunaan_day + " pasien/hari}},\\ 0 \\right) = \\text{Rp. " + todesimal(result[i].perolehanpasien) + "} \\)";

                                // 📌 B. Bunga Pinjaman
                                let rumusPinjamanTahunan = "\\( \\mathrm{round}\\left( \\frac{\\text{nilai bunga}}{\\text{jangka waktu}},\\ 0 \\right) = \\text{hasil} \\)";
                                let rumusPinjamanTahunanTxt = "\\( \\mathrm{round}\\left( \\frac{\\text{Rp. " + todesimal(result[i].nilai_bunga_pinjaman) + "}}{\\text{" + result[i].waktu_bunga + " Tahun}},\\ 0 \\right) = \\text{Rp. " + todesimal(result[i].pinjamantahunan) + "} \\)";

                                let rumusPinjamanBulanan = "\\( \\mathrm{round}\\left( \\frac{\\text{nilai bunga}}{\\text{jangka waktu} \\times \\text{12 bulan}},\\ 0 \\right) = \\text{hasil} \\)";
                                let rumusPinjamanBulananTxt = "\\( \\mathrm{round}\\left( \\frac{\\text{Rp. " + todesimal(result[i].nilai_bunga_pinjaman) + "}}{\\text{" + result[i].waktu_bunga + " Tahun} \\times \\text{12 bulan}},\\ 0 \\right) = \\text{Rp. " + todesimal(result[i].pinjamanbulanan) + "} \\)";

                                let rumusPinjamanHarian = "\\( \\mathrm{round}\\left( \\frac{\\text{bulanan}}{\\text{30 hari}},\\ 0 \\right) = \\text{hasil} \\)";
                                let rumusPinjamanHarianTxt = "\\( \\mathrm{round}\\left( \\frac{\\text{Rp. " + todesimal(result[i].pinjamanbulanan) + "}}{\\text{30 hari}},\\ 0 \\right) = \\text{Rp. " + todesimal(result[i].pinjamanharian) + "} \\)";

                                let rumusPinjamanPasien = "\\( \\mathrm{round}\\left( \\frac{\\text{harian}}{\\text{estimasi penggunaan per hari}},\\ 0 \\right) = \\text{hasil} \\)";
                                let rumusPinjamanPasienTxt = "\\( \\mathrm{round}\\left( \\frac{\\text{Rp. " + todesimal(result[i].pinjamanharian) + "}}{\\text{" + result[i].estimasi_penggunaan_day + " pasien/hari}},\\ 0 \\right) = \\text{Rp. " + todesimal(result[i].pinjamanpasien) + "} \\)";

                                // 📌 C. Pemeliharaan
                                let rumusPemeliharaanTahunan = "\\( \\mathrm{round}\\left( \\frac{\\text{nilai pemeliharaan}}{\\text{depresiasi}},\\ 0 \\right) = \\text{hasil} \\)";
                                let rumusPemeliharaanTahunanTxt = "\\( \\mathrm{round}\\left( \\frac{\\text{Rp. " + todesimal(result[i].nilai_pemeliharaan) + "}}{\\text{" + result[i].waktu_depresiasi + " Tahun}},\\ 0 \\right) = \\text{Rp. " + todesimal(result[i].pemeliharaantahunan) + "} \\)";

                                let rumusPemeliharaanBulanan = "\\( \\mathrm{round}\\left( \\frac{\\text{nilai pemeliharaan}}{\\text{depresiasi} \\times \\text{12 bulan}},\\ 0 \\right) = \\text{hasil} \\)";
                                let rumusPemeliharaanBulananTxt = "\\( \\mathrm{round}\\left( \\frac{\\text{Rp. " + todesimal(result[i].nilai_pemeliharaan) + "}}{\\text{" + result[i].waktu_depresiasi + " Tahun} \\times \\text{12 bulan}},\\ 0 \\right) = \\text{Rp. " + todesimal(result[i].pemeliharaanbulanan) + "} \\)";

                                let rumusPemeliharaanHarian = "\\( \\mathrm{round}\\left( \\frac{\\text{bulanan}}{\\text{30 hari}},\\ 0 \\right) = \\text{hasil} \\)";
                                let rumusPemeliharaanHarianTxt = "\\( \\mathrm{round}\\left( \\frac{\\text{Rp. " + todesimal(result[i].pemeliharaanbulanan) + "}}{\\text{30 hari}},\\ 0 \\right) = \\text{Rp. " + todesimal(result[i].pemeliharaanharian) + "} \\)";

                                let rumusPemeliharaanPasien = "\\( \\mathrm{round}\\left( \\frac{\\text{harian}}{\\text{estimasi penggunaan per hari}},\\ 0 \\right) = \\text{hasil} \\)";
                                let rumusPemeliharaanPasienTxt = "\\( \\mathrm{round}\\left( \\frac{\\text{Rp. " + todesimal(result[i].pemeliharaanharian) + "}}{\\text{" + result[i].estimasi_penggunaan_day + " pasien/hari}},\\ 0 \\right) = \\text{Rp. " + todesimal(result[i].pemeliharaanpasien) + "} \\)";

                                row += "<div class='col-xl-12'>";
                                    row += "<table class='table align-middle table-row-dashed fs-8 gy-2'>";
                                        row += "<thead>";
                                            row += "<tr class='fw-bolder align-middle text-white text-center'>";
                                                row += "<th class='bg-dark' colspan='4'>Rumus</th>";
                                            row += "</tr>";
                                            row += "<tr class='fw-bolder align-middle text-white'>";
                                                row += "<th class='bg-dark ps-4' style='width:20%'>Rumus</th>";
                                                row += "<th class='bg-dark' style='width:20%'>Depresiasi</th>";
                                                row += "<th class='bg-dark' style='width:20%'>Pinjaman</th>";
                                                row += "<th class='bg-dark' style='width:20%'>Pemeliharaan</th>";
                                            row += "</tr>";
                                        row += "</thead>";
                                        row += "<tbody class='text-gray-600 fw-bold'>";
                                            //Tahunan
                                            row += "<tr class='fw-bolder align-middle'>";
                                                row += "<td class='ps-4' rowspan='2'>Tahunan</td>";
                                                row += "<td class='text-start ps-4'>"+rumusPerolehanTahunan+"</td>";
                                                row += "<td class='text-start ps-4'>"+rumusPinjamanTahunan+"</td>";
                                                row += "<td class='text-start ps-4'>"+rumusPemeliharaanTahunan+"</td>";
                                            row += "</tr>";
                                            row += "<tr class='fw-bolder align-middle'>";
                                                row += "<td class='text-start ps-4'>"+rumusPerolehanTahunanTxt+"</td>";
                                                row += "<td class='text-start ps-4'>"+rumusPinjamanTahunanTxt+"</td>";
                                                row += "<td class='text-start ps-4'>"+rumusPemeliharaanTahunanTxt+"</td>";
                                            row += "</tr>";

                                            //Bulanan
                                            row += "<tr class='fw-bolder align-middle'>";
                                                row += "<td class='ps-4' rowspan='2'>Bulanan</td>";
                                                row += "<td class='text-start ps-4'>"+rumusPerolehanBulanan+"</td>";
                                                row += "<td class='text-start ps-4'>"+rumusPinjamanBulanan+"</td>";
                                                row += "<td class='text-start ps-4'>"+rumusPemeliharaanBulanan+"</td>";
                                            row += "</tr>";
                                            row += "<tr class='fw-bolder align-middle'>";
                                                row += "<td class='text-start ps-4'>"+rumusPerolehanBulananTxt+"</td>";
                                                row += "<td class='text-start ps-4'>"+rumusPinjamanBulananTxt+"</td>";
                                                row += "<td class='text-start ps-4'>"+rumusPemeliharaanBulananTxt+"</td>";
                                            row += "</tr>";

                                            //Harian
                                            row += "<tr class='fw-bolder align-middle'>";
                                                row += "<td class='ps-4' rowspan='2'>Harian</td>";
                                                row += "<td class='text-start ps-4'>"+rumusPerolehanHarian+"</td>";
                                                row += "<td class='text-start ps-4'>"+rumusPinjamanHarian+"</td>";
                                                row += "<td class='text-start ps-4'>"+rumusPemeliharaanHarian+"</td>";
                                            row += "</tr>";
                                            row += "<tr class='fw-bolder align-middle'>";
                                                row += "<td class='text-start ps-4'>"+rumusPerolehanHarianTxt+"</td>";
                                                row += "<td class='text-start ps-4'>"+rumusPinjamanHarianTxt+"</td>";
                                                row += "<td class='text-start ps-4'>"+rumusPemeliharaanHarianTxt+"</td>";
                                            row += "</tr>";


                                            //Pasien
                                            row += "<tr class='fw-bolder align-middle'>";
                                                row += "<td class='ps-4' rowspan='2'>Per Pasien</td>";
                                                row += "<td class='text-start ps-4'>"+rumusPerolehanPasien+"</td>";
                                                row += "<td class='text-start ps-4'>"+rumusPinjamanPasien+"</td>";
                                                row += "<td class='text-start ps-4'>"+rumusPemeliharaanPasien+"</td>";
                                            row += "</tr>";
                                            row += "<tr class='fw-bolder align-middle'>";
                                                row += "<td class='text-start ps-4'>"+rumusPerolehanPasienTxt+"</td>";
                                                row += "<td class='text-start ps-4'>"+rumusPinjamanPasienTxt+"</td>";
                                                row += "<td class='text-start ps-4'>"+rumusPemeliharaanPasienTxt+"</td>";
                                            row += "</tr>";

                                        row += "</tbody>";
                                    row += "</table>";
                                row += "</div>";


                            row +="</div>";
                        row += "</td>";
                    row += "</tr>";
                    // End Buat baris detail (expandable)

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