datarepository();

$('#modal_sign_add').on('show.bs.modal', function (e) {
    masterassign();
});

$('#modal_upload_document').on('hidden.bs.modal', function (e) {
    if (Dropzone.instances.length > 0) {
        Dropzone.instances.forEach(dz => dz.destroy());
    }
    Dropzone.autoDiscover = false;
});

function masterassign() {
    $.ajax({
        url     : url + "index.php/tilakaV2/repodocument/masterassign",
        method  : "POST",
        dataType: "JSON",
        cache   : false,
        beforeSend: function () {
            // Optional: Show loading indicators if needed
        },
        success: function(data) {
            if (data.responCode === "00") {
                var result = data.responResult;
                var inputElement = document.querySelector('[name="modal_sign_add_assign"]');
                
                // Clear the input field value
                inputElement.value = '';

                // Format the names and nik into one string for Tagify
                var whitelist = result.map(function(item) {
                    return item.name + ' - ' + item.nik;  // Combine name and nik
                });

                // Initialize Tagify with formatted whitelist
                var tagify = new Tagify(inputElement, {
                    whitelist: whitelist,  // Use the formatted names and nik
                    maxTags: 10,
                    dropdown: {
                        maxItems: 10,
                        enabled: 0,
                        closeOnSelect: true
                    }
                });

                // If there's an existing value, add it as a tag
                if (inputElement.value) {
                    tagify.addTags(inputElement.value);
                }
            }
        },
        error: function(xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : " + error, "Opps !");
        },
        complete: function () {
            toastr.clear(); // Clear any toastr notifications when the request completes
        }
    });
    return false;
};

function uploadfile(btn){
    var nofile  = $(btn).attr("data_nofile");
    var transid = $(btn).attr("data_transid");

    var myDropzone = new Dropzone("#file_doc", {
        url             : url + "index.php/tilakaV2/repodocument/uploadfile?nofile="+nofile+"&transid="+transid,
        acceptedFiles   : '.PDF',
        paramName       : "file",
        dictDefaultMessage: "Drop files here or click to upload",
        maxFiles        : 1,
        maxFilesize     : 10,
        addRemoveLinks  : true,
        autoProcessQueue: true,
        accept: function(file, done) {
            done();
        }
    });

    myDropzone.on("success", function(file, response) {
        datarepository(); 
        $('#modal_upload_document').modal('hide');
    });
};

function datarepository(){
    $.ajax({
        url     : url+"index.php/tilakaV2/repodocument/datarepository",
        method  : "POST",
        dataType: "JSON",
        cache   : false,
        beforeSend: function () {
            $("#resultrepodocument").html("");
            $("#info_list_document").html("");
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";
            var jml = 0;

            if(data.responCode==="00"){
                result = data.responResult;

                for(var i in result){
                    tableresult +="<tr>";

                    if(result[i].status==="0"){
                        tableresult +="<td class='ps-4'><div><span class='badge badge-light-info fs-7 fw-bold'>New Document</span></div><div class='fst-italic small'>Waiting Document Upload DTechnology</div></td>"; 
                    }

                    if(result[i].status==="1"){
                        tableresult +="<td class='ps-4'><div><span class='badge badge-light-success fs-7 fw-bold'>Upload File Success</span></div><div class='fst-italic small'>Waiting Document Upload Tilaka Lite</div></td>"; 
                    }

                    tableresult +="<td><div>"+(result[i].jenisdocument ? result[i].jenisdocument : "-")+"</div><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_upload_document' data_transid='"+result[i].trans_id+"' data_nofile='"+result[i].no_file+"' onclick='uploadfile(this)'>"+(result[i].no_file ? result[i].no_file : "-")+"</a></div><div>"+(result[i].filename ? result[i].filename : "-")+"</div></td>";
                    tableresult +="<td><div>"+(result[i].note_1 ? result[i].note_1 : "-")+"</div><div>"+(result[i].note_2 ? result[i].note_2 : "-")+"</div></td>";
                    
                    var assign = result[i].assign ? result[i].assign.split(';') : [];
                    tableresult += "<td>";
                    for (var j = 0; j < assign.length; j++) {
                        tableresult +="<div>"+assign[j]+"</div>";
                    }
                    tableresult += "</td>";

                    tableresult +="<td><div>"+(result[i].createdby ? result[i].createdby : "")+"</div><div>"+(result[i].tgljam ? result[i].tgljam : "")+"</div></td>";
                    tableresult += "</tr>";

                    jml ++;
                }
            }

            $("#resultrepodocument").html(tableresult);
            $("#info_list_document").html(jml+" Document");

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

$(document).on("submit", "#formsigndocument", function (e) {
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
			$("#btn_sign_document").addClass("disabled");
        },
		success: function (data) {
            if(data.responCode == "00"){
                datarepository();
                $('#modal_sign_add').modal('hide');
			}

            toastr.clear();
			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#btn_sign_document").removeClass("disabled");
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