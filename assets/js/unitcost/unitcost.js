masterlayanan();
// detailcomponent();

const filterkategori      = new Tagify(document.querySelector("#filterkategori"), { enforceWhitelist: true });
const filternamapelayanan = new Tagify(document.querySelector("#filternamapelayanan"), { enforceWhitelist: true });

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
                                    tableresult += "<a class='dropdown-item dropdown-item btn btn-sm text-primary' data-bs-toggle='modal' data-bs-target='#modal_unit_cost_edit' " + getvariabel + "><i class='bi bi-pencil-square me-2 text-primary'></i>Edit</a></li>";  
                                    if(result[i].type==="2"){
                                        tableresult += "<a class='dropdown-item dropdown-item btn btn-sm text-primary' " + getvariabel + " onclick='getdata($(this));'><i class='bi bi-database-add me-2 text-primary'></i>Add Component</a></li>"; 
                                    }  
                                    tableresult += "<a class='dropdown-item btn btn-sm' data-kt-drawer-show='true' data-kt-drawer-target='#drawer_employee_registrationposition_add' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-person-add'></i> Positioning</a>";
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
			//
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
                const result = data.responResult;
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

                        tableresult += `<tr>
                                            <td class='ps-4'><div>${row.namecomponent || ""}</div><div class='fs-9 fst-italic'>${row.description || ""}</div></td>
                                            <td class='text-end'>${biaya ? todesimal(biaya) : "0"}</td>
                                            <td class='text-end'>
                                                <a class='btn btn-sm btn-light-primary'>Detail</a>
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