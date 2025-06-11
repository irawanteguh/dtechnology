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

        function rekapbukudagang($periode){
            $query =
                    "
                        select a.org_id, buku_id, buku,
                            case
                                when a.buku_id='36547c63-46d8-11f0-8318-0894effd6cc3' then (select nilai from dt01_keu_piutang_hd where jenis_id = '3' and periode = '".$periode."' LIMIT 1)
                                when a.buku_id='36547cd1-46d8-11f0-8318-0894effd6cc3' then (select nilai from dt01_keu_piutang_hd where jenis_id = '4' and periode = '".$periode."' LIMIT 1)
                                when a.buku_id='36547d87-46d8-11f0-8318-0894effd6cc3' then (select nilai from dt01_keu_piutang_hd where jenis_id = '5' and periode = '".$periode."' LIMIT 1)
                                when a.buku_id='36547ad1-46d8-11f0-8318-0894effd6cc3' then (SELECT sum(nilai) from dt01_keu_piutang_hd where jenis_id in ('1','7') and rekanan_id = 'daf5e80d-fdb6-48a9-9712-ab253091dcdb' and periode = '".$periode."' LIMIT 1)
                                else 0
                            end estimasi,
                            0 pembayaransatu,
                            0 pembayarandua
                            
                        from dt01_keu_buku_dagang_ms a
                        where a.jenis_id='1'




                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }
        


    }
?>