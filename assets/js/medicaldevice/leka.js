listexamination();

function getdata(btn){
    toastr.clear();

    var transaksiid = btn.attr("data_transaksiid");
    var name        = btn.attr("data_name");
    var gender      = btn.attr("data_gender");
    var bod         = btn.attr("data_bod");
    var address     = btn.attr("data_address");
    var examination = btn.attr("data_examination");
    var encounterid = btn.attr("data_ecounterid");
    var deviceid    = btn.attr("data_deviceid");
    var idnumber    = btn.attr("data_idnumber");
    var age         = btn.attr("data_age");
    var nation      = btn.attr("data_nation");
    var photo       = btn.attr("data_photo");
    

    $(":hidden[name='data_leka_transid_edit']").val(transaksiid);

    $("input[name='data_leka_name_edit']").val(name);
    $("input[name='data_leka_gender_edit']").val(gender);
    $("input[name='data_leka_bod_edit']").val(bod);
    $("input[name='data_leka_address_edit']").val(address);
    $("input[name='data_leka_examination_edit']").val(examination);

    $("#transaksiid").html("");
    $("#encounterid").html("");
    $("#deviceid").html("");
    $("#examid").html("");
    $("#idnumber").html("");
    $("#patientname").html("");
    $("#sex").html("");
    $("#bod").html("");
    $("#age").html("");
    $("#nation").html("");
    $("#address").html("");

    $("#transaksiid").html(transaksiid);
    $("#encounterid").html(encounterid);
    $("#deviceid").html(deviceid);
    $("#examid").html(examination);
    $("#idnumber").html(idnumber);
    $("#patientname").html(name);
    $("#sex").html(gender);
    $("#bod").html(bod);
    $("#age").html(age);
    $("#nation").html(nation);
    $("#address").html(address);

    if (photo) {
        $("#photopatient").attr("src", "data:image/jpeg;base64," + photo).attr("alt", name);
    } else {
        $("#photopatient").attr("src", "").attr("alt", "No Photo Available");
    }

    result(transaksiid);
};

function decryptPhoto(encodedPhoto) {
    var decryptedPhoto = atob(encodedPhoto);
    return decryptedPhoto;
}

function listexamination(){
    $.ajax({
        url        : url+"index.php/medicaldevice/leka/listexamination",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultexamination").html("");
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

                    var decryptedPhoto = decryptPhoto(result[i].photo);


                    var getvariabel = "data_transaksiid='"+result[i].transaksi_id+"'"+
                                      "data_name='"+result[i].name+"'"+
                                      "data_gender='"+result[i].sex+"'"+
                                      "data_bod='"+result[i].bod+"'"+
                                      "data_address='"+result[i].address+"'"+
                                      "data_examination='"+result[i].exam_id+"'"+
                                      "data_ecounterid='"+result[i].encounter_id+"'"+
                                      "data_deviceid='"+result[i].device_id+"'"+
                                      "data_idnumber='"+result[i].id_number+"'"+
                                      "data_age='"+result[i].age+"'"+
                                      "data_nation='"+result[i].nation+"'"+
                                      "data_photo='"+decryptedPhoto+"'";

                    tableresult +="<tr>";
                    tableresult +="<td>";
                        tableresult +="<div class=' align-middle d-flex align-items-center ps-4'>";
                            tableresult +="<div class='symbol symbol-circle symbol-50px overflow-hidden me-3'>";
                                tableresult +="<a href='#'>";
                                    tableresult +="<div class='symbol-label'>";
                                    tableresult += "<img src='data:image/jpeg;base64," + decryptedPhoto + "' alt='" + result[i].name + "' class='w-100'>";
                                    tableresult +="</div>";
                                tableresult +="</a>";
                            tableresult +="</div>";

                            tableresult +="<div class='d-flex flex-column'>";
                                tableresult +="<a class='text-gray-800 text-hover-primary mb-1' href='#'>"+result[i].name+"</a>";
                                tableresult +="<span>"+(result[i].id_number ? result[i].id_number : "-")+"</span>";
                            tableresult +="</div>";

                        tableresult +="</div>";
                    tableresult +="</td>";

                    tableresult +="<td>"+(result[i].exam_id ? result[i].exam_id : "")+"</td>";
                    tableresult +="<td>"+(result[i].bod ? result[i].bod : "")+"</td>";
                    tableresult +="<td>"+(result[i].sex ? result[i].sex : "")+"</td>";
                    tableresult +="<td>"+(result[i].nation ? result[i].nation : "")+"</td>";
                    tableresult +="<td>"+(result[i].address ? result[i].address : "")+"</td>";
                    tableresult +="<td>"+(result[i].encounter_id ? result[i].encounter_id : "")+"</td>";
                    
                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                tableresult += "<a class='dropdown-item btn btn-sm' data-bs-toggle='modal' data-bs-target='#modal_leka_result' "+getvariabel+" onclick='getdata($(this));'><i class='fa-regular fa-file-pdf'></i> Result</a>";

                                if(result[i].encounter_id!=null){
                                    tableresult += "<a class='dropdown-item btn btn-sm' "+getvariabel+" onclick='Sendsatusehat($(this));'><i class='bi bi-person-add'></i> Send SATUSEHAT</a>";
                                }else{
                                    tableresult += "<a class='dropdown-item btn btn-sm' data-bs-toggle='modal' data-bs-target='#modal_leka_edit' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-pencil'></i> Encounter</a>";
                                }
                                
                                // tableresult += "<a class='dropdown-item btn btn-sm' onclick='getJSON($(this));'><i class='fa-solid fa-file-code'></i> Download File NON FHIR</a>";
                                // tableresult += "<a class='dropdown-item btn btn-sm' "+getvariabel+" onclick='getdata($(this));'><i class='fa-solid fa-file-code'></i> Download FHIR .json</a>";
                                // tableresult += "<a class='dropdown-item btn btn-sm' "+getvariabel+" onclick='getdata($(this));'><i class='fa-solid fa-file-code'></i> Download FHIR .txt</a>";
                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</td>";

                    tableresult +="</tr>";

                    jml ++;
                }
            }

            $("#resultexamination").html(tableresult);
            $("#info_list_examination").html(todesimal(jml)+" Examination");
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
                customClass      : {confirmButton: "btn btn-danger"},
                showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
            });
		}
    });
    return false;
};

function result(transid){
    $.ajax({
        url        : url+"index.php/medicaldevice/leka/result",
        data       : {transid:transid},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultleka").html("");
        },
        success:function(data){
            toastr.clear();
            var tableresult = "";

            if(data.responCode === "00"){
                var result = data.responResult;

                function generateChildElements(parentId) {
                    var childElements = "";
                    for (var j in result) {
                        if (result[j].header_id === parentId) {
                            
                            var resultvalue = result[j].resultdata.split(';');

                            childElements += "<tr>";
                            childElements += "<td class='ps-10'>- "+result[j].examination+"</td>";
                            childElements += "<td class='text-center'>"+result[j].unit+"</td>";
                            if(result[j].header_id==="012"){
                                if(result[j].id==="001"){
                                    childElements += "<td colspan='3'><img src='data:image/jpeg;base64," + resultvalue[0] + "' style='height:100%; width:90%;'></td>";
                                    // childElements += "<td colspan='3'></td>";
                                }else{
                                    if(result[j].id==="002"){
                                        childElements += "<td class='text-start'>"+resultvalue[0]+"</td>";
                                    }else{
                                        childElements += "<td class='text-center'>"+resultvalue[0]+"</td>";
                                    }
                                }
                            }else{
                                if(result[j].header_id==="013"){
                                    if(result[j].id==="001"){
                                        childElements += "<td colspan='3'><img src='data:image/jpeg;base64," + decryptPhoto(resultvalue[0]) + "' style='height:100%; width:90%;'></td>";
                                        // childElements += "<td colspan='3'></td>";
                                    }else{
                                        childElements += "<td class='text-center'>"+resultvalue[0]+"</td>";
                                    }
                                }else{
                                    childElements += "<td class='text-center'>"+resultvalue[0]+"</td>";
                                }
                            }
                            
                            if (
                                (result[j].id === "001" && result[j].header_id === "012") ||
                                (result[j].id === "002" && result[j].header_id === "012") ||
                                (result[j].id === "001" && result[j].header_id === "013")
                            ) {

                            } else {
                                childElements += "<td class='text-center'>" + resultvalue[1] + "</td>";
                                childElements += "<td class='pe-4 text-end'>" + resultvalue[2] + "</td>";
                            }
                                                    
                            
                            childElements += "</tr>";
                        }
                    }
                    return childElements;
                }

                for (var i in result) {
                    if (result[i].jenis === 'H') {
                        tableresult += "<tr>";
                        tableresult += "<td class='ps-4' colspan='5'><strong>"+result[i].examination+"</strong></td>";
                        tableresult += "</tr>";
                        tableresult += generateChildElements(result[i].id);
                    }
                }
            }

            $("#resultleka").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {

        },
        error: function(xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>" + error + "</b>",
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
}

function Sendsatusehat(btn){
    var transaksiid = btn.attr("data_transaksiid");
    $.ajax({
        url        : url+"index.php/medicaldevice/leka/Sendsatusehat",
        data       : {transaksiid:transaksiid},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success:function(data){
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {

        },
        error: function(xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>" + error + "</b>",
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
}

function printPDF() {
    var printContents = document.querySelector('#modal_leka_result .modal-body').innerHTML;
    var printWindow = window.open('', '', 'height=700,width=900');
    printWindow.document.write('<html>');
        printWindow.document.write('<head>');
            printWindow.document.write('<title>Result Examination</title>');
            printWindow.document.write('<style>');
                printWindow.document.write('body { font-size: 10px; font-family: Arial, sans-serif; }'); // Mengatur ukuran font di seluruh halaman
                printWindow.document.write('table, th, td {border: 1px solid black; border-collapse: collapse;}');
                printWindow.document.write('th, td { padding: 5px; }'); // Menambahkan padding pada tabel
                
                printWindow.document.write('.text-center { text-align: center; }');
                printWindow.document.write('.mb-5 { margin-bottom: 3rem; }');
                printWindow.document.write('.mb-3 { margin-bottom: 1rem; }');
                printWindow.document.write('.fw-bold { font-weight: bold; }');
                printWindow.document.write('.d-flex { display: flex; }');

                printWindow.document.write('.justify-content-center { justify-content: center; }');
                printWindow.document.write('.justify-content-between { justify-content: space-between; }');

                printWindow.document.write('.col-xl-12 { width: 100%; }');
                printWindow.document.write('.col-xl-5 { width: 41.666667%; }');
                printWindow.document.write('.col-xl-2 { width: 16.666667%; }');
                printWindow.document.write('.row { display: flex; flex-wrap: wrap; margin: 0 -15px; }');
                
            printWindow.document.write('</style>');
        printWindow.document.write('</head>');
        printWindow.document.write('<body>');
            printWindow.document.write(printContents);
        printWindow.document.write('</body>');
    printWindow.document.write('</html>'); // Perbaiki penutupan HTML
    printWindow.document.close();
    printWindow.print();
}


// function printPDF() {
//     // Get the contents of the modal
//     var printContents = document.querySelector('#modal_leka_result .modal-body').innerHTML;
    
//     // Open a new window
//     var printWindow = window.open('', '', 'height=700,width=900');
    
//     // Write the contents to the new window
//     printWindow.document.write('<html><head><title>Result Examination</title>');
//     printWindow.document.write('<style>');
//     printWindow.document.write('body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }');
//     printWindow.document.write('.text-center { text-align: center; }');
//     printWindow.document.write('.mb-5 { margin-bottom: 3rem; }');
//     printWindow.document.write('.mb-3 { margin-bottom: 1rem; }');
//     printWindow.document.write('.text-muted { color: #6c757d; }');
//     printWindow.document.write('.fw-bold { font-weight: bold; }');
//     printWindow.document.write('.fs-5 { font-size: 1.25rem; }');
//     printWindow.document.write('.d-flex { display: flex; }');
//     printWindow.document.write('.justify-content-center { justify-content: center; }');
//     printWindow.document.write('.justify-content-between { justify-content: space-between; }');
//     printWindow.document.write('.col-xl-10 { width: 83.333333%; }');
//     printWindow.document.write('.col-xl-5 { width: 41.666667%; }');
//     printWindow.document.write('.col-xl-2 { width: 16.666667%; }');
//     printWindow.document.write('.row { display: flex; flex-wrap: wrap; margin: 0 -15px; }');
//     printWindow.document.write('.row > .col-xl-5, .row > .col-xl-2 { padding: 0 15px; }');
//     printWindow.document.write('.table-responsive { display: block; width: 100%; overflow-x: auto; }');
//     printWindow.document.write('.mh-550px { max-height: 550px; }');
//     printWindow.document.write('.scroll-y { overflow-y: auto; }');
//     printWindow.document.write('.me-n5 { margin-right: -3rem; }');
//     printWindow.document.write('.pe-5 { padding-right: 3rem; }');
//     printWindow.document.write('.table { width: 100%; margin-bottom: 1rem; background-color: transparent; }');
//     printWindow.document.write('th, td { padding: 0.75rem; vertical-align: top; border-top: 1px solid #dee2e6; }');
//     printWindow.document.write('thead th { vertical-align: bottom; }');
//     printWindow.document.write('thead { display: table-header-group; }');
//     printWindow.document.write('tfoot { display: table-footer-group; }');
//     printWindow.document.write('tr { page-break-inside: auto; }');
//     printWindow.document.write('table, th, td { border: 1px solid black; border-collapse: collapse; }');
//     printWindow.document.write('thead th { background-color: #f8f9fa; }');
//     printWindow.document.write('.rounded-start { border-radius: 0.375rem 0 0 0.375rem; }');
//     printWindow.document.write('.rounded-end { border-radius: 0 0.375rem 0.375rem 0; }');
//     printWindow.document.write('.w-500px { width: 500px; }');
//     printWindow.document.write('.text-end { text-align: end; }');
//     printWindow.document.write('</style>');
//     printWindow.document.write('</head><body>');
//     printWindow.document.write(printContents);
//     printWindow.document.write('</body></html>');
    
//     // Close the document and call the print method
//     printWindow.document.close();
//     printWindow.print();
// }


$(document).on("submit", "#formeditencounter", function (e) {
	e.preventDefault();
	var data = new  FormData(this);
	$.ajax({
        url        : url+'index.php/medicaldevice/leka/updateencounter',
        data       : data,
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: false,
        contentType: false,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
			$("#btn_encounter_edit").addClass("disabled");
        },
		success: function (data) {
            toastr.clear();
			if(data.responCode === "00"){
                toastr[data.responHead](data.responDesc, "INFORMATION");
                $("#modal_leka_edit").modal("hide");
				listexamination();
			}else{
                Swal.fire({
                    title            : "<h1 class='font-weight-bold' style='color:#234974;'>For Your Information</h1>",
                    html             : "<b>"+data.responDesc+"</b>",
                    icon             : data.responHead,
                    confirmButtonText: "Please Try Again",
                    buttonsStyling   : false,
                    timerProgressBar : true,
                    timer            : 5000,
                    customClass      : {confirmButton: "btn btn-danger"},
                    showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                    hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                });
                $("#btn_encounter_edit").removeClass("disabled");
            }
		},
        complete: function () {
            toastr.clear();
            $("#btn_encounter_edit").removeClass("disabled");
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