<?php
    class Modelbukudagang extends CI_Model{
        
        function periode(){
            $query =
                    "
                        select distinct periode, 
                                CONCAT(ELT(MONTH(STR_TO_DATE(periode, '%m.%Y')),'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'),' ',YEAR(STR_TO_DATE(periode, '%m.%Y'))) AS periode_indonesia,                    
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

        function rekapbukudagang($tahun) {
            $estimasi  = "";
            $bulanList = ['01','02','03','04','05','06','07','08','09','10','11','12'];

            foreach ($bulanList as $index => $bulan) {
                $col = "estimasi_" . ($index + 1);
                $periode = $bulan . "." . $tahun;

                $estimasi .= "
                    CASE
                        WHEN a.buku_id = '365477ec-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT SUM(u_rj+u_ri) FROM dt01_report_income_dt WHERE active='1' AND org_id=a.org_id AND DATE_FORMAT(date,'%m.%Y') = '{$periode}'), 0)
                        WHEN a.buku_id = '36547ba5-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT nilai FROM dt01_keu_piutang_hd WHERE jenis_id = '2' AND periode = '{$periode}' LIMIT 1), 0)
                        WHEN a.buku_id = '36547c63-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT nilai FROM dt01_keu_piutang_hd WHERE jenis_id = '3' AND periode = '{$periode}' LIMIT 1), 0)
                        WHEN a.buku_id = '36547cd1-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT nilai FROM dt01_keu_piutang_hd WHERE jenis_id = '4' AND periode = '{$periode}' LIMIT 1), 0)
                        WHEN a.buku_id = '36547d87-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT nilai FROM dt01_keu_piutang_hd WHERE jenis_id = '5' AND periode = '{$periode}' LIMIT 1), 0)
                        WHEN a.buku_id = '36547ad1-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT SUM(nilai) FROM dt01_keu_piutang_hd WHERE jenis_id IN ('1','7') AND rekanan_id = 'daf5e80d-fdb6-48a9-9712-ab253091dcdb' AND periode = '{$periode}' LIMIT 1), 0)
                        WHEN a.buku_id = '36547b3e-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT SUM(nilai) FROM dt01_keu_piutang_hd WHERE jenis_id IN ('1','7') AND rekanan_id = '10217fa6-f8d6-4495-940e-17bad5f4c61e' AND periode = '{$periode}' LIMIT 1), 0)
                        WHEN a.buku_id = '36547a64-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT SUM(nilai) FROM dt01_keu_piutang_hd WHERE jenis_id IN ('1','7') AND rekanan_id NOT IN ('10217fa6-f8d6-4495-940e-17bad5f4c61e','daf5e80d-fdb6-48a9-9712-ab253091dcdb') AND periode = '{$periode}' LIMIT 1), 0)
                        ELSE 0
                    END AS {$col},
                ";
            }

            // Hapus koma terakhir
            $estimasi = rtrim($estimasi, ",");

            $query = "
                SELECT a.org_id, a.buku_id, a.buku,
                {$estimasi}
                case
                    WHEN a.buku_id = '36547ba5-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT SUM(nominal) FROM dt01_keu_piutang_it WHERE piutang_id IN (SELECT piutang_id FROM dt01_keu_piutang_hd WHERE jenis_id = '2' AND periode = '02.".$tahun."')), 0)
                    WHEN a.buku_id = '36547c63-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT SUM(nominal) FROM dt01_keu_piutang_it WHERE piutang_id IN (SELECT piutang_id FROM dt01_keu_piutang_hd WHERE jenis_id = '3' AND periode = '02.".$tahun."')), 0)
                    WHEN a.buku_id = '36547cd1-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT SUM(nominal) FROM dt01_keu_piutang_it WHERE piutang_id IN (SELECT piutang_id FROM dt01_keu_piutang_hd WHERE jenis_id = '4' AND periode = '02.".$tahun."')), 0)
                    WHEN a.buku_id = '36547d87-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT SUM(nominal) FROM dt01_keu_piutang_it WHERE piutang_id IN (SELECT piutang_id FROM dt01_keu_piutang_hd WHERE jenis_id = '5' AND periode = '02.".$tahun."')), 0)
                    WHEN a.buku_id = '36547ad1-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT SUM(nominal) FROM dt01_keu_piutang_it WHERE piutang_id IN (SELECT piutang_id FROM dt01_keu_piutang_hd WHERE jenis_id IN ('1','7') AND rekanan_id = 'daf5e80d-fdb6-48a9-9712-ab253091dcdb' AND periode = '02.".$tahun."')), 0)
                    ELSE 0
                END AS penerimaan_2

                FROM dt01_keu_buku_dagang_ms a
                WHERE a.jenis_id = '1'
            ";

            $recordset = $this->db->query($query);
            return $recordset->result();
        }

        


    }
?>