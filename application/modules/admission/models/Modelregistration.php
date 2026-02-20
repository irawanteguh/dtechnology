<?php
    class Modelregistration extends CI_Model{
        
        function dataok($orgid,$parameter){
            $query =
                    "
                        select x.*,
                                (select name          from dt01_gen_pasien_ms where active='1' and pasien_id=x.pasien_id)namepasien,
                                (select int_pasien_id from dt01_gen_pasien_ms where active='1' and pasien_id=x.pasien_id)mrpasien,
                                (select name 		  from dt01_gen_user_data where active='1' and user_id=x.dokter_opr)operator,
                                (select name 		  from dt01_gen_user_data where active='1' and user_id=x.created_by)dibuatoleh,
                                (select kelas   from dt01_keu_kelas_ms where active='1' and kelas_id=(select kelas_id from dt01_keu_package_dt where active='1' and transaksi_id=x.package_id))kelas
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