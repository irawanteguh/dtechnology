<?php
    class Modelsummary extends CI_Model{
        
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

        function datapiutang($orgid,$tahun){
            $query =
                    "
                        select a.jenis_id, rekanan_id, periode, sum(nilai)jml,
                            (select coalesce(sum(nominal), 0) from dt01_keu_piutang_it  where org_id=a.org_id and piutang_id=a.piutang_id)jmlterbayar,
                            (select provider from dt01_keu_provider_ms where provider_id=a.rekanan_id)provider,
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
                        and right(periode, 4) = '".$tahun."'
                        group by urutan, jenis_id, provider, periode
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }


    }
?>