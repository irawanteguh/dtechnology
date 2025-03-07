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

        function masterprovider($orgid){
            $query =
                    "
                        select a.provider_id, provider
                        from dt01_keu_provider_ms a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                        order by provider asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterreason($orgid){
            $query =
                    "
                        select a.master_id, master_name
                        from dt01_gen_master_ms a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                        and   a.jenis_id='REASONOK'
                        order by master_name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterdokter($orgid){
            $query =
                    "
                        select a.user_id, name
                        from dt01_gen_user_data a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.kolegium_id<>''
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function dataok($orgid){
            $query =
                    "
                        select a.status, cito, benefit, transaksi_id, diagnosis, pasien_id, episode_id, tindakan, date_format(date,'%d.%m.%Y')tgltindakan, date_format(a.created_date, '%d.%m.%Y %H:%i:%s')tglbuat,
                            (select name          from dt01_gen_pasien_ms where active='1' and pasien_id=a.pasien_id)namepasien,
                            (select int_pasien_id from dt01_gen_pasien_ms where active='1' and pasien_id=a.pasien_id)mrpasien,
                            (select color         from dt01_gen_master_ms where org_id=a.org_id and jenis_id='STATUSOK' and code=a.status)colorstatus,
                            (select master_name   from dt01_gen_master_ms where org_id=a.org_id and jenis_id='STATUSOK' and code=a.status)namestatus,
                            (select master_name   from dt01_gen_master_ms where org_id=a.org_id and jenis_id='REASONOK' and master_id=a.reason_id)reason,
                            (select name 		 from dt01_gen_user_data where active='1' and user_id=a.dokter_opr)operator,
                            (select name 		 from dt01_gen_user_data where active='1' and user_id=a.dokter_ans)anastesi,
                            (select name 		 from dt01_gen_user_data where active='1' and user_id=a.dokter_ank)anak,
                            (select name 		 from dt01_gen_user_data where active='1' and user_id=a.created_by)dibuatoleh,
                            (select provider 		 from dt01_keu_provider_ms where active='1' and provider_id=a.provider_id)provider
                        from dt01_med_ok_hd a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by created_date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function chat($orgid,$userid,$operasiid){
            $query =
                    "
                        select x.*,
                            (select name from dt01_gen_user_data where active='1' and user_id=x.created_by)name,
                            (select upper(LEFT(name, 1))  from dt01_gen_user_data where active='1' and user_id=x.created_by)initial,
                            (select image_profile from dt01_gen_user_data where active='1' and user_id=x.created_by)image_profile,
                            case 
                                    when '".$userid."' = x.created_by then
                                    'out'
                                    else
                                    'in'
                            end type
                        from(
                            select concat('Pasien Telah Dilakukan Penjadwalan Tindakan Operasi ',tindakan,', tanggal ', date_format(date,'%d.%m.%Y'),' menunggu konfirmasi / persetujuan pasien') chat, date_format(a.created_date,'%d.%m.%Y %H.%i.%s')jambuat, created_date, created_by
                            from dt01_med_ok_hd a
                            where a.active='1'
                            and   a.org_id='".$orgid."'
                            and   a.transaksi_id='".$operasiid."'
                            union
                            select a.chat, date_format(created_date,'%d.%m.%Y %H.%i.%s')jambuat, created_date, created_by
                            from dt01_med_ok_chat_dt a
                            where a.active='1'
                            and   a.org_id='".$orgid."'
                            and   a.operasi_id='".$operasiid."'
                        )x
                        order by created_date asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertplan($data){           
            $sql =   $this->db->insert("dt01_med_ok_hd",$data);
            return $sql;
        }

        function updateplan($operasiid,$data){           
            $sql =   $this->db->update("dt01_med_ok_hd",$data,array("transaksi_id"=>$operasiid));
            return $sql;
        }

        function insertchat($data){           
            $sql =   $this->db->insert("dt01_med_ok_chat_dt",$data);
            return $sql;
        }

    }
?>