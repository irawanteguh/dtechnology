let   result              = [];
const filterkategori      = new Tagify(document.querySelector("#filterkategori"), { enforceWhitelist: true });
const filternamapelayanan = new Tagify(document.querySelector("#filternamapelayanan"), { enforceWhitelist: true });
const filterjabatan       = new Tagify(document.querySelector("#filterjabatan"), { enforceWhitelist: true });
const filtercomponent     = new Tagify(document.querySelector("#filtercomponent"), { enforceWhitelist: true });
const filtersarana        = new Tagify(document.querySelector("#filtersarana"), { enforceWhitelist: true });
const filteralkes         = new Tagify(document.querySelector("#filteralkes"), { enforceWhitelist: true });
const filterbarang        = new Tagify(document.querySelector("#filterbarang"), { enforceWhitelist: true });
const filtersoftware      = new Tagify(document.querySelector("#filtersoftware"), { enforceWhitelist: true });

masterlayanan();

function filterTablesdm() {
    const jabatanfilter = filterjabatan.value.map(tag => tag.value);

    const tbody = document.getElementById("resultmasterdm");
    const rows  = tbody.rows;

    for (const row of rows) {
        const jabatan           = row.getElementsByTagName("td")[0].textContent;
        const showRow           = jabatanfilter.length === 0 || jabatanfilter.includes(jabatan);
              row.style.display = showRow ? "" : "none";
    }
}

function filterTableatk() {
    const componentfilter = filtercomponent.value.map(tag => tag.value);

    const tbody = document.getElementById("resultmasteratk");
    const rows  = tbody.rows;

    for (const row of rows) {
        const component           = row.getElementsByTagName("td")[0].textContent;
        const showRow           = componentfilter.length === 0 || componentfilter.includes(component);
              row.style.display = showRow ? "" : "none";
    }
}

function filterTablesarana() {
    const saranafilter = filtersarana.value.map(tag => tag.value);

    const tbody = document.getElementById("resultmastersarana");
    const rows  = tbody.rows;

    for (const row of rows) {
        const sarana           = row.getElementsByTagName("td")[0].textContent;
        const showRow           = saranafilter.length === 0 || saranafilter.includes(sarana);
        row.style.display = showRow ? "" : "none";
    }
}

function filterTablealkes() {
    const alkesfilter = filteralkes.value.map(tag => tag.value);

    const tbody = document.getElementById("resultmasteralkes");
    const rows  = tbody.rows;

    for (const row of rows) {
        const alkes           = row.getElementsByTagName("td")[0].textContent;
        const showRow           = alkesfilter.length === 0 || alkesfilter.includes(alkes);
        row.style.display = showRow ? "" : "none";
    }
}

function filterTablerumahtangga() {
    const barangfilter = filterbarang.value.map(tag => tag.value);

    const tbody = document.getElementById("resultmasterrumahtangga");
    const rows  = tbody.rows;

    for (const row of rows) {
        const barang           = row.getElementsByTagName("td")[0].textContent;
        const showRow           = barangfilter.length === 0 || barangfilter.includes(barang);
        row.style.display = showRow ? "" : "none";
    }
}

function filterTablesoftware() {
    const softwarefilter = filtersoftware.value.map(tag => tag.value);

    const tbody = document.getElementById("resultmastersoftware");
    const rows  = tbody.rows;

    for (const row of rows) {
        const software           = row.getElementsByTagName("td")[0].textContent;
        const showRow           = softwarefilter.length === 0 || softwarefilter.includes(software);
        row.style.display = showRow ? "" : "none";
    }
}


function filterTable() {
    const kategorifilter      = filterkategori.value.map(tag => tag.value);
    const namapelayananfilter = filternamapelayanan.value.map(tag => tag.value);

    const tbody = document.getElementById("resultdatamasterlayanan");
    const rows  = tbody.getElementsByTagName("tr");

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
filtercomponent.on('change', filterTableatk);
filtersarana.on('change', filterTablesarana);
filteralkes.on('change', filterTablealkes);
filterbarang.on('change', filterTablerumahtangga);
filtersoftware.on('change', filterTablesoftware);


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
    $layanid = $("#modal_unit_cost_add_sdm_layanid").val();
    mastersdm($layanid);
});

$("#modal_unit_cost_add_atk").on('show.bs.modal', function(event){
    $layanid = $("#modal_unit_cost_add_atk_layanid").val();
    masteratk($layanid);
});

$("#modal_unit_cost_add_sarana").on('show.bs.modal', function(event){
    $layanid = $("#modal_unit_cost_add_sarana_layanid").val();
    mastersarana($layanid);
});

$("#modal_unit_cost_add_alkes").on('show.bs.modal', function(event){
    $layanid = $("#modal_unit_cost_add_alkes_layanid").val();
    masteralkes($layanid);
});

$("#modal_unit_cost_add_nonalkes").on('show.bs.modal', function(event){
    $layanid = $("#modal_unit_cost_add_nonalkes_layanid").val();
    masternonalkes($layanid);
});

$("#modal_unit_cost_add_rumahtangga").on('show.bs.modal', function(event){
    $layanid = $("#modal_unit_cost_add_rumahtangga_layanid").val();
    masterrumahtangga($layanid);
});

$("#modal_unit_cost_add_software").on('show.bs.modal', function(event){
    $layanid = $("#modal_unit_cost_add_software_layanid").val();
    mastersoftware($layanid);
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
    $("#modal_unit_cost_add_sdm_layanid").val(datalayanid);
    $("#modal_unit_cost_add_sarana_layanid").val(datalayanid);
    $("#modal_unit_cost_add_alkes_layanid").val(datalayanid);
    $("#modal_unit_cost_add_nonalkes_layanid").val(datalayanid);
    $("#modal_unit_cost_add_atk_layanid").val(datalayanid);
    $("#modal_unit_cost_add_rumahtangga_layanid").val(datalayanid);
    $("#modal_unit_cost_add_software_layanid").val(datalayanid);

    detailcomponent(datalayanid);
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
                let result = data.responResult;
                for(var i in result){
                    kategori.add(result[i].kategori);
                    namapelayanan.add(result[i].nama_layan);

                    var getvariabel = " datalayanid='" + result[i].layan_id + "'" +
                                       " datajenisid='" + result[i].jenis_id + "'" +
                                       " dataname='" + result[i].nama_layan + "'" +
                                       " datadurasi='" + result[i].durasi + "'" +
                                       " datacom1='" + result[i].com_1 + "'" +
                                       " datacom2='" + result[i].com_2 + "'" +
                                       " datacom3='" + result[i].com_3 + "'" +
                                       " datatype='" + result[i].type + "'" ;

                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'><div class='badge badge-light-info'>"+(result[i].kategori ? result[i].kategori : "")+"</div></td>";
                    tableresult += "<td>"+(result[i].nama_layan ? result[i].nama_layan : "")+"</td>";
                    tableresult += "<td class='text-end'>"+(result[i].durasi ? result[i].durasi : "")+" Menit</td>";
                    tableresult += "<td class='text-end'>"+(result[i].com_1 ? todesimal(result[i].com_1) : "")+"</td>";
                    tableresult += "<td class='text-end'>"+(result[i].com_2 ? todesimal(result[i].com_2) : "")+"</td>";
                    tableresult += "<td class='text-end'>"+(result[i].com_3 ? todesimal(result[i].com_3) : "")+"</td>";
                    tableresult += "<td class='text-end'>" + todesimal(Math.round(((parseFloat(result[i].com_1) || 0) + (parseFloat(result[i].com_2) || 0) + (parseFloat(result[i].com_3) || 0)) / 3)) + "</td>";
                    tableresult += "<td class='text-end'>";
                    tableresult += "<div class='btn-group' role='group'>";
                    tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                    tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                    tableresult += "<a class='dropdown-item dropdown-item btn btn-sm text-primary' data-bs-toggle='modal' data-bs-target='#modal_unit_cost_edit' " + getvariabel + "><i class='bi bi-pencil-square me-2 text-primary'></i>Edit</a>";
                        if(result[i].type==="2"){
                            tableresult += "<a class='dropdown-item dropdown-item btn btn-sm text-primary' " + getvariabel + " onclick='getdata($(this));' data-kt-drawer-show='true' data-kt-drawer-target='#drawer_unitcost_detailcomponent'><i class='bi bi-database-add me-2 text-primary'></i>Add Component</a>";
                        }  
                    tableresult += "</div>";
                    tableresult += "</div>";
                    tableresult += "</td>";
                    tableresult += "</tr>";

                    filterkategori.settings.whitelist      = Array.from(kategori);
                    filternamapelayanan.settings.whitelist = Array.from(namapelayanan);
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
                generateRumusTable(result);
                const grouped    = {};
                let   grandtotal = 0;

                  // 1. Kelompokkan data berdasarkan kategori
                for (const i in result) {
                    const kategori                               = result[i].kategori || "Unknown";
                    if    (!grouped[kategori]) grouped[kategori] = [];
                    grouped[kategori].push(result[i]);
                }

                  // 2. Loop per kategori
                for (const kategori in grouped) {
                    const items    = grouped[kategori];
                    let   subtotal = 0;

                      // Header kategori
                    tableresult += `<tr class="table-primary fw-bold">
                                        <td colspan = "2" class = "ps-3">${kategori}</td>
                                        <td></td>
                                    </tr>`;

                      // 3. Baris komponen
                    for (let i = 0; i < items.length; i++) {
                        const row         = items[i];
                        const biaya       = Number(row.cost) || 0;
                              subtotal   += biaya;
                              grandtotal += biaya;

                        tableresult += `
                                        <tr>
                                            <td class = 'ps-4'>
                                                <div>${row.namecomponent || ""}</div>
                                                <div class = 'fs-9 fst-italic'>${row.description || ""}</div>
                                            </td>
                                            <td     class = 'text-end'>${biaya ? todesimal(biaya) : "0"}</td>
                                            <td     class = 'text-end'>
                                            <div    class = 'btn-group' role                                         = 'group'>
                                            <button id    = 'btnGroupDrop1' type                                     = 'button' class     = 'btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle = 'dropdown' aria-expanded       = 'false'>Action</button>
                                            <div    class = 'dropdown-menu' aria-labelledby                          = 'btnGroupDrop1'>
                                            <a      class = 'dropdown-item btn btn-sm text-info btn-view-rumus' href = '#' data-bs-toggle = 'modal' data-bs-target                                        = '#modal_view_rumus' data-index = '${result.indexOf(row)}'>
                                            <i      class = 'bi bi-eye me-2 text-info'></i>View Rumus
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>`;

                    }

                      // 4. Subtotal kategori
                    tableresult += `<tr class="table-warning fw-semibold">
                                        <td class = "text-end pe-2" colspan = '1'>Subtotal</td>
                                        <td class = "text-end fw-bold pe-3">${todesimal(subtotal)}</td>
                                        <td></td>
                                    </tr>`;
                }

                  // 5. Grand total di akhir semua kategori
                tableresult += `<tr class="table-success fw-bold">
                                    <td class = "text-end pe-2" colspan = '1'>Grand Total</td>
                                    <td class = "text-end pe-3">${todesimal(grandtotal)}</td>
                                    <td></td>
                                </tr>`;

                  // 6. Tambahan: Total Unit Cost x 30%
                const totalUnitCost30  = Math.round(grandtotal * 1.3);
                      tableresult     += `<tr class="table-info fw-bold">
                                    <td class = "text-end pe-2" colspan = '1'>Total Unit Cost x 30%</td>
                                    <td class = "text-end pe-3">${todesimal(totalUnitCost30)}</td>
                                    <td></td>
                                </tr>`;
            }

            $("#resultdatadetailcomponent").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
			toastr.clear();
		},
        error: function (xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>" + error + "</b>",
                icon             : "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling   : false,
                timerProgressBar : true,
                timer            : 5000,
                customClass      : { confirmButton: "btn btn-danger" },
                showClass        : { popup: "animate__animated animate__fadeInUp animate__faster" },
                hideClass        : { popup: "animate__animated animate__fadeOutDown animate__faster" }
            });
        }
    });
    return false;
};

function mastersdm(layanid){
    $.ajax({
        url       : url+"index.php/unitcost/unitcost/mastersdm",
        data      : {layanid:layanid},
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

                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>"+result[i].posisi+"</td>";
                    tableresult += "<td class='text-end'>"+todesimal(result[i].nilai)+"</td>";
                    tableresult += "<td class='text-end'>"+todesimal(result[i].remunerasi)+"</td>";
                    tableresult += "<td class='text-end pe-4'><input class='form-control form-control-sm text-end' id='jml_"+result[i].transaksi_id+"' value='"+result[i].jml+"' onchange='updatesdm(this)'></td>";
                    tableresult += "</tr>";
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

function masteratk(layanid){
    $.ajax({
        url       : url+"index.php/unitcost/unitcost/masteratk",
        data      : {layanid:layanid},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultmasteratk").html("");
        },
        success:function(data){
            var tableresult = "";

            if(data.responCode==="00"){
                var result  = data.responResult;
                var component = new Set();

                for(var i in result){
                    component.add(result[i].component);

                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>"+result[i].component+"</td>";
                    tableresult += "<td class='text-end'>"+result[i].satuan+"</td>";
                    tableresult += "<td>"+todesimal(result[i].nilai)+"</td>";
                    tableresult += "<td class='text-end pe-4'><input class='form-control form-control-sm text-end' id='component_"+result[i].component_id+"' value='"+result[i].jml+"' onchange='updatecomponent(this)'></td>";
                    tableresult += "</tr>";
                }
            }

            filtercomponent.settings.whitelist = Array.from(component);
            $("#resultmasteratk").html(tableresult);

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

function mastersarana(layanid){
    $.ajax({
        url       : url+"index.php/unitcost/unitcost/mastersarana",
        data      : {layanid:layanid},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultmastersarana").html("");
        },
        success:function(data){
            var tableresult = "";

            if(data.responCode==="00"){
                var result  = data.responResult;
                var sarana = new Set();

                for(var i in result){
                    sarana.add(result[i].name);

                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>"+result[i].name+"</td>";
                    if(result[i].transid===null || result[i].active==="0"){
                        tableresult += "<td class='text-end pe-4'><a class='btn btn-sm btn-primary' datastatus='1' and dataassetsid='"+result[i].trans_id+"' onclick='updatedatasarana($(this));'><i class='bi bi-check2-circle me-2'></i>Pilih</a></td>";
                    }else{
                        tableresult += "<td class='text-end pe-4'><a class='btn btn-sm btn-danger' datastatus='0' and dataassetsid='"+result[i].trans_id+"' onclick='updatedatasarana($(this));'><i class='bi bi-trash3 me-2'></i>Hapus</a></td>";
                    }
                    
                    tableresult += "</tr>";
                }
            }

            filtersarana.settings.whitelist = Array.from(sarana);
            $("#resultmastersarana").html(tableresult);

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

function masteralkes(layanid){
    $.ajax({
        url       : url+"index.php/unitcost/unitcost/masteralkes",
        data      : {layanid:layanid},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultmasteralkes").html("");
        },
        success:function(data){
            var tableresult = "";

            if(data.responCode==="00"){
                var result  = data.responResult;
                var alkes = new Set();

                for(var i in result){
                    alkes.add(result[i].name);

                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>"+result[i].name+"</td>";
                    if(result[i].transid===null || result[i].active==="0"){
                        tableresult += "<td class='text-end pe-4'><a class='btn btn-sm btn-primary' datastatus='1' and dataassetsid='"+result[i].trans_id+"' onclick='updatedataalkes($(this));'><i class='bi bi-check2-circle me-2'></i>Pilih</a></td>";
                    }else{
                        tableresult += "<td class='text-end pe-4'><a class='btn btn-sm btn-danger' datastatus='0' and dataassetsid='"+result[i].trans_id+"' onclick='updatedataalkes($(this));'><i class='bi bi-trash3 me-2'></i>Hapus</a></td>";
                    }
                    
                    tableresult += "</tr>";
                }
            }

            filteralkes.settings.whitelist = Array.from(alkes);
            $("#resultmasteralkes").html(tableresult);

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

function masternonalkes(layanid){
    $.ajax({
        url       : url+"index.php/unitcost/unitcost/masternonalkes",
        data      : {layanid:layanid},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultmasternonalkes").html("");
        },
        success:function(data){
            var tableresult = "";

            if(data.responCode==="00"){
                var result  = data.responResult;
                var alkes = new Set();

                for(var i in result){
                    alkes.add(result[i].name);

                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>"+result[i].name+"</td>";
                    if(result[i].transid===null || result[i].active==="0"){
                        tableresult += "<td class='text-end pe-4'><a class='btn btn-sm btn-primary' datastatus='1' and dataassetsid='"+result[i].trans_id+"' onclick='updatedatanonalkes($(this));'><i class='bi bi-check2-circle me-2'></i>Pilih</a></td>";
                    }else{
                        tableresult += "<td class='text-end pe-4'><a class='btn btn-sm btn-danger' datastatus='0' and dataassetsid='"+result[i].trans_id+"' onclick='updatedatanonalkes($(this));'><i class='bi bi-trash3 me-2'></i>Hapus</a></td>";
                    }
                    
                    tableresult += "</tr>";
                }
            }

            filteralkes.settings.whitelist = Array.from(alkes);
            $("#resultmasternonalkes").html(tableresult);

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

function masterrumahtangga(layanid){
    $.ajax({
        url       : url+"index.php/unitcost/unitcost/masterrumahtangga",
        data      : {layanid:layanid},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultmasterrumahtangga").html("");
        },
        success:function(data){
            var tableresult = "";

            if(data.responCode==="00"){
                var result  = data.responResult;
                var barang = new Set();

                for(var i in result){
                    barang.add(result[i].name);

                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>"+result[i].name+"</td>";
                    if(result[i].transid===null || result[i].active==="0"){
                        tableresult += "<td class='text-end pe-4'><a class='btn btn-sm btn-primary' datastatus='1' and dataassetsid='"+result[i].trans_id+"' onclick='updatedatarumahtangga($(this));'><i class='bi bi-check2-circle me-2'></i>Pilih</a></td>";
                    }else{
                        tableresult += "<td class='text-end pe-4'><a class='btn btn-sm btn-danger' datastatus='0' and dataassetsid='"+result[i].trans_id+"' onclick='updatedatarumahtangga($(this));'><i class='bi bi-trash3 me-2'></i>Hapus</a></td>";
                    }
                    
                    tableresult += "</tr>";
                }
            }

            filterbarang.settings.whitelist = Array.from(barang);
            $("#resultmasterrumahtangga").html(tableresult);

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

function mastersoftware(layanid){
    $.ajax({
        url       : url+"index.php/unitcost/unitcost/mastersoftware",
        data      : {layanid:layanid},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultmastersoftware").html("");
        },
        success:function(data){
            var tableresult = "";

            if(data.responCode==="00"){
                var result  = data.responResult;
                var software = new Set();

                for(var i in result){
                    software.add(result[i].name);

                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>"+result[i].name+"</td>";
                    if(result[i].transid===null || result[i].active==="0"){
                        tableresult += "<td class='text-end pe-4'><a class='btn btn-sm btn-primary' datastatus='1' and dataassetsid='"+result[i].trans_id+"' onclick='updatedatasoftware($(this));'><i class='bi bi-check2-circle me-2'></i>Pilih</a></td>";
                    }else{
                        tableresult += "<td class='text-end pe-4'><a class='btn btn-sm btn-danger' datastatus='0' and dataassetsid='"+result[i].trans_id+"' onclick='updatedatasoftware($(this));'><i class='bi bi-trash3 me-2'></i>Hapus</a></td>";
                    }
                    
                    tableresult += "</tr>";
                }
            }

            filtersoftware.settings.whitelist = Array.from(software);
            $("#resultmastersoftware").html(tableresult);

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
    $("#rumusactual").empty();
    
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

    const rumusasset = {
                    perolehan: `\\[
                    \\begin{aligned}
                    \\text{Perolehan} = \\
                    \\mathrm{round}\\left(
                        \\mathrm{round}\\left( \\frac{\\text{nilai aset}}{\\text{depresiasi}},\\ 0 \\right)
                        \\rightarrow
                        \\mathrm{round}\\left( \\frac{\\text{tahunan}}{12 \\text{ bulan}},\\ 0 \\right)
                        \\rightarrow
                        \\mathrm{round}\\left( \\frac{\\text{bulanan}}{30 \\text{ hari}},\\ 0 \\right)
                        \\rightarrow
                        \\mathrm{round}\\left( \\frac{\\text{harian}}{\\text{estimasi penggunaan per hari}},\\ 0 \\right)
                    ,\\ 0 \\right)
                    \\end{aligned}
                    \\]`,

                    pinjaman: `\\[
                    \\begin{aligned}
                    \\text{Pinjaman} = \\
                    \\mathrm{round}\\left(
                        \\mathrm{round}\\left( \\frac{\\text{nilai bunga}}{\\text{jangka waktu}},\\ 0 \\right)
                        \\rightarrow
                        \\mathrm{round}\\left( \\frac{\\text{tahunan}}{12 \\text{ bulan}},\\ 0 \\right)
                        \\rightarrow
                        \\mathrm{round}\\left( \\frac{\\text{bulanan}}{30 \\text{ hari}},\\ 0 \\right)
                        \\rightarrow
                        \\mathrm{round}\\left( \\frac{\\text{harian}}{\\text{estimasi penggunaan per hari}},\\ 0 \\right)
                    ,\\ 0 \\right)
                    \\end{aligned}
                    \\]`,

                    pemeliharaan: `\\[
                    \\begin{aligned}
                    \\text{Pemeliharaan} = \\
                    \\mathrm{round}\\left(
                        \\mathrm{round}\\left( \\frac{\\text{nilai pemeliharaan}}{\\text{depresiasi}},\\ 0 \\right)
                        \\rightarrow
                        \\mathrm{round}\\left( \\frac{\\text{tahunan}}{12 \\text{ bulan}},\\ 0 \\right)
                        \\rightarrow
                        \\mathrm{round}\\left( \\frac{\\text{bulanan}}{30 \\text{ hari}},\\ 0 \\right)
                        \\rightarrow
                        \\mathrm{round}\\left( \\frac{\\text{harian}}{\\text{estimasi penggunaan per hari}},\\ 0 \\right)
                    ,\\ 0 \\right)
                    \\end{aligned}
                    \\]`,

                    total: `\\[
                    \\text{Cost per Pasien} = \\mathrm{round}\\left(
                        \\text{Perolehan} + \\text{Pinjaman} + \\text{Pemeliharaan}
                    ,\\ 0 \\right)
                    \\]`
                };


    const rumusassetTxt = {
                        perolehan: `\\[
                        \\begin{aligned}
                        \\text{${formatCurrency(resultItem.perolehanpasien)}} = \\
                        \\mathrm{round}\\left(
                            \\mathrm{round}\\left( \\frac{\\text{${formatCurrency(resultItem.nilaiasset)}}}{\\text{${resultItem.depresiasi} Tahun}},\\ 0 \\right)
                            \\rightarrow
                            \\mathrm{round}\\left( \\frac{\\text{${formatCurrency(resultItem.perolehantahunan)}}}{12 \\text{ bulan}},\\ 0 \\right)
                            \\rightarrow
                            \\mathrm{round}\\left( \\frac{\\text{${formatCurrency(resultItem.perolehanbulanan)}}}{30 \\text{ hari}},\\ 0 \\right)
                            \\rightarrow
                            \\mathrm{round}\\left( \\frac{\\text{${formatCurrency(resultItem.perolehanharian)}}}{\\text{${resultItem.estimasi_penggunaan_day} per hari}},\\ 0 \\right)
                        ,\\ 0 \\right)
                        \\end{aligned}
                        \\]`,

                        pinjaman: `\\[
                        \\begin{aligned}
                        \\text{${formatCurrency(resultItem.pinjamanpasien)}} = \\
                        \\mathrm{round}\\left(
                            \\mathrm{round}\\left( \\frac{\\text{${formatCurrency(resultItem.nilaipinjaman)}}}{\\text{${resultItem.waktupinjaman} Tahun}},\\ 0 \\right)
                            \\rightarrow
                            \\mathrm{round}\\left( \\frac{\\text{${formatCurrency(resultItem.pinjamantahunan)}}}{12 \\text{ bulan}},\\ 0 \\right)
                            \\rightarrow
                            \\mathrm{round}\\left( \\frac{\\text{${formatCurrency(resultItem.pinjamanbulanan)}}}{30 \\text{ hari}},\\ 0 \\right)
                            \\rightarrow
                            \\mathrm{round}\\left( \\frac{\\text{${formatCurrency(resultItem.pinjamanharian)}}}{\\text{${resultItem.estimasi_penggunaan_day}per hari}},\\ 0 \\right)
                        ,\\ 0 \\right)
                        \\end{aligned}
                        \\]`,

                        pemeliharaan: `\\[
                        \\begin{aligned}
                        \\text{${formatCurrency(resultItem.pemeliharaanpasien)}} = \\
                        \\mathrm{round}\\left(
                            \\mathrm{round}\\left( \\frac{\\text{${formatCurrency(resultItem.nilaipemeliharaan)}}}{\\text{${resultItem.depresiasi} Tahun}},\\ 0 \\right)
                            \\rightarrow
                            \\mathrm{round}\\left( \\frac{\\text{${formatCurrency(resultItem.pemeliharaantahunan)}}}{12 \\text{ bulan}},\\ 0 \\right)
                            \\rightarrow
                            \\mathrm{round}\\left( \\frac{\\text{${formatCurrency(resultItem.pemeliharaanbulanan)}}}{30 \\text{ hari}},\\ 0 \\right)
                            \\rightarrow
                            \\mathrm{round}\\left( \\frac{\\text{${formatCurrency(resultItem.pemeliharaanharian)}}}{\\text{${resultItem.estimasi_penggunaan_day} per hari}},\\ 0 \\right)
                        ,\\ 0 \\right)
                        \\end{aligned}
                        \\]`,

                        total: `\\[
                        \\text{${formatCurrency(resultItem.costperpasien)}} = \\mathrm{round}\\left(
                            \\text{${formatCurrency(resultItem.perolehanpasien)}} + \\text{${formatCurrency(resultItem.pinjamanpasien)}} + \\text{${formatCurrency(resultItem.pemeliharaanpasien)}}
                        ,\\ 0 \\right)
                        \\]`
                          };

    if(resultItem.jenis_id==="1"){
        $("#rumus").html( rumusasset.perolehan+rumusasset.pinjaman+rumusasset.pemeliharaan+rumusasset.total);
        $("#rumusactual").html(rumusassetTxt.perolehan+rumusassetTxt.pinjaman+rumusassetTxt.pemeliharaan+rumusassetTxt.total);
    }else{
        if(resultItem.jenis_id==="2"){
            $("#rumus").html(rumussdm);
            $("#rumusactual").html(rumussdmTxt);
        }else{
            $("#rumus").html("");
            $("#rumusactual").html("");
        }
        
    }

    MathJax.typeset();  // Ensure LaTeX is rendered
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

function updatesdm(input) {
    const positionid = input.id.split("_")[1];
    const jmlInput   = document.getElementById(`jml_${positionid}`);
    const jml        = parseFloat(jmlInput.value);
    const layanid    = $("#modal_unit_cost_add_sdm_layanid").val();

    $.ajax({
        url       : url + "index.php/unitcost/unitcost/updatesdm",
        method    : "POST",
        dataType  : "JSON",
        data      : {layanid:layanid,jml:jml,positionid:positionid},
        beforeSend: function () {
            // toastr.clear();
            // toastr.info("Updating data...", "Please wait");
        },
        success: function (data) {
            if(data.responCode == "00"){
                detailcomponent(layanid);
			}

            // toastr.clear();
            // toastr[data.responHead](data.responDesc, "INFORMATION");
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
};

function updatecomponent(input) {
    const componentid = input.id.split("_")[1];
    const jmlInput    = document.getElementById(`component_${componentid}`);
    const jml         = parseFloat(jmlInput.value);
    const layanid     = $("#modal_unit_cost_add_atk_layanid").val();

    $.ajax({
        url       : url + "index.php/unitcost/unitcost/updatecomponent",
        method    : "POST",
        dataType  : "JSON",
        data      : {layanid:layanid,jml:jml,componentid:componentid},
        beforeSend: function () {
            toastr.clear();
            toastr.info("Updating data...", "Please wait");
        },
        success: function (data) {
            if(data.responCode == "00"){
                detailcomponent(layanid);
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
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
};

function updatedatasarana(btn) {
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
            var   datastatus   = btn.attr("datastatus");
            var   dataassetsid = btn.attr("dataassetsid");
            const layanid      = $("#modal_unit_cost_add_sarana_layanid").val();

            $.ajax({
                url       : url+"index.php/unitcost/unitcost/updatedataassets",
                data      : {datastatus:datastatus,dataassetsid:dataassetsid,layanid:layanid},
                method    : "POST",
                dataType  : "JSON",
                cache     : false,
                beforeSend: function () {
                    // toastr.clear();
                    // toastr["info"]("Sending request...", "Please wait");
                },
                success: function (data) {
                    // toastr.clear();
                    // toastr[data.responHead](data.responDesc, "INFORMATION");
                },
                complete: function () {
                    mastersarana(layanid);
                    detailcomponent(layanid);
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

function updatedataalkes(btn) {
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
            var   datastatus   = btn.attr("datastatus");
            var   dataassetsid = btn.attr("dataassetsid");
            const layanid      = $("#modal_unit_cost_add_alkes_layanid").val();

            $.ajax({
                url       : url+"index.php/unitcost/unitcost/updatedataassets",
                data      : {datastatus:datastatus,dataassetsid:dataassetsid,layanid:layanid},
                method    : "POST",
                dataType  : "JSON",
                cache     : false,
                beforeSend: function () {
                    // toastr.clear();
                    // toastr["info"]("Sending request...", "Please wait");
                },
                success: function (data) {
                    // toastr.clear();
                    // toastr[data.responHead](data.responDesc, "INFORMATION");
                },
                complete: function () {
                    masteralkes(layanid);
                    detailcomponent(layanid);
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

function updatedatanonalkes(btn) {
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
            var   datastatus   = btn.attr("datastatus");
            var   dataassetsid = btn.attr("dataassetsid");
            const layanid      = $("#modal_unit_cost_add_nonalkes_layanid").val();

            $.ajax({
                url       : url+"index.php/unitcost/unitcost/updatedataassets",
                data      : {datastatus:datastatus,dataassetsid:dataassetsid,layanid:layanid},
                method    : "POST",
                dataType  : "JSON",
                cache     : false,
                beforeSend: function () {
                    // toastr.clear();
                    // toastr["info"]("Sending request...", "Please wait");
                },
                success: function (data) {
                    // toastr.clear();
                    // toastr[data.responHead](data.responDesc, "INFORMATION");
                },
                complete: function () {
                    masternonalkes(layanid);
                    detailcomponent(layanid);
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

function updatedatarumahtangga(btn) {
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
            var   datastatus   = btn.attr("datastatus");
            var   dataassetsid = btn.attr("dataassetsid");
            const layanid      = $("#modal_unit_cost_add_rumahtangga_layanid").val();

            $.ajax({
                url       : url+"index.php/unitcost/unitcost/updatedataassets",
                data      : {datastatus:datastatus,dataassetsid:dataassetsid,layanid:layanid},
                method    : "POST",
                dataType  : "JSON",
                cache     : false,
                beforeSend: function () {
                    // toastr.clear();
                    // toastr["info"]("Sending request...", "Please wait");
                },
                success: function (data) {
                    // toastr.clear();
                    // toastr[data.responHead](data.responDesc, "INFORMATION");
                },
                complete: function () {
                    masterrumahtangga(layanid);
                    detailcomponent(layanid);
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

function updatedatasoftware(btn) {
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
            var   datastatus   = btn.attr("datastatus");
            var   dataassetsid = btn.attr("dataassetsid");
            const layanid      = $("#modal_unit_cost_add_software_layanid").val();

            $.ajax({
                url       : url+"index.php/unitcost/unitcost/updatedataassets",
                data      : {datastatus:datastatus,dataassetsid:dataassetsid,layanid:layanid},
                method    : "POST",
                dataType  : "JSON",
                cache     : false,
                beforeSend: function () {
                    // toastr.clear();
                    // toastr["info"]("Sending request...", "Please wait");
                },
                success: function (data) {
                    // toastr.clear();
                    // toastr[data.responHead](data.responDesc, "INFORMATION");
                },
                complete: function () {
                    mastersoftware(layanid);
                    detailcomponent(layanid);
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