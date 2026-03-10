datatransaksi();

function viewdoc(btn) {
    var filename = $(btn).attr("data-dirfile");
        filename = filename.replace('/www/wwwroot/', 'http://');

    // Menggunakan AJAX dengan metode GET untuk memeriksa apakah file ada
    jQuery.ajax({
        url: url+filename,
        type: 'GET',
        async: false,
        success: function(data, textStatus, jqXHR) {
            var viewfile = "<embed src='" +url+filename + "' width='100%' height='100%' type='application/pdf' id='view'>";
            $("#viewdoc").html(viewfile);
            
            $('#openInNewTabButton').data('filename', filename);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            var viewfile = `
                <div class='alert alert-dismissible bg-light-info border border-info border-3 border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10 fa-fade'>
                    <span class='svg-icon svg-icon-2hx svg-icon-info me-4 mb-5 mb-sm-0'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                            <path opacity='0.3' d='M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z' fill='black'></path>
                            <path d='M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z' fill='black'></path>
                        </svg>
                    </span>
                    <div class='d-flex flex-column pe-0 pe-sm-10'>
                        <h5 class='mb-1'>For Your Information</h5>
                        <span>File Tidak Di Temukan, Silakan Periksa Kembali</span>
                    </div>
                </div>
            `;
            $("#viewdoc").html(viewfile);
            $('#openInNewTabButton').data('filename', '');
        }
    });
}

function datatransaksi(){
    $.ajax({
        url       : url+"index.php/casemix/attachmentclaim/datatransaksi",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultattachmentclaimrj").html("");
        },
        success:function(data){
            let tableresult;

            if(data.responCode==="00"){
                let result        = data.responResult;
                for(var i in result){
                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'><a href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+"assets/mergedocument/"+(result[i].no_rkm_medis ? result[i].no_rkm_medis : "")+"_"+(result[i].no_rawat ? result[i].no_rawat.replace(/\//g, "-") : "")+".pdf' onclick='viewdoc(this)'>"+result[i].no_rawat+"</a></td>";
                    tableresult += "<td>"+result[i].tglkunjungan+"</td>";
                    tableresult += "<td>"+result[i].no_rkm_medis+"</td>";
                    tableresult += "<td>"+result[i].namapasien+"</td>";
                    tableresult += "<td>"+result[i].namadokter+"</td>";
                    tableresult += "<td>"+result[i].politujuan+"</td>";
                    tableresult += "<td class='text-end pe-4'></td>";
                    tableresult += "</tr>";
                }
            }

            $("#resultattachmentclaimrj").html(tableresult);

            toastr.clear();
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