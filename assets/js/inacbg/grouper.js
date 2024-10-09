listkunjungan();

Inputmask("Rp. 999.999.999,99", { "numericInput": false }).mask("input[name='modal-grouper-konsultasi']");
Inputmask("Rp. 999.999.999,99", { "numericInput": false }).mask("input[name='modal-grouper-nonbedah']");
Inputmask("Rp. 999.999.999,99", { "numericInput": false }).mask("input[name='modal-grouper-bedah']");
Inputmask("Rp. 999.999.999,99", { "numericInput": false }).mask("input[name='modal-grouper-ahli']");
Inputmask("Rp. 999.999.999,99", { "numericInput": false }).mask("input[name='modal-grouper-perawat']");
Inputmask("Rp. 999.999.999,99", { "numericInput": false }).mask("input[name='modal-grouper-penunjang']");
Inputmask("Rp. 999.999.999,99", { "numericInput": false }).mask("input[name='modal-grouper-rad']");
Inputmask("Rp. 999.999.999,99", { "numericInput": false }).mask("input[name='modal-grouper-lab']");
Inputmask("Rp. 999.999.999,99", { "numericInput": false }).mask("input[name='modal-grouper-obat']");
Inputmask("Rp. 999.999.999,99", { "numericInput": false }).mask("input[name='modal-grouper-obatkronis']");
Inputmask("Rp. 999.999.999,99", { "numericInput": false }).mask("input[name='modal-grouper-obatkemo']");
Inputmask("Rp. 999.999.999,99", { "numericInput": false }).mask("input[name='modal-grouper-darah']");
Inputmask("Rp. 999.999.999,99", { "numericInput": false }).mask("input[name='modal-grouper-rehab']");
Inputmask("Rp. 999.999.999,99", { "numericInput": false }).mask("input[name='modal-grouper-kamar']");
Inputmask("Rp. 999.999.999,99", { "numericInput": false }).mask("input[name='modal-grouper-cc']");
Inputmask("Rp. 999.999.999,99", { "numericInput": false }).mask("input[name='modal-grouper-alkes']");
Inputmask("Rp. 999.999.999,99", { "numericInput": false }).mask("input[name='modal-grouper-bmhp']");
Inputmask("Rp. 999.999.999,99", { "numericInput": false }).mask("input[name='modal-grouper-sewa']");
Inputmask("Rp. 999.999.999,99", { "numericInput": false }).mask("input[name='modal-grouper-poliesekutif']");


function getdata(btn){
    var mr         = btn.attr("data-mr");
    var name       = btn.attr("data-name");
    var nopeserta  = btn.attr("data-nopeserta");
    var nosep      = btn.attr("data-nosep");
    var sex        = btn.attr("data-sex");
    var address    = btn.attr("data-address");
    var norawat    = btn.attr("data-norawat");
    var tanggal    = btn.attr("data-tanggal");
    var jamreg     = btn.attr("data-jamreg");
    var type       = btn.attr("data-type");
    var poliklinik = btn.attr("data-poliklinik");
    var dokter     = btn.attr("data-dokter");
    var provider   = btn.attr("data-provider");

    var nonbedah     = btn.attr("data-nonbedah");
    var bedah        = btn.attr("data-bedah");
    var konsultasi   = btn.attr("data-konsultasi");
    var perawat      = btn.attr("data-perawat");
    var rad          = btn.attr("data-rad");
    var lab          = btn.attr("data-lab");
    var obat         = btn.attr("data-obat");
    var obatkronis   = btn.attr("data-obatkronis");
    var obatkemo     = btn.attr("data-obatkemo");
    var rehab        = btn.attr("data-rehab");
    var kamar        = btn.attr("data-kamar");
    var bmhp         = btn.attr("data-bmhp");
    var sewa         = btn.attr("data-sewa");

    $("input[name='modal-grouper-mr']").val(mr);
    $("input[name='modal-grouper-name']").val(name);
    $("input[name='modal-grouper-sex']").val(sex);
    $("input[name='modal-grouper-address']").val(address);

    $("input[name='modal-grouper-norawat']").val(norawat);
    $("input[name='modal-grouper-tanggal']").val(tanggal+" "+jamreg);
    $("input[name='modal-grouper-type']").val(type);
    $("input[name='modal-grouper-poliklinik']").val(poliklinik);
    $("input[name='modal-grouper-dokter']").val(dokter);
    $("input[name='modal-grouper-provider']").val(provider);
    $("input[name='modal-grouper-peserta']").val(nopeserta);
    $("input[name='modal-grouper-nosep']").val(nosep === "null" ? "" : nosep);

    $("input[name='modal-grouper-nonbedah']").val(todesimal(nonbedah));
    $("input[name='modal-grouper-bedah']").val(todesimal(bedah));
    $("input[name='modal-grouper-konsultasi']").val(todesimal(konsultasi));
    $("input[name='modal-grouper-perawat']").val(todesimal(perawat));
    $("input[name='modal-grouper-rad']").val(todesimal(rad));
    $("input[name='modal-grouper-lab']").val(todesimal(lab));
    $("input[name='modal-grouper-obat']").val(todesimal(obat));
    $("input[name='modal-grouper-obatkronis']").val(todesimal(obatkronis));
    $("input[name='modal-grouper-obatkemo']").val(todesimal(obatkemo));
    $("input[name='modal-grouper-rehab']").val(todesimal(rehab));
    $("input[name='modal-grouper-kamar']").val(todesimal(kamar));
    $("input[name='modal-grouper-bmhp']").val(todesimal(bmhp));
    $("input[name='modal-grouper-sewa']").val(todesimal(sewa));


    kelas(type);
};

function kelas(type){
	$.ajax({
		url     : url+"index.php/inacbg/grouper/kelasperawatan",
		data    : {type:type},
		method  : "POST",
		dataType: "html",
		cache   : false,
		success : function (data) {
			$("select[name='modal-grouper-kelas']").html(data);

            
		}
	});
	return false;
};

function listkunjungan(){
    $.ajax({
        url        : url+"index.php/inacbg/grouper/listkunjungan",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultgrouper").html("");
        },
        success:function(data){
            toastr.clear();
            var result              = "";
            var tableresult         = "";
            var getvariabel         = "";
            var color               = ['danger','warning','success','primary'];
            var jml                 = 0;

            if(data.responCode==="00"){
                result        = data.responResult;
                for(var i in result){

                    getvariabel =   "data-mr='"+result[i].no_rkm_medis+"'"+
                                    "data-name='"+result[i].namapasien+"'"+
                                    "data-nopeserta='"+result[i].no_peserta+"'"+
                                    "data-nosep='"+result[i].nosep+"'"+
                                    "data-sex='"+result[i].jk+"'"+
                                    "data-address='"+result[i].alamat+"'"+
                                    "data-norawat='"+result[i].no_rawat+"'"+
                                    "data-tanggal='"+result[i].tgl_registrasi+"'"+
                                    "data-jamreg='"+result[i].jam_reg+"'"+
                                    "data-type='"+result[i].status_lanjut+"'"+
                                    "data-poliklinik='"+result[i].politujuan+"'"+
                                    "data-dokter='"+result[i].namadokter+"'"+
                                    "data-provider='"+result[i].provider+"'"+

                                    "data-nonbedah='"+result[i].prosedurnonbedah+"'"+
                                    "data-bedah='"+result[i].prosedurbedah+"'"+
                                    "data-konsultasi='"+result[i].konsultasi+"'"+
                                    "data-perawat='"+result[i].keperawatan+"'"+
                                    "data-rad='"+result[i].rad+"'"+
                                    "data-lab='"+result[i].lab+"'"+
                                    "data-obat='"+result[i].obat+"'"+
                                    "data-obatkronis='"+result[i].obatkronis+"'"+
                                    "data-obatkemo='"+result[i].obatkemo+"'"+
                                    "data-rehab='"+result[i].rehabmedik+"'"+
                                    "data-kamar='"+result[i].kamar+"'"+
                                    "data-bmhp='"+result[i].bmhp+"'"+
                                    "data-sewa='"+result[i].sewaalat+"'";


                    var randomIndex = Math.floor(Math.random() * color.length);
                    var randomColor = color[randomIndex];

                    tableresult +="<tr>";
                    tableresult +="<td>";
                        tableresult +="<div class=' align-middle d-flex align-items-center ps-4'>";
                            tableresult +="<div class='symbol symbol-circle symbol-50px overflow-hidden me-3'>";
                                tableresult +="<a href='#'>";
                                    tableresult +="<div class='symbol-label fs-3 bg-light-"+randomColor+" text-"+randomColor+"'>"+result[i].initialpasien+"</div>";
                                tableresult +="</a>";
                            tableresult +="</div>";

                            tableresult +="<div class='d-flex flex-column'>";
                                tableresult +="<a class='text-gray-800 text-hover-primary mb-1' href='#' data-bs-toggle='modal' data-bs-target='#modal-grouper' "+getvariabel+" onclick='getdata($(this));'>"+result[i].namapasien+"</a>";
                                tableresult +="<span>"+(result[i].no_rawat ? result[i].no_rawat : "-")+"</span>";
                            tableresult +="</div>";

                        tableresult +="</div>";
                    tableresult +="</td>";
                   
                    tableresult +="<td><div>"+(result[i].no_rkm_medis ? result[i].no_rkm_medis : "")+"</div><div>" + (result[i].noktp ? result[i].noktp : "") + "</div></td>";
                    tableresult +="<td><div>"+(result[i].namadokter ? result[i].namadokter : "")+"</div><div>" + (result[i].politujuan ? result[i].politujuan : "") + "</div></td>";
                    tableresult +="<td>"+(result[i].provider ? result[i].provider : "")+"</td>";
                    tableresult +="<td>"+(result[i].status_lanjut ? result[i].status_lanjut : "")+"</td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                tableresult += "<a class='dropdown-item btn btn-sm' data-bs-toggle='modal' data-bs-target='#modal-grouper' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-pencil'></i> Grouping</a>";
                                tableresult += "<a class='dropdown-item btn btn-sm' data-kt-drawer-show='true' data-kt-drawer-target='#drawer_employee_registrationposition_add' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-person-add'></i> Positioning</a>";
                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</td>";
                    tableresult +="</tr>";

                    jml ++;
                }
            }

            $("#resultgrouper").html(tableresult);
            $("#info_list_grouper").html(todesimal(jml)+" Transaction");
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {

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
                customClass      : {
                    confirmButton: "btn btn-danger"
                },
                showClass: {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass: {popup: "animate__animated animate__fadeOutDown animate__faster"}
            });
		}
    });
    return false;
};