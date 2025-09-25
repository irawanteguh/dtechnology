let searchTimeout;
randomgenerator();

$(document).ready(function () {
    $("select[name='grouping_icd10']").select2({
        placeholder       : "Silakan Pilih Diagnosis",
        width             : "100%",
        minimumInputLength: 3,
        ajax: {
            url     : url + "index.php/casemix/claimidrg/mastericd10",
            type    : "POST",
            dataType: "JSON",
            delay   : 500,
            data    : function (params) {
                return { keyword: params.term };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            id         : item.code_2,
                            description: item.description,
                            validcode  : item.validcode,
                            disabled   : (item.validcode == 0)
                        };
                    })
                };
            }
        },
        templateResult: function (data) {
            if (data.loading) return data.text;

            var color   = (data.validcode == 0) ? "color:#b30000;" : "";
            var $markup = $("<div style='" + color + "'>" + data.description + "</div>");

            return $markup;
        },
        templateSelection: function (data) {
            if (!data.id) return "Silakan Pilih Diagnosis";
            return data.description;
        }
    });
});

function randomgenerator() {
    $.ajax({
        url       : url+"index.php/casemix/claimidrg/randomgenerator",
        type      : "GET",
        dataType  : "JSON",
        beforeSend: function() {
            // clear semua input yang id ATAU name diawali claim_
            $("input[id^='claim_'], input[name^='claim_']").val("");
        },
        success: function(data) {
            if(data.name){
                $("#claim_mr").val(data.medicalrecord);
                $("#claim_name").val(data.name);
                $("#claim_nokartu").val(data.nokartu);
                $("#claim_nosep").val(data.nosep);
                $("#claim_tindakannonbedah").val(formatCurrency(data.tindakannonbedah));
                $("#claim_tindakanbedah").val(formatCurrency(data.tindakanbedah));
                $("#claim_konsultasi").val(formatCurrency(data.konsultasi));
                $("#claim_tenagaahli").val(formatCurrency(data.tenagaahli));
                $("#claim_keperawatan").val(formatCurrency(data.keperawatan));
                $("#claim_penunjang").val(formatCurrency(data.penunjang));
                $("#claim_radiologi").val(formatCurrency(data.radiologi));
                $("#claim_laboratorium").val(formatCurrency(data.laboratorium));
                $("#claim_darah").val(formatCurrency(data.darah));
                $("#claim_rehab").val(formatCurrency(data.rehab));
                $("#claim_kamar").val(formatCurrency(data.kamar));
                $("#claim_intensif").val(formatCurrency(data.intensif));
                $("#claim_obat").val(formatCurrency(data.obat));
                $("#claim_obatkronis").val(formatCurrency(data.obatkronis));
                $("#claim_obatkemo").val(formatCurrency(data.obatkemo));
                $("#claim_alkes").val(formatCurrency(data.alkes));
                $("#claim_bmhp").val(formatCurrency(data.bmhp));
                $("#claim_alat").val(formatCurrency(data.alat));
                $("#claim_totaltarifrs").val(formatCurrency(data.totaltarifrs));
            }
        }
    });
};

$(document).on("submit", "#formsetklaim", function (e) {
	e.preventDefault();
    e.stopPropagation();
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
			$("#setklaim_btn").addClass("disabled");
        },
		success: function (data) {
            if (typeof data === "string") {
                try {
                    data = JSON.parse(data);
                } catch (e) {
                    console.error("Response bukan JSON valid:", data);
                    return;
                }
            }

            let code    = data.metadata?.code ?? 500;
            let message = data.metadata?.message ?? "No response message";

            Swal.fire({
                icon: code == 200 ? "success" : "error",
                title: "INFORMATION",
                text: message,
                confirmButtonText: "OK",
                customClass: {
                    confirmButton: "btn btn-primary"
                },
                buttonsStyling: false
            });
		},
        complete: function(){
            toastr.clear();
            $("#setklaim_btn").removeClass("disabled");
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
});