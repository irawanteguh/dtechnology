let result = [];


masterlayanan();

const filterkategori      = new Tagify(document.querySelector("#filterkategori"), { enforceWhitelist: true });
const filternamapelayanan = new Tagify(document.querySelector("#filternamapelayanan"), { enforceWhitelist: true });
const filterjabatan       = new Tagify(document.querySelector("#filterjabatan"), { enforceWhitelist: true });

function filterTablesdm() {
    const jabatanfilter = filterjabatan.value.map(tag => tag.value);

    const tbody = document.getElementById("resultmasterdm");
    const rows = tbody.rows;

    for (const row of rows) {
        const jabatan = row.getElementsByTagName("td")[0].textContent;
        const showRow = jabatanfilter.length === 0 || jabatanfilter.includes(jabatan);
        row.style.display = showRow ? "" : "none";
    }
}


function filterTable() {
    const kategorifilter      = filterkategori.value.map(tag => tag.value);
    const namapelayananfilter = filternamapelayanan.value.map(tag => tag.value);

    const tbody = document.getElementById("resultdatamasterlayanan");
    const rows = tbody.getElementsByTagName("tr");

    for (const row of rows) {
        const kategori      = row.getElementsByTagName("td")[0].textContent;
        const namapelayanan = row.getElementsByTagName("td")[1].textContent;

        const showRow = 
            (kategorifilter.length === 0 || kategorifilter.includes(kategori)) &&
            (namapelayananfilter.length === 0 || namapelayananfilter.includes(namapelayanan));

        row.style.display = showRow ? "" : "none";
    }
}

filterkategori.on('change', filterTable);
filternamapelayanan.on('change', filterTable);
filterjabatan.on('change', filterTablesdm);

$("#modal_unit_cost_edit").on('show.bs.modal', function(event){
    var button      = $(event.relatedTarget);
    var datalayanid = button.attr("datalayanid");
    var datatype    = button.attr("datatype");
    var dataname    = button.attr("dataname");
    var datajenisid = button.attr("datajenisid");
    var datadurasi  = button.attr("datadurasi");
    var datacom1    = button.attr("datacom1");
    var datacom2    = button.attr("datacom2");
    var datacom3    = button.attr("datacom3");

    $("#modal_unit_cost_edit_type").val(datatype);
    $("#modal_unit_cost_edit_layanid").val(datalayanid);
    $("#modal_unit_cost_edit_name").val(dataname);

    $("#modal_unit_cost_edit_durasi").val(datadurasi);
    $("#modal_unit_cost_edit_com1").val(formatCurrency(datacom1));
    $("#modal_unit_cost_edit_com2").val(formatCurrency(datacom2));
    $("#modal_unit_cost_edit_com3").val(formatCurrency(datacom3));

    var $datajenisid = $('#modal_unit_cost_edit_kategori').select2();
        $datajenisid.val(datajenisid).trigger('change');
});

$("#modal_unit_cost_add_sdm").on('show.bs.modal', function(event){
    var button           = $(event.relatedTarget);
    mastersdm();
});

$(document).on("click", ".btn-view-rumus", function (e) {
   const index = $(this).data("index");
    if(typeof result[index] === "undefined"){
        console.error("Data tidak ditemukan untuk index:", index);
        toastr["error"]("Data rumus tidak ditemukan.");
        return;
    }

    const data = result[index];
    generateRumusTable(data);
});

function getdata(btn){
    var datalayanid = btn.attr("datalayanid");
    var dataname    = btn.attr("dataname");

    $("#namapelayanan").html(dataname);
    detailcomponent(datalayanid)
};

function masterlayanan(){
    $.ajax({
        url       : url+"index.php/unitcost/unitcost/masterlayanan",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatamasterlayanan").html("");
        },
        success:function(data){
            let tableresult;
            var kategori      = new Set();
            var namapelayanan = new Set();

            if(data.responCode==="00"){
                let result        = data.responResult;
                for(var i in result){
                    kategori.add(result[i].kategori);
                    namapelayanan.add(result[i].nama_layan);

                    var getvariabel =  " datalayanid='" + result[i].layan_id + "'" +
                                       " datajenisid='" + result[i].jenis_id + "'" +
                                       " dataname='" + result[i].nama_layan + "'" +
                                       " datadurasi='" + result[i].durasi + "'" +
                                       " datacom1='" + result[i].com_1 + "'" +
                                       " datacom2='" + result[i].com_2 + "'" +
                                       " datacom3='" + result[i].com_3 + "'" +
                                       " datatype='" + result[i].type + "'" ;

                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'><div class='badge badge-light-info'>"+(result[i].kategori ? result[i].kategori : "")+"</div></td>";
                    tableresult +="<td>"+(result[i].nama_layan ? result[i].nama_layan : "")+"</td>";
                    tableresult +="<td class='text-end'>"+(result[i].durasi ? result[i].durasi : "")+" Menit</td>";
                    tableresult +="<td class='text-end'>"+(result[i].com_1 ? todesimal(result[i].com_1) : "")+"</td>";
                    tableresult +="<td class='text-end'>"+(result[i].com_2 ? todesimal(result[i].com_2) : "")+"</td>";
                    tableresult +="<td class='text-end'>"+(result[i].com_3 ? todesimal(result[i].com_3) : "")+"</td>";
                    tableresult +="<td class='text-end'>" + todesimal(Math.round(((parseFloat(result[i].com_1) || 0) + (parseFloat(result[i].com_2) || 0) + (parseFloat(result[i].com_3) || 0)) / 3)) + "</td>";
                    tableresult +="<td class='text-end'>";
                        tableresult +="<div class='btn-group' role='group'>";
                            tableresult +="<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult +="<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                tableresult += "<a class='dropdown-item dropdown-item btn btn-sm text-primary' data-bs-toggle='modal' data-bs-target='#modal_unit_cost_edit' " + getvariabel + "><i class='bi bi-pencil-square me-2 text-primary'></i>Edit</a>";  
                                if(result[i].type==="2"){
                                    tableresult += "<a class='dropdown-item dropdown-item btn btn-sm text-primary' " + getvariabel + " onclick='getdata($(this));' data-kt-drawer-show='true' data-kt-drawer-target='#drawer_unitcost_detailcomponent'><i class='bi bi-database-add me-2 text-primary'></i>Add Component</a>";
                                }  
                                
                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</td>";

                    tableresult +="</tr>";

                    filterkategori.settings.whitelist = Array.from(kategori);
                    filternamapelayanan.settings.whitelist   = Array.from(namapelayanan);
                }
            }


            $("#resultdatamasterlayanan").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
			toastr.clear();
		},
        error: function(xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>"+error+"</b>",
                icon             : "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling   : false,
                timerProgressBar : true,
                timer            : 5000,
                customClass      : {confirmButton: "btn btn-danger"},
                showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
            });
		}		
    });
    return false;
};

function detailcomponent(layanid) {
    $.ajax({
        url       : url + "index.php/unitcost/unitcost/detailcomponent",
        data      : {layanid:layanid},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatadetailcomponent").html("");
        },
        success: function (data) {
            let tableresult = "";

            if (data.responCode === "00") {
                result = data.responResult;
                const grouped = {};
                let grandtotal = 0;

                // 1. Kelompokkan data berdasarkan kategori
                for (const i in result) {
                    const kategori = result[i].kategori || "Tanpa Kategori";
                    if (!grouped[kategori]) grouped[kategori] = [];
                    grouped[kategori].push(result[i]);
                }

                // 2. Loop per kategori
                for (const kategori in grouped) {
                    const items = grouped[kategori];
                    let subtotal = 0;

                    // Header kategori
                    tableresult += `<tr class="table-primary fw-bold">
                                        <td colspan="2" class="ps-3">${kategori}</td>
                                        <td></td>
                                    </tr>`;

                    // 3. Baris komponen
                    for (let i = 0; i < items.length; i++) {
                        const row       = items[i];
                        const biaya     = Number(row.cost) || 0;
                        subtotal       += biaya;
                        grandtotal     += biaya;

                        tableresult += `
                                        <tr>
                                            <td class='ps-4'>
                                                <div>${row.namecomponent || ""}</div>
                                                <div class='fs-9 fst-italic'>${row.description || ""}</div>
                                            </td>
                                            <td class='text-end'>${biaya ? todesimal(biaya) : "0"}</td>
                                            <td class='text-end'>
                                                <div class='btn-group' role='group'>
                                                    <button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>
                                                    <div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>
                                                        <a class='dropdown-item btn btn-sm text-primary' data-bs-toggle='modal' data-bs-target='#modal_unit_cost_edit'>
                                                            <i class='bi bi-pencil-square me-2 text-primary'></i>Edit
                                                        </a>
                                                        <a class='dropdown-item btn btn-sm text-info btn-view-rumus' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_rumus' data-index='${i}'>
                                                            <i class='bi bi-eye me-2 text-info'></i>View Rumus
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>`;

                    }

                    // 4. Subtotal kategori
                    tableresult += `<tr class="table-warning fw-semibold">
                                        <td class="text-end pe-2" colspan='1'>Subtotal</td>
                                        <td class="text-end fw-bold pe-3">${todesimal(subtotal)}</td>
                                        <td></td>
                                    </tr>`;
                }

                // 5. Grand total di akhir semua kategori
                tableresult += `<tr class="table-success fw-bold">
                                    <td class="text-end pe-2" colspan='1'>Grand Total</td>
                                    <td class="text-end pe-3">${todesimal(grandtotal)}</td>
                                    <td></td>
                                </tr>`;

                // 6. Tambahan: Total Unit Cost x 30%
                const totalUnitCost30 = Math.round(grandtotal * 1.3);
                tableresult += `<tr class="table-info fw-bold">
                                    <td class="text-end pe-2" colspan='1'>Total Unit Cost x 30%</td>
                                    <td class="text-end pe-3">${todesimal(totalUnitCost30)}</td>
                                    <td></td>
                                </tr>`;
            }

            $("#resultdatadetailcomponent").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");
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

function mastersdm(){
    $.ajax({
        url       : url+"index.php/unitcost/unitcost/mastersdm",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultmasterdm").html("");
        },
        success:function(data){
            var tableresult = "";

            if(data.responCode==="00"){
                var result  = data.responResult;
                var jabatan = new Set();

                for(var i in result){
                    jabatan.add(result[i].posisi);

                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'>"+result[i].posisi+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].nilai)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].remunerasi)+"</td>";
                    tableresult += `<td class='text-end pe-4'><input class='form-control form-control-sm text-end' id='jml_${result[i].transaksi_id}' value='${result[i].transaksi_id}' onchange='simpandata(this)'></td>`;
                    tableresult +="</tr>";
                }

                
            }

            filterjabatan.settings.whitelist = Array.from(jabatan);
            $("#resultmasterdm").html(tableresult);

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
			toastr.clear();
		},
        error: function(xhr, status, error) {
            showAlert(
                "I'm Sorry",
                error,
                "error",
                "Please Try Again",
                "btn btn-danger"
            );
		}
    });
    return false;
};

function generateRumusTable(resultItem) {
    $("#rumus").empty();
    let rumussdm = `
                    \\[
                    \\text{Cost per Pasien} = \\mathrm{round}\\left(
                        \\left(
                            \\left( \\frac{\\text{Gaji per bulan}}{\\text{jumlah hari kerja} \\times \\text{jam per shift} \\times 60\\ \\text{menit}} \\right)
                            \\times \\text{jumlah SDM}
                        \\right)
                        +
                        \\left(
                            \\left( \\frac{\\text{Remunerasi per bulan}}{\\text{jumlah hari kerja} \\times \\text{jam per shift} \\times 60\\ \\text{menit}} \\right)
                            \\times \\text{jumlah SDM}
                        \\right)
                    ,\\ 0 \\right)
                    \\]
                    `;

    
    let rumussdmTxt = `
                        \\[
                        \\text{${formatCurrency(resultItem.cost)}} = \\mathrm{round}\\left(
                            \\left(
                                \\left( \\frac{${formatCurrency(resultItem.gaji)}}{\\text{25 hari kerja} \\times \\text{8 Jam} \\times 60\\ \\text{menit}} \\right)
                                \\times \\text{${resultItem.jmlsdm} Orang}
                            \\right)
                            +
                            \\left(
                                \\left( \\frac{${formatCurrency(resultItem.remun)}}{\\text{25 hari kerja} \\times \\text{8 Jam} \\times 60\\ \\text{menit}} \\right)
                                \\times \\text{${resultItem.jmlsdm} Orang}
                            \\right)
                        ,\\ 0 \\right)
                        \\]
                        `;







   
    $("#rumus").html(rumussdm+rumussdmTxt);

    MathJax.typeset(); // Ensure LaTeX is rendered
}

$(document).on("submit", "#formaddsimulation", function (e) {
	e.preventDefault();
	var form = $(this);
    var url  = $(this).attr("action");

	$.ajax({
        url       : url,
        data      : form.serialize(),
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
			$("#modal_unit_cost_add_btn").addClass("disabled");
        },
		success: function (data) {
            if(data.responCode == "00"){
                masterlayanan();
                $('#modal_unit_cost_add').modal('hide');
			}

            toastr.clear();
			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            toastr.clear();
            $("#modal_unit_cost_add_btn").removeClass("disabled");
		},
        error: function(xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>"+error+"</b>",
                icon             : "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling   : false,
                timerProgressBar : true,
                timer            : 5000,
                customClass      : {confirmButton: "btn btn-danger"},
                showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
            });
		}		
	});
    return false;
});

$(document).on("submit", "#formeditsimulation", function (e) {
	e.preventDefault();
	var form = $(this);
    var url  = $(this).attr("action");

	$.ajax({
        url       : url,
        data      : form.serialize(),
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
			$("#modal_unit_cost_edit_btn").addClass("disabled");
        },
		success: function (data) {
            if(data.responCode == "00"){
                masterlayanan();
                $('#modal_unit_cost_edit').modal('hide');
			}

            toastr.clear();
			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            toastr.clear();
            $("#modal_unit_cost_edit_btn").removeClass("disabled");
		},
        error: function(xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>"+error+"</b>",
                icon             : "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling   : false,
                timerProgressBar : true,
                timer            : 5000,
                customClass      : {confirmButton: "btn btn-danger"},
                showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
            });
		}		
	});
    return false;
});