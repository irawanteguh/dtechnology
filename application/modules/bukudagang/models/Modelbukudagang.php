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
            $bulanlist = ['01','02','03','04','05','06','07','08','09','10','11','12'];
            $selectEstimasi = "";
            $selectPenerimaan = "";
        
            foreach ($bulanlist as $i => $bulan) {
                $periode = $bulan . "." . $tahun;
                $alias   = $bulan . "_" . $tahun;
        
                $selectEstimasi .= "
                    coalesce(
                        case 
                            when a.manual = 'Y' then (select sum(estimasi) from dt01_keu_buku_dagang_it where buku_id=a.buku_id and periode = '{$periode}')
                            when a.manual in ('S','P') then (
                                select sum(total) from dt01_lgu_pemesanan_dt 
                                where active = '1' 
                                and barang_id in (select barang_id from dt01_lgu_barang_ms where active='1' and buku_id = a.buku_id)
                                and no_pemesanan in (
                                    select no_pemesanan from dt01_lgu_pemesanan_hd 
                                    where active = '1' 
                                    and (date_format(payment_date,'%m.%Y') = '{$periode}' or date_format(created_date,'%m.%Y') = '{$periode}')
                                )
                            )
                            when a.buku_id = '916ffd91-c750-41f7-b747-aa7e3b0358c2' then (select sum(estimasi) from dt01_keu_buku_dagang_it where buku_id=a.buku_id and periode = '{$periode}')
                            when a.buku_id = '365477ec-46d8-11f0-8318-0894effd6cc3' then (select sum(u_rj+u_ri) from dt01_report_income_dt where active='1' and org_id='{$orgid}' and date_format(date,'%m.%Y') = '{$periode}')
                            when a.buku_id = '36547ba5-46d8-11f0-8318-0894effd6cc3' then (select sum(nilai) from dt01_keu_piutang_hd where active='1' and jenis_id = '2' and periode = '{$periode}' limit 1)
                            when a.buku_id = '36547c63-46d8-11f0-8318-0894effd6cc3' then (select sum(nilai) from dt01_keu_piutang_hd where active='1' and jenis_id = '3' and periode = '{$periode}' limit 1)
                            when a.buku_id = '36547cd1-46d8-11f0-8318-0894effd6cc3' then (select sum(nilai) from dt01_keu_piutang_hd where active='1' and jenis_id = '4' and periode = '{$periode}' limit 1)
                            when a.buku_id = '36547d87-46d8-11f0-8318-0894effd6cc3' then (select sum(nilai) from dt01_keu_piutang_hd where active='1' and jenis_id in ('5','6') and periode = '{$periode}' limit 1)
                            when a.buku_id = '36547ad1-46d8-11f0-8318-0894effd6cc3' then (select sum(nilai) from dt01_keu_piutang_hd where active='1' and jenis_id in ('1','7') and rekanan_id='daf5e80d-fdb6-48a9-9712-ab253091dcdb' and periode = '{$periode}' limit 1)
                            when a.buku_id = '36547b3e-46d8-11f0-8318-0894effd6cc3' then (select sum(nilai) from dt01_keu_piutang_hd where active='1' and jenis_id in ('1','7') and rekanan_id='10217fa6-f8d6-4495-940e-17bad5f4c61e' and periode = '{$periode}' limit 1)
                            when a.buku_id = '36547a64-46d8-11f0-8318-0894effd6cc3' then (select sum(nilai) from dt01_keu_piutang_hd where active='1' and jenis_id in ('1','7') and rekanan_id not in ('10217fa6-f8d6-4495-940e-17bad5f4c61e','daf5e80d-fdb6-48a9-9712-ab253091dcdb') and periode = '{$periode}' limit 1)
                            else 0
                        end, 0
                    ) as estimasi_" . ($i + 1) . ",";
        
                $selectPenerimaan .= "
                    coalesce(
                        case 
                            when a.manual in ('Y','S') then (select sum(penerimaan) from dt01_keu_buku_dagang_it where buku_id=a.buku_id and periode = '{$periode}')
                            when a.manual = 'P' then (
                                select sum(total) from dt01_lgu_pemesanan_dt 
                                where active = '1' 
                                and barang_id in (select barang_id from dt01_lgu_barang_ms where active='1' and buku_id = a.buku_id)
                                and no_pemesanan in (
                                    select no_pemesanan from dt01_lgu_pemesanan_hd 
                                    where active = '1' 
                                    and (date_format(payment_date,'%m.%Y') = '{$periode}' or date_format(created_date,'%m.%Y') = '{$periode}')
                                )
                            )
                            when a.buku_id = '916ffd91-c750-41f7-b747-aa7e3b0358c2' then (select sum(penerimaan) from dt01_keu_buku_dagang_it where buku_id=a.buku_id and periode = '{$periode}')
                            when a.buku_id = '36547ba5-46d8-11f0-8318-0894effd6cc3' then (select sum(nominal) from dt01_keu_piutang_it where piutang_id in (select piutang_id from dt01_keu_piutang_hd where active='1' and jenis_id='2' and periode = '{$periode}'))
                            when a.buku_id = '36547c63-46d8-11f0-8318-0894effd6cc3' then (select sum(nominal) from dt01_keu_piutang_it where piutang_id in (select piutang_id from dt01_keu_piutang_hd where active='1' and jenis_id='3' and periode = '{$periode}'))
                            when a.buku_id = '36547cd1-46d8-11f0-8318-0894effd6cc3' then (select sum(nominal) from dt01_keu_piutang_it where piutang_id in (select piutang_id from dt01_keu_piutang_hd where active='1' and jenis_id='4' and periode = '{$periode}'))
                            when a.buku_id = '36547d87-46d8-11f0-8318-0894effd6cc3' then (select sum(nominal) from dt01_keu_piutang_it where piutang_id in (select piutang_id from dt01_keu_piutang_hd where active='1' and jenis_id in ('5','6') and periode = '{$periode}'))
                            when a.buku_id = '36547ad1-46d8-11f0-8318-0894effd6cc3' then (select sum(nominal) from dt01_keu_piutang_it where piutang_id in (select piutang_id from dt01_keu_piutang_hd where active='1' and jenis_id in ('1','7') and rekanan_id='daf5e80d-fdb6-48a9-9712-ab253091dcdb' and periode = '{$periode}'))
                            when a.buku_id = '36547b3e-46d8-11f0-8318-0894effd6cc3' then (select sum(nominal) from dt01_keu_piutang_it where piutang_id in (select piutang_id from dt01_keu_piutang_hd where active='1' and jenis_id in ('1','7') and rekanan_id='10217fa6-f8d6-4495-940e-17bad5f4c61e' and periode = '{$periode}'))
                            when a.buku_id = '36547a64-46d8-11f0-8318-0894effd6cc3' then (select sum(nominal) from dt01_keu_piutang_it where piutang_id in (select piutang_id from dt01_keu_piutang_hd where active='1' and jenis_id in ('1','7') and rekanan_id not in ('10217fa6-f8d6-4495-940e-17bad5f4c61e','daf5e80d-fdb6-48a9-9712-ab253091dcdb') and periode = '{$periode}'))
                            else 0
                        end, 0
                    ) as penerimaan_" . ($i + 1) . ",";
            }
        
            $selectEstimasi = rtrim($selectEstimasi, ',');
            $selectPenerimaan = rtrim($selectPenerimaan, ',');
        
            $query = "
                select a.buku_id, a.buku, a.keterangan, a.manual, a.jenis_id,
                    {$selectEstimasi},
                    {$selectPenerimaan}
                from dt01_keu_buku_dagang_ms a
                order by a.manual, urut
            ";
        
            $recordset = $this->db->query($query);
            return $recordset->result();
        }
        
        

        

                     

        function datapiutang($orgid,$periode,$parameter){
            $query =
                    "
                        select a.piutang_id, no_tagihan, note, jenis_id, rekanan_id, periode, nilai,
                            DATE_FORMAT(a.date, '%d.%m.%Y') tgldate, 
                            (select coalesce(sum(nominal), 0) from dt01_keu_piutang_it  where org_id=a.org_id and piutang_id=a.piutang_id)jmlterbayar,
                            (select provider from dt01_keu_provider_ms where provider_id=a.rekanan_id)provider,
                            DATE_FORMAT(a.last_update_date, '%d.%m.%Y %H:%i:%s') tgldibuat, 
                            (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.last_update_by)dibuatoleh,
                            CONCAT(ELT(MONTH(STR_TO_DATE(periode, '%m.%Y')),'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'),' ',YEAR(STR_TO_DATE(periode, '%m.%Y'))) AS periode_indonesia,
                            CASE 
                                    WHEN a.jenis_id = '1' THEN 'Asuransi Rawat Jalan'
                                    WHEN a.jenis_id = '2' THEN 'Medical Check Up'
                                    WHEN a.jenis_id = '3' THEN 'Tagihan Klaim BPJS'
                                    WHEN a.jenis_id = '4' THEN 'Obat Kronis'
                                    WHEN a.jenis_id = '5' THEN 'Ambulance'
                                    WHEN a.jenis_id = '6' THEN 'Lainnya'
                                    WHEN a.jenis_id = '7' THEN 'Asuransi Rawat Inap'
                                    ELSE 'Unknown'
                            END AS jenistagihan,
                            CASE 
                                WHEN a.jenis_id in ('3','4','5') THEN '1'
                                WHEN a.jenis_id = '2' THEN '2'
                                WHEN a.jenis_id in ('1','7') THEN '3'
                                ELSE '4'
                            END AS urutan
                        from dt01_keu_piutang_hd a
                        where a.active='1'
                        and   a.periode = '".$periode."'
                        ".$parameter."
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