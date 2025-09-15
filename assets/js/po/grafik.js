datagrafik();

$(document).on("change", "select[name='selectorganization']", function (e) {
    e.preventDefault();
    datagrafik();
});

$(document).on("change", "select[name='filterperiode']", function (e) {
    e.preventDefault();
    datagrafik();
});

function datagrafik() {
    const filterperiode      = $("select[name='filterperiode']").val();
    const selectorganization = $("select[name='selectorganization']").val();

    $.ajax({
        url     : url + "index.php/po/grafik/datagrafik",
        method  : "POST",
        data    : {filterperiode:filterperiode,selectorganization:selectorganization},
        dataType: "JSON",
        cache   : false,
        beforeSend() {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success(data) {
            if(data.responCode==="00"){
                const arr = Array.isArray(data.responResult) ? data.responResult : [data.responResult];

                const groupedjenis = arr.reduce((acc, item) => {
                    const jenis = item.jenis;
                    const total = parseFloat(item.total);

                    if (!acc[jenis]) {
                        acc[jenis] = 0;
                    }
                    acc[jenis] += total;

                    return acc;
                }, {});


                const Datagrafik3 = Object.entries(
                    arr.reduce((acc, item) => {
                        const category = item.department;          // pakai department sebagai kategori
                        const value = parseFloat(item.total) || 0; // angka total

                        if (!acc[category]) {
                            acc[category] = 0;
                        }
                        acc[category] += value;

                        return acc;
                    }, {})
                ).map(([category, value]) => ({
                    category,
                    value
                }));






                // pisahkan jadi array untuk chart
                const categoriesjenis      = Object.keys(groupedjenis);
                const seriesDatajenis      = Object.values(groupedjenis);

                PieAmChart5("grafik_1", seriesDatajenis, categoriesjenis);
                // createRadarChart("grafik_2", seriesDatajenis, categoriesjenis);

                SortedBarAmChart5("grafik_3", Datagrafik3);
            }

            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete() {
            toastr.clear();
        },
        error(xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>" + error + "</b>",
                icon             : "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling   : false,
                timerProgressBar : true,
                timer            : 5000,
                customClass      : { confirmButton: "btn btn-danger" },
                showClass        : { popup: "animate__animated animate__fadeInUp animate__faster" },
                hideClass        : { popup: "animate__animated animate__fadeOutDown animate__faster" }
            });
        }
    });

    return false;
};
