<?php
    class Modelreserve extends CI_Model{
        
        function masterpatient($orgid){
            $query =
                    "
                        select a.pasien_id, concat(int_pasien_id,' | ',name,' | ',date_format(bod,'%d.%m.%Y')) identitaspasien
                        from dt01_gen_pasien_ms a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                        order by name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function dataok($orgid){
            $query =
                    "
                        select a.transaksi_id, pasien_id, episode_id, tindakan, date_format(date,'%d.%m.%Y')tgltindakan, date_format(a.created_date, '%d.%m.%Y %H:%i:%s')tglbuat,
                            (select name          from dt01_gen_pasien_ms where active='1' and pasien_id=a.pasien_id)namepasien,
                            (select int_pasien_id from dt01_gen_pasien_ms where active='1' and pasien_id=a.pasien_id)mrpasien,
                            (select color         from dt01_gen_master_ms where org_id=a.org_id and jenis_id='STATUSOK' and code=a.status)colorstatus,
                            (select master_name   from dt01_gen_master_ms where org_id=a.org_id and jenis_id='STATUSOK' and code=a.status)namestatus,
                            (select name 		 from dt01_gen_user_data where active='1' and user_id=a.dokter_opr)operator,
                            (select name 		 from dt01_gen_user_data where active='1' and user_id=a.dokter_ans)anastesi,
                            (select name 		 from dt01_gen_user_data where active='1' and user_id=a.dokter_ank)anak,
                            (select name 		 from dt01_gen_user_data where active='1' and user_id=a.created_by)dibuatoleh
                        from dt01_med_ok_hd a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

    }
?>