masterapps();

$(document).on("click",".btn-hapusmastermodules", function(e){            
    e.preventDefault();
    e.stopPropagation();
    getdata($(this));
});

$(document).on("click",".btn-editmastermodules", function(e){            
    e.preventDefault();
    e.stopPropagation();
    getdata($(this));
});

function getdata(btn){
    var modulesid          = btn.attr("data-modulesid");
    var modulesname        = btn.attr("data-modulesname");
    var modulesversion     = btn.attr("data-modulesversion");
    var modulesicon        = btn.attr("data-modulesicon");
    var modulespackage     = btn.attr("data-modulespackage");
    var modulesparent      = btn.attr("data-modulesparent");
    var modulesstatus      = btn.attr("data-modulesstatus");
    var modulesheader      = btn.attr("data-modulesheader");
    var modulescontrollers = btn.attr("data-modulescontrollers");

    $(":hidden[name='modulesid-hapus']").val(modulesid);
    $(":hidden[name='modulesid-edit']").val(modulesid);

    $(":text[name='modulesname-hapus']").val(modulesname);
    $(":text[name='modulesname-edit']").val(modulesname);

    if(modulesversion==="null"){
        $(":text[name='modulesversion-hapus']").val("");
        $(":text[name='modulesversion-edit']").val("");
    }else{
        $(":text[name='modulesversion-hapus']").val(modulesversion);
        $(":text[name='modulesversion-edit']").val(modulesversion);
    }

    if(modulesicon==="null"){
        $(":text[name='modulesicon-hapus']").val("");
        $(":text[name='modulesicon-edit']").val("");
    }else{
        $(":text[name='modulesicon-hapus']").val(modulesicon);
        $(":text[name='modulesicon-edit']").val(modulesicon);
    }

    if(modulespackage==="null"){
        $(":text[name='modulespackage-hapus']").val("");
        $(":text[name='modulespackage-edit']").val("");
    }else{
        $(":text[name='modulespackage-hapus']").val(modulespackage);
        $(":text[name='modulespackage-edit']").val(modulespackage);
    }

    if(modulescontrollers==="null"){
        $(":text[name='modulescontrollers-hapus']").val("");
        $(":text[name='modulescontrollers-edit']").val("");
    }else{
        $(":text[name='modulescontrollers-hapus']").val(modulescontrollers);
        $(":text[name='modulescontrollers-edit']").val(modulescontrollers);
    }
    
    $("#modulesheader-edit option:contains("+modulesheader+")").attr('selected', true);
    $("#modulesstatus-edit option:contains("+modulesstatus+")").attr('selected', true);
    $("#modulesparent-edit option:contains("+modulesparent+")").attr('selected', true);
};

function masterapps(){
    $.ajax({
        url:url+"mastersystem/mastermodules/masterapps",
        method:"GET",
        dataType:"JSON",
        cache :false,
        beforeSend: function () {
            toastr["info"]("Sending request...", "Please wait");
            $("#resultmastermodules > tr").remove();
        },
        success:function(data){
            var result      = "";
            var getvariabel = "";
            var dataresult  = "";
            var action      = "";
            var version     = "";
            
            if(data.responCode == "00"){
                result        = data.responResult;

                for(var i in result){
                    
                    getvariabel =   "data-modulesid='"+result[i].MODULES_ID+"'"+
                                    "data-modulesname='"+result[i].MODULES_NAME+"'"+
                                    "data-modulesversion='"+result[i].MODULES_VERSION+"'"+
                                    "data-modulesicon='"+result[i].ICON+"'"+
                                    "data-modulespackage='"+result[i].PACKAGE+"'"+
                                    "data-modulesparent='"+result[i].PARENT+"'"+
                                    "data-modulesstatus='"+result[i].STATUS+"'"+
                                    "data-modulesheader='"+result[i].MODULESHEADER+"'"+
                                    "data-modulescontrollers='"+result[i].DEF_CONTROLLER+"'";

                    action ="<a class='btn btn-xs btn-outline-danger m-1 btn-hapusmastermodules' data-toggle='modal' data-target='#hapusmodules' role='button' "+getvariabel+"><i class='fa-solid fa-trash-can'></i></a>";
                    action +="<a class='btn btn-xs btn-outline-primary m-1 btn-editmastermodules' data-toggle='modal' data-target='#editmodules' role='button' "+getvariabel+"><i class='fa-solid fa-pen-to-square'></i></a>";

                    if(result[i].MODULES_VERSION!=null){
                        version =" <span class='badge bg-primary'>"+result[i].MODULES_VERSION+"</span>";
                    }else{
                        version ="";
                    }
                    dataresult +="<tr>";
                    dataresult +="<td class='align-middle'>"+action+"</td>";
                    if(result[i].STATUS==="DEVELOPMENT"){
                        dataresult +="<td class='text-center align-middle'><span class='badge bg-primary'>DEV</span></td>";
                    }else{
                        if(result[i].STATUS==="STAGING"){
                            dataresult +="<td class='text-center align-middle'><span class='badge bg-warning'>STAGING</span></td>";
                        }else{
                            dataresult +="<td class='text-center align-middle'><span class='badge bg-success'>PROD</span></td>";
                        }
                    }
                    
                    dataresult +="<td class='text-center align-middle'>"+result[i].MODULES_ID+"</td>";
                    dataresult +="<td class='align-middle'>"+result[i].MODULES_NAME+version+"</td>";
                    
                    if(result[i].PACKAGE!=null){
                        dataresult +="<td class='align-middle'>"+result[i].PACKAGE+"</td>";
                    }else{
                        dataresult +="<td class='align-middle'></td>";
                    }
                    if(result[i].DEF_CONTROLLER!=null){
                        dataresult +="<td class='align-middle'>"+result[i].DEF_CONTROLLER+"</td>";
                    }else{
                        dataresult +="<td class='align-middle'></td>";
                    }

                    dataresult +="</tr>";
                }
            }

            $("#resultmastermodules").html(dataresult);
			toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        error: function(xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		},
		complete: function () {
			toastr.clear();
		}
    });
    return false;
};

$(document).on("submit", "#formtambahmastermodules", function (e) {
	e.preventDefault();
    e.stopPropagation();
	var form = $(this),url  = $(this).attr("action");
	$.ajax({
        url: url,
		data: form.serialize(),
		method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            toastr["info"]("Sending request...", "Please wait");
			$("btn-modules-tambah").addClass("disabled");
        },
		success: function (data) {
            if (data.responCode == "00") {
                masterapps();
                $("#tambahmodules").modal("hide");
			}
			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        error: function(xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		},
        complete: function () {
			toastr.clear();
			$("#btn-modules-tambah").removeClass("disabled");
		}
	});
    return false;
});

$(document).on("submit", "#formeditmastermodules", function (e) {
	e.preventDefault();
    e.stopPropagation();
	var form = $(this),url  = $(this).attr("action");
	$.ajax({
        url: url,
		data: form.serialize(),
		method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            toastr["info"]("Sending request...", "Please wait");
			$("#btn-modules-edit").addClass("disabled");
        },
		success: function (data) {
            if (data.responCode == "00") {
                masterapps();
                $("#editmodules").modal("hide");
			}
			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        error: function(xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		},
		complete: function () {
			toastr.clear();
			$("#btn-modules-edit").removeClass("disabled");
		}
	});
    return false;
});

$(document).on("submit", "#formhapusmastermodules", function (e) {
	e.preventDefault();
    e.stopPropagation();
	var form = $(this),url  = $(this).attr("action");
	$.ajax({
        url: url,
		data: form.serialize(),
		method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            toastr["info"]("Sending request...", "Please wait");
			$("#btn-modules-hapus").addClass("disabled");
        },
		success: function (data) {
            if (data.responCode == "00") {
                masterapps();
                $("#hapusmodules").modal("hide");
			}
			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        error: function(xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		},
		complete: function () {
			toastr.clear();
			$("#btn-modules-hapus").removeClass("disabled");
		}
	});
    return false;
});

$('#tambahmodules').on('hidden.bs.modal', function () {
    $(":text[name='modulesname-tambah']").val('');
    $(":text[name='modulesversion-tambah']").val('');
    $(":text[name='modulespackage-tambah']").val('');
    $(":text[name='modulescontrollers-tambah']").val('');
});