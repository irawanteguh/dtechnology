dataexecutesign();

// setInterval(() => {
//     dataexecutesign();
// }, 10000);

function dataexecutesign(){
    $.ajax({
        url     : url+"index.php/tilaka/signdocument/dataexecutesign",
        method  : "POST",
        dataType: "JSON",
        cache   : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultsigndocument").html("");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";
            var btnnote = "";
            
            if(data.responCode==="00"){
                result        = data.responResult;
                for(var i in result){

                    btnnote = "<button type='button' class='btn btn-sm btn-icon btn-light btn-active-light-primary toggle me-4' data-kt-table-widget-4='expand_row'>";
                    btnnote += "<i class='bi bi-plus fs-4 m-0 toggle-off'></i>";
                    btnnote += "<i class='bi bi-dash fs-4 m-0 toggle-on'></i>";
                    btnnote += "</button>";

                    tableresult +="<tr>";
                    if(result[i].STATUS_SIGN==="2"){
                        tableresult +="<td class='ps-4'><div class='badge badge-light-warning fw-bolder'>Request Sign</div></td>";
                    }else{
                        tableresult +="<td class='ps-4'><div class='badge badge-light-info fw-bolder'>Request Execute File</div></td>";  
                    }
                    tableresult +="<td>"+(result[i].USER_IDENTIFIER ? result[i].USER_IDENTIFIER : "")+"</td>";
                    tableresult +="<td>"+(result[i].name ? result[i].name : "")+"</td>";
                    tableresult +="<td><div>"+(result[i].nik ? result[i].nik : "")+"</div><div>"+(result[i].noktp ? result[i].noktp : "")+"</div></td>";
                    tableresult +="<td>"+(result[i].email ? result[i].email : "")+"</td>";

                    if(result[i].STATUS_SIGN==="2"){
                        tableresult +="<td class='text-end'>"+btnnote+"<a class='btn btn-sm btn-light-primary' href='"+result[i].URL+"&redirect_url="+url+"index.php/tilaka/signdocument'>Sign</a></td>";
                    }else{
                        tableresult +="<td>"+btnnote+"</td>";
                    }
                    tableresult +="</tr>";

                    tableresult += "<tr class='d-none'>";
                    tableresult += "<td colspan='7'>";
                    tableresult += "<div class='row col-md-12'>";
                    tableresult += "<h6>Response</h6>";
                    tableresult += "<textarea data-kt-autosize='true' class='form-control form-control-solid' readonly>" + (result[i].REQUEST_ID ? result[i].REQUEST_ID : "") + "</textarea>";
                    tableresult += "</div>";
                    tableresult += "</td>";
                    tableresult += "</tr>";
                }
            }

            $("#resultsigndocument").html(tableresult);

            document.querySelectorAll("[data-kt-table-widget-4='expand_row']").forEach(button => {
                button.addEventListener('click', function() {
                    const tr = this.closest('tr');
                    const nextTr = tr.nextElementSibling;
                    const isExpanded = !nextTr.classList.contains('d-none');
            
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