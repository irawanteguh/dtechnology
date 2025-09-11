datagrafik();

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

                const groupeddepartment = arr.reduce((acc, item) => {
                    const department = item.department;
                    const total = parseFloat(item.total);

                    if (!acc[department]) {
                        acc[department] = 0;
                    }
                    acc[department] += total;

                    return acc;
                }, {});


                // pisahkan jadi array untuk chart
                const categoriesjenis      = Object.keys(groupedjenis);
                const seriesDatajenis      = Object.values(groupedjenis);
                const categoriesdepartment = Object.keys(groupeddepartment);
                const seriesDatadepartment = Object.values(groupeddepartment);

                createPieChart("grafik_1", seriesDatajenis, categoriesjenis);
                createRadarChart("grafik_2", seriesDatajenis, categoriesjenis);

                createBarChart("grafik_3", seriesDatadepartment, categoriesdepartment);
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
