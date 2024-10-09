datalog();

var processs = function (search) {
    var timeout = setTimeout(function () {
        var   rows       = $("#resultlogservice > tr");
        const inputField = element.querySelector("[data-kt-search-element='input']");
        var   val        = $.trim(inputField.value).replace(/ +/g, ' ').toLowerCase();

        rows.removeClass('d-none').filter(function () {
            var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
            return !~text.indexOf(val);
        }).addClass('d-none');
        search.complete();
    }, 500);
}

var clear = function (search) {
    $("#resultlogservice tr").removeClass('d-none');
}

element      = document.querySelector('#kt_docs_search_handler_position');
searchObject = new KTSearch(element);
searchObject.on("kt.search.process", processs);
searchObject.on("kt.search.clear", clear);

function datalog(){
    $.ajax({
        url     : url+"index.php/operation/logservice/datalog",
        method  : "POST",
        dataType: "JSON",
        cache   : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultlogservice").html("");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";

            if(data.responCode==="00"){
                result        = data.responResult;
                for(var i in result){
                    tableresult += "<tr>";
                    tableresult += "<td class='text-start ps-4'>" + result[i].REQUEST_ID + "</td>";
                    tableresult += "<td class='text-center'>" + result[i].REMOTE_ADDRESS + "</td>";
                    tableresult += "<td class='text-center'>" + result[i].REQUEST_METHOD + "</td>";
                    tableresult += "<td>" + result[i].REQUEST_URL + "</td>";
                    tableresult += "<td>" + result[i].SOURCE + "</td>";

                    if (result[i].RESPONSE_STATUS === "200") {
                        tableresult += "<td class='text-center'><span class='badge badge-success'>" + result[i].RESPONSE_STATUS + "</span></td>";
                    } else {
                        tableresult += "<td class='text-center'><span class='badge badge-danger'>" + result[i].RESPONSE_STATUS + "</span></td>";
                    }

                    tableresult += "<td class='text-center'>" + result[i].TOTAL_TIME_US + "</td>";
                    tableresult += "<td class='text-center'>" + result[i].CREATEDDATE + "</td>";
                    tableresult += "<td class='text-end'>";
                    tableresult += "<button type='button' class='btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px' data-kt-table-widget-4='expand_row'>";
                    tableresult += "<i class='bi bi-plus fs-4 m-0 toggle-off'></i>";
                    tableresult += "<i class='bi bi-dash fs-4 m-0 toggle-on'></i>";
                    tableresult += "</button>";
                    tableresult += "</td>";
                    tableresult += "</tr>";

                    tableresult += "<tr class='d-none'>";
                    tableresult += "<td colspan='8'>";
                    tableresult += "<div class='row col-md-12'>";
                    tableresult += "<div class='col-md-6'>";

                    try {
                        var requestBody = JSON.stringify(JSON.parse(result[i].REQUEST_BODY), null, 4);
                    } catch (e) {
                        var requestBody = result[i].REQUEST_BODY; // Fallback to original if not a valid JSON
                    }
                    tableresult +="<h6>Request Body</h6>";
                    tableresult += "<textarea rows='30' class='form-control form-control-solid' readonly>" + requestBody + "</textarea>";

                    tableresult += "</div>";
                    tableresult += "<div class='col-md-6'>";

                    try {
                        var responseBody = JSON.stringify(JSON.parse(result[i].RESPONSE_BODY), null, 4);
                    } catch (e) {
                        var responseBody = result[i].RESPONSE_BODY; // Fallback to original if not a valid JSON
                    }
                    tableresult +="<h6>Response Body</h6>";
                    tableresult += "<textarea rows='30' class='form-control form-control-solid' readonly>" + responseBody + "</textarea>";

                    tableresult += "</div>";
                    tableresult += "</div>";
                    tableresult += "</td>";
                    tableresult += "</tr>";

                }
            }

            $("#resultlogservice").html(tableresult);

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
                            this.classList.remove('active'); // Remove the active class from the button
                        } else {
                            nextTr.classList.remove('d-none');
                            tr.setAttribute('aria-expanded', 'true');
                            nextTr.setAttribute('data-kt-table-widget-4', 'subtable_template');
                            this.classList.add('active'); // Add the active class to the button
                        }
                    }
                });
            });
            
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

document.querySelectorAll("[data-kt-table-widget-4='expand_row']").forEach(button => {
    button.addEventListener('click', function() {
        const tr = this.closest('tr');
        const nextTr = tr.nextElementSibling;

        if (tr.getAttribute('aria-expanded') === 'false') {
            tr.setAttribute('aria-expanded', 'true');
            nextTr.classList.remove('d-none');
            nextTr.classList.add('show');
        } else {
            tr.setAttribute('aria-expanded', 'false');
            nextTr.classList.remove('show');
            nextTr.classList.add('d-none');
        }
    });
});