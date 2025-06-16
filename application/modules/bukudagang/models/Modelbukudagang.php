<?php
    class Modelbukudagang extends CI_Model{
        
        function periode(){
            $query =
                    "
                        select distinct date_format(tgl_registrasi, '%Y')periode
                        from reg_periksa a
                        order by periode desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function rekapbukudagang($orgid, $tahun) {
            $estimasi = "";
            $penerimaan = "";
            $bulanList = ['01','02','03','04','05','06','07','08','09','10','11','12'];

            foreach ($bulanList as $index => $bulan) {
                $colEst  = "estimasi_" . ($index + 1);
                $colPen  = "penerimaan_" . ($index + 1);
                $periode = $bulan . "." . $tahun;

                // Estimasi
                $estimasi .= "
                    CASE
                        WHEN a.manual = 'Y' THEN COALESCE((SELECT SUM(estimasi) FROM dt01_keu_buku_dagang_it WHERE buku_id=a.buku_id AND periode = '{$periode}'), 0)
                        WHEN a.manual in ('S','P') THEN COALESCE((SELECT SUM(total) FROM dt01_lgu_pemesanan_dt WHERE active='1' AND barang_id IN (SELECT barang_id FROM dt01_lgu_barang_ms WHERE active='1' AND jenis_id=a.buku_id) AND no_pemesanan IN (SELECT no_pemesanan FROM dt01_lgu_pemesanan_hd WHERE active='1' AND DATE_FORMAT(payment_date,'%m.%Y')='{$periode}' or DATE_FORMAT(created_date,'%m.%Y')='{$periode}')),0)
                        WHEN a.buku_id = '916ffd91-c750-41f7-b747-aa7e3b0358c2' THEN COALESCE((SELECT sum(estimasi) FROM dt01_keu_buku_dagang_it WHERE buku_id=a.buku_id AND periode = '{$periode}'), 0)
                        WHEN a.buku_id = '365477ec-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT sum(u_rj+u_ri) FROM dt01_report_income_dt WHERE active='1' AND org_id='".$orgid."' AND DATE_FORMAT(date,'%m.%Y') = '{$periode}'), 0)
                        WHEN a.buku_id = '36547ba5-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT sum(nilai) FROM dt01_keu_piutang_hd WHERE active='1' and jenis_id = '2' AND periode = '{$periode}' LIMIT 1), 0)
                        WHEN a.buku_id = '36547c63-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT sum(nilai) FROM dt01_keu_piutang_hd WHERE active='1' and jenis_id = '3' AND periode = '{$periode}' LIMIT 1), 0)
                        WHEN a.buku_id = '36547cd1-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT sum(nilai) FROM dt01_keu_piutang_hd WHERE active='1' and jenis_id = '4' AND periode = '{$periode}' LIMIT 1), 0)
                        WHEN a.buku_id = '36547d87-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT sum(nilai) FROM dt01_keu_piutang_hd WHERE active='1' and jenis_id = '5' AND periode = '{$periode}' LIMIT 1), 0)
                        WHEN a.buku_id = '36547ad1-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT sum(nilai) FROM dt01_keu_piutang_hd WHERE active='1' and jenis_id IN ('1','7') AND rekanan_id = 'daf5e80d-fdb6-48a9-9712-ab253091dcdb' AND periode = '{$periode}' LIMIT 1), 0)
                        WHEN a.buku_id = '36547b3e-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT sum(nilai) FROM dt01_keu_piutang_hd WHERE active='1' and jenis_id IN ('1','7') AND rekanan_id = '10217fa6-f8d6-4495-940e-17bad5f4c61e' AND periode = '{$periode}' LIMIT 1), 0)
                        WHEN a.buku_id = '36547a64-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT sum(nilai) FROM dt01_keu_piutang_hd WHERE active='1' and jenis_id IN ('1','7') AND rekanan_id NOT IN ('10217fa6-f8d6-4495-940e-17bad5f4c61e','daf5e80d-fdb6-48a9-9712-ab253091dcdb') AND periode = '{$periode}' LIMIT 1), 0)
                        ELSE 0
                    END AS {$colEst},";

                // Penerimaan
                $penerimaan .= "
                    CASE
                        WHEN a.manual = 'Y' THEN COALESCE((SELECT sum(penerimaan) FROM dt01_keu_buku_dagang_it WHERE buku_id=a.buku_id AND periode = '{$periode}'), 0)
                        WHEN a.manual = 'S' THEN COALESCE((SELECT sum(penerimaan) FROM dt01_keu_buku_dagang_it WHERE buku_id=a.buku_id AND periode = '{$periode}'), 0)
                        WHEN a.manual = 'P' THEN COALESCE((SELECT sum(total) FROM dt01_lgu_pemesanan_dt WHERE active='1' AND barang_id IN (SELECT barang_id FROM dt01_lgu_barang_ms WHERE active='1' AND jenis_id=a.buku_id) AND no_pemesanan IN (SELECT no_pemesanan FROM dt01_lgu_pemesanan_hd WHERE active='1' AND DATE_FORMAT(payment_date,'%m.%Y')='{$periode}' or DATE_FORMAT(created_date,'%m.%Y')='{$periode}')),0)
                        WHEN a.buku_id = '916ffd91-c750-41f7-b747-aa7e3b0358c2' THEN COALESCE((SELECT sum(penerimaan) FROM dt01_keu_buku_dagang_it WHERE buku_id=a.buku_id AND periode = '{$periode}'), 0)
                        WHEN a.buku_id = '36547ba5-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT sum(nominal) FROM dt01_keu_piutang_it WHERE piutang_id IN (SELECT piutang_id FROM dt01_keu_piutang_hd WHERE active='1' and jenis_id = '2' AND periode = '{$periode}')), 0)
                        WHEN a.buku_id = '36547c63-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT sum(nominal) FROM dt01_keu_piutang_it WHERE piutang_id IN (SELECT piutang_id FROM dt01_keu_piutang_hd WHERE active='1' and jenis_id = '3' AND periode = '{$periode}')), 0)
                        WHEN a.buku_id = '36547cd1-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT sum(nominal) FROM dt01_keu_piutang_it WHERE piutang_id IN (SELECT piutang_id FROM dt01_keu_piutang_hd WHERE active='1' and jenis_id = '4' AND periode = '{$periode}')), 0)
                        WHEN a.buku_id = '36547d87-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT sum(nominal) FROM dt01_keu_piutang_it WHERE piutang_id IN (SELECT piutang_id FROM dt01_keu_piutang_hd WHERE active='1' and jenis_id = '5' AND periode = '{$periode}')), 0)
                        WHEN a.buku_id = '36547ad1-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT sum(nominal) FROM dt01_keu_piutang_it WHERE piutang_id IN (SELECT piutang_id FROM dt01_keu_piutang_hd WHERE active='1' and jenis_id IN ('1','7') AND rekanan_id = 'daf5e80d-fdb6-48a9-9712-ab253091dcdb' AND periode = '{$periode}')), 0)
                        WHEN a.buku_id = '36547b3e-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT sum(nominal) FROM dt01_keu_piutang_it WHERE piutang_id IN (SELECT piutang_id FROM dt01_keu_piutang_hd WHERE active='1' and jenis_id IN ('1','7') AND rekanan_id = '10217fa6-f8d6-4495-940e-17bad5f4c61e' AND periode = '{$periode}')), 0)
                        WHEN a.buku_id = '36547a64-46d8-11f0-8318-0894effd6cc3' THEN COALESCE((SELECT sum(nominal) FROM dt01_keu_piutang_it WHERE piutang_id IN (SELECT piutang_id FROM dt01_keu_piutang_hd WHERE active='1' and jenis_id IN ('1','7') AND rekanan_id NOT IN ('10217fa6-f8d6-4495-940e-17bad5f4c61e','daf5e80d-fdb6-48a9-9712-ab253091dcdb') AND periode = '{$periode}')), 0)
                        ELSE 0
                    END AS {$colPen},";
            }

            // Hapus koma terakhir agar query SQL valid
            $estimasi   = rtrim($estimasi, ",");
            $penerimaan = rtrim($penerimaan, ",");

            $query = "
                SELECT a.buku_id, a.buku, a.keterangan, a.manual, jenis_id,
                    {$estimasi},
                    {$penerimaan}
                FROM dt01_keu_buku_dagang_ms a
                order by jenis_id, manual asc, buku asc
            ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function cekdata($orgid,$bukuid,$periode){
            $query =
                    "
                        select a.transaksi_id
                        from dt01_keu_buku_dagang_it a
                        where a.org_id='".$orgid."'
                        and   a.buku_id='".$bukuid."'
                        and   a.periode='".$periode."'
                        limit 1;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }


        function insertbukudagang($data){           
            $sql =   $this->db->insert("dt01_keu_buku_dagang_it",$data);
            return $sql;
        }

        function updatebukudagang($orgid,$bukuid,$periodeid,$data){           
            $sql =   $this->db->update("dt01_keu_buku_dagang_it",$data,array("org_id"=>$orgid,"buku_id"=>$bukuid, "periode"=>$periodeid));
            return $sql;
        }
        


    }
?>