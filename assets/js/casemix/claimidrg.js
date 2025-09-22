let searchTimeout;

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
