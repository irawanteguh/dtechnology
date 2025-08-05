grafikoverview();

function grafikoverview() {
    $.ajax({
        url: url + "index.php/assets/monitoringasset/grafikoverview",
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend() {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success(data) {
            if (data.responCode !== "00") {
                toastr[data.responHead](data.responDesc, "INFORMATION");
                return;
            }

            toastr[data.responHead](data.responDesc, "INFORMATION");

            const result = data.responResult; // data.rows jika berupa rows
            const rsIDs = [
                "10c84edd-500b-49e3-93a5-a2c8cd2c8524", // RS Mutiasari
                "d5e63fbc-01ec-4ba8-90b8-fb623438b99d", // RSIA Budhi Mulia
                "a4633f72-4d67-4f65-a050-9f6240704151"  // RS Thursina
            ];

            const summary = {
                sarana_input  : [0, 0, 0],
                sarana_valid  : [0, 0, 0],
                alat_input    : [0, 0, 0],
                alat_valid    : [0, 0, 0],
                nonalat_input : [0, 0, 0],
                nonalat_valid : [0, 0, 0],
                rumah_input   : [0, 0, 0],
                rumah_valid   : [0, 0, 0],
                software_input: [0, 0, 0],
                software_valid: [0, 0, 0]
            };

            result.forEach(row => {
                const index = rsIDs.indexOf(row.org_id);
                if (index === -1) return;

                const cost = parseFloat(row.costperpasien || 0);
                const isValid = cost > 0;
                const isInvalid = cost === 0;

                switch (row.jenis_id) {
                    case "1":
                        if (isInvalid) summary.alat_input[index]++;
                        if (isValid) summary.alat_valid[index]++;
                        break;
                    case "2":
                        if (isInvalid) summary.sarana_input[index]++;
                        if (isValid) summary.sarana_valid[index]++;
                        break;
                    case "3":
                        if (isInvalid) summary.nonalat_input[index]++;
                        if (isValid) summary.nonalat_valid[index]++;
                        break;
                    case "4":
                        if (isInvalid) summary.rumah_input[index]++;
                        if (isValid) summary.rumah_valid[index]++;
                        break;
                    case "5":
                        if (isInvalid) summary.software_input[index]++;
                        if (isValid) summary.software_valid[index]++;
                        break;
                }
            });

            const options = {
                chart: {
                    type: 'bar',
                    height: 500,
                },
                // dataLabels: {
                //     formatter: (val) => {
                //       return val / 1000 + 'K'
                //     }
                //   },
                  plotOptions: {
                    bar: {
                      horizontal: true
                    }
                  },
                stroke: {
                    width: 1,
                    colors: ['#fff']
                  },
                xaxis: {
                    categories: ['RS Mutiasari', 'RSIA Budhi Mulia', 'RS Thursina'],
                    // categories: [
                    //     'Online advertising',
                    //     'Sales Training',
                    //     'Print advertising',
                    //     'Catalogs',
                    //     'Meetings'
                    //   ],
                    title: {
                        text: "Jumlah Aset Aktif"
                    }
                },
                series: [
                    { name: 'Sarana [In Valid]', group: 'In Valid', data: summary.sarana_input },
                    { name: 'Sarana [Valid]', group: 'Valid', data: summary.sarana_valid },
                    { name: 'Alat Kesehatan [In Valid]', group: 'In Valid', data: summary.alat_input },
                    { name: 'Alat Kesehatan [Valid]', group: 'Valid', data: summary.alat_valid },
                    { name: 'Non Alat Kesehatan [In Valid]', group: 'In Valid', data: summary.nonalat_input },
                    { name: 'Non Alat Kesehatan [Valid]', group: 'Valid', data: summary.nonalat_valid },
                    { name: 'Rumah Tangga [In Valid]', group: 'In Valid', data: summary.rumah_input },
                    { name: 'Rumah Tangga [Valid]', group: 'Valid', data: summary.rumah_valid },
                    { name: 'Software [In Valid]', group: 'In Valid', data: summary.software_input },
                    { name: 'Software [Valid]', group: 'Valid', data: summary.software_valid }
                ],
                // series: [
                //     {
                //       name: 'Q1 Budget',
                //       group: 'budget',
                //       data: [44000, 55000, 41000, 67000, 22000]
                //     },
                //     {
                //       name: 'Q1 Actual',
                //       group: 'actual',
                //       data: [48000, 50000, 40000, 65000, 25000]
                //     },
                //     {
                //       name: 'Q2 Budget',
                //       group: 'budget',
                //       data: [13000, 36000, 20000, 8000, 13000]
                //     },
                //     {
                //       name: 'Q2 Actual',
                //       group: 'actual',
                //       data: [20000, 40000, 25000, 10000, 12000]
                //     }
                //   ],
                //   fill: {
                //     opacity: 1,
                //   },
                //   colors: ['#80c7fd', '#008FFB', '#80f1cb', '#00E396'],
                //   legend: {
                //     position: 'top',
                //     horizontalAlign: 'left'
                // //   }
                colors: [
                    '#80c7fd', '#008FFB',
                    '#80f1cb', '#00E396',
                    '#FFE2B2', '#FEB019',
                    '#FFB6C1', '#FF4560',
                    '#D0B6FF', '#775DD0'
                ],
                fill: {
                    opacity: 1,
                  },
                // legend: {
                //     position: 'top',
                //     horizontalAlign: 'left'
                // },
                // title: {
                //     text: "Distribusi Aset Aktif per Rumah Sakit",
                //     align: "left"
                // }
            };

            
      
              var chart = new ApexCharts(document.querySelector("#grafikoverview"), options);
              chart.render();
              
              
              
              
        },
        complete() {
            toastr.clear();
        },
        error(xhr, status, error) {
            Swal.fire({
                title: "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html: "<b>" + error + "</b>",
                icon: "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling: false,
                timerProgressBar: true,
                timer: 5000,
                customClass: { confirmButton: "btn btn-danger" },
                showClass: { popup: "animate__animated animate__fadeInUp animate__faster" },
                hideClass: { popup: "animate__animated animate__fadeOutDown animate__faster" }
            });
        }
    });

    return false;
}

