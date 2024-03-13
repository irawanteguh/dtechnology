$(document).on("submit", "#formlogin", function (e) {
	e.preventDefault();
	e.stopPropagation();
	var form = $(this),url = $(this).attr("action");
	$.ajax({
		url: url,
		data: form.serialize(),
		method: "POST",
		dataType: "JSON",
		cache: false,
		beforeSend: function () {
			toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
			$("#btn-auth").addClass("disabled");
        },
		success: function (data) {
			if(data.responCode == "00"){
                window.open(data.url, "_self");
            }
			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
		error: function(xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		},
		complete: function () {
			$("#btn-auth").removeClass("disabled");
		}
	});
    return false;
});