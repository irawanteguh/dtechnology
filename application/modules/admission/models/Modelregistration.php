<?php
    class Modelreserve extends CI_Model{
        
        function dataok($orgid,$parameter){
            $query =
                    "
                        select x.*
                        from(
                            select 'OK' source, a.transaksi_id, pasien_id, episode_id, provider_id, dokter_opr, dokter_ans, dokter_ank, package_id, tindakan, diagnosis, benefit, reason_id, status, cito, created_by, created_date,
                                   date_format(date,'%d.%m.%Y')tgltindakan, date_format(a.created_date, '%d.%m.%Y %H:%i:%s')tglbuat
                            from dt01_med_ok_hd a
                            where a.active='1'
                            and   a.org_id='".$orgid."'
                            ".$parameter."
                        )x
                        order by status asc, created_date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        
    }
?>