<?php
    class Modelbukudagang extends CI_Model{
        
        function periode(){
            $query =
                    "
                        select distinct periode, CONCAT(
                                    ELT(MONTH(STR_TO_DATE(a.periode, '%m.%Y')),
                                        'Januari','Februari','Maret','April','Mei','Juni',
                                        'Juli','Agustus','September','Oktober','November','Desember'),
                                    ' ',
                                    YEAR(STR_TO_DATE(periode, '%m.%Y'))
                                ) AS periode_indonesia,
                                MONTH(STR_TO_DATE(periode, '%m.%Y')) AS bulan_order,
                                YEAR(STR_TO_DATE(periode, '%m.%Y')) AS tahun_order
                        from dt01_keu_piutang_hd a
                        where periode is not null
                        ORDER BY tahun_order desc, bulan_order desc;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function rekapbukudagang($periode){
            $query =
                    "
                        SELECT '10c84edd-500b-49e3-93a5-a2c8cd2c8524' AS org_id, '1' AS pendapatanid, 'PENDAPATAN PASIEN UMUM' AS pendapatan,
                            0 AS estimasi, 0 AS pembayaransatu, 0 AS pembayarandua
                        UNION
                        SELECT '10c84edd-500b-49e3-93a5-a2c8cd2c8524', '2', 'PENDAPATAN PASIEN UMUM TRANSFER',
                            0, 0, 0
                        UNION
                        SELECT '10c84edd-500b-49e3-93a5-a2c8cd2c8524', '3', 'PENDAPATAN PASIEN ASS',
                            (SELECT SUM(nilai) FROM dt01_keu_piutang_hd WHERE jenis_id IN ('1','7') AND rekanan_id <> 'daf5e80d-fdb6-48a9-9712-ab253091dcdb' AND periode = '".$periode."'),
                            0, 0
                        UNION
                        SELECT '10c84edd-500b-49e3-93a5-a2c8cd2c8524', '4', 'PENDAPATAN ASS BPJS KETENAGAKERJAAN',
                            (SELECT SUM(nilai) FROM dt01_keu_piutang_hd WHERE jenis_id IN ('1','7') AND rekanan_id = 'daf5e80d-fdb6-48a9-9712-ab253091dcdb' AND periode = '".$periode."'),
                            0, 0
                        UNION
                        SELECT '10c84edd-500b-49e3-93a5-a2c8cd2c8524', '5', 'PENDAPATAN MEDIKA PLAZA TREADMILL PHR',
                            0, 0, 0
                        UNION
                        SELECT '10c84edd-500b-49e3-93a5-a2c8cd2c8524', '6', 'PENDAPATAN PASIEN MCU',
                            0, 0, 0
                        UNION
                        SELECT '10c84edd-500b-49e3-93a5-a2c8cd2c8524', '7', 'PENDAPATAN PASIEN MCU TRANSFER',
                            0, 0, 0
                        UNION
                        SELECT '10c84edd-500b-49e3-93a5-a2c8cd2c8524', '8', 'PENDAPATAN BPJS ESTIMASI',
                            (SELECT nilai FROM dt01_keu_piutang_hd WHERE jenis_id = '3' AND periode = '".$periode."' LIMIT 1),
                            (SELECT SUM(nominal) FROM dt01_keu_piutang_it WHERE piutang_id IN (
                                SELECT piutang_id FROM dt01_keu_piutang_hd WHERE jenis_id = '3' AND periode = '".$periode."'
                            )),
                            0
                        UNION
                        SELECT '10c84edd-500b-49e3-93a5-a2c8cd2c8524', '9', 'PENDAPATAN OBAT KRONIS ESTIMASI',
                            (SELECT nilai FROM dt01_keu_piutang_hd WHERE jenis_id = '4' AND periode = '".$periode."' LIMIT 1),
                            0, 0
                        UNION
                        SELECT '10c84edd-500b-49e3-93a5-a2c8cd2c8524', '10', 'PENDAPATAN BUNGA BANK',
                            0, 0, 0
                        UNION
                        SELECT '10c84edd-500b-49e3-93a5-a2c8cd2c8524', '11', 'PENDAPATAN LAIN-LAIN',
                            0, 0, 0;




                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }
        


    }
?>