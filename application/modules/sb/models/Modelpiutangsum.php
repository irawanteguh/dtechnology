<?php
    class Modelpiutangsum extends CI_Model{
        
        function rekappiutang(){
            $query =
                    "
                        select a.org_id, piutang_id, no_tagihan, rekanan_id, date_format(date,'%d.%m.%Y')tgltagihan, periode, note, nilai, jenis_id,
                            (select provider from dt01_keu_provider_ms where org_id=a.org_id and provider_id=a.rekanan_id)provider,
                            (select coalesce(sum(nominal),0) from dt01_keu_piutang_it where org_id=a.org_id and piutang_id=a.piutang_id)jumlahterbayar,
                            CONCAT(
                                    ELT(MONTH(STR_TO_DATE(periode, '%m.%Y')),
                                        'Januari','Februari','Maret','April','Mei','Juni',
                                        'Juli','Agustus','September','Oktober','November','Desember'),
                                    ' ',
                                    YEAR(STR_TO_DATE(periode, '%m.%Y'))
                                ) AS periode_indonesia,
                            CASE 
                                WHEN a.jenis_id = '1' THEN 'Asuransi Rawat Jalan'
                                WHEN a.jenis_id = '2' THEN 'Medical Check Up'
                                WHEN a.jenis_id = '3' THEN 'Tagihan Klaim BPJS'
                                WHEN a.jenis_id = '4' THEN 'Obat Kronis'
                                WHEN a.jenis_id = '5' THEN 'Ambulance'
                                WHEN a.jenis_id = '6' THEN 'Lainnya'
                                WHEN a.jenis_id = '7' THEN 'Asuransi Rawat Inap'
                                ELSE 'Lainnya'
                            END AS jenistagihan,
                            CASE 
                                WHEN a.jenis_id in ('3','4','5') THEN '1'
                                WHEN a.jenis_id in ('1','7') THEN '2'
                                WHEN a.jenis_id = '2' THEN '3'
                                ELSE '4'
                            END AS urutan,

                            MONTH(STR_TO_DATE(periode, '%m.%Y')) AS bulan_order,
                            YEAR(STR_TO_DATE(periode, '%m.%Y')) AS tahun_order
                        from dt01_keu_piutang_hd a
                        where a.active='1'
                        order by org_id, urutan, jenis_id, tahun_order ASC, bulan_order ASC;

                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }
        


    }
?>