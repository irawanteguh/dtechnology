<?php
    class Modelreserve extends CI_Model{
        
        function masterpatient($orgid,$parameter){
            $query =
                    "
                        select a.pasien_id, concat(int_pasien_id,' | ',name,' | ',date_format(bod,'%d.%m.%Y')) identitaspasien
                        from dt01_gen_pasien_ms a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                        and   a.pasien_id not in (select pasien_id from dt01_med_ok_hd where active='1' and org_id=a.org_id and status not in ('99') and pasien_id=a.pasien_id)
                        ".$parameter."
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

        function masterpackage($orgid){
            $query =
                    "
                        select x.*, concat(package,' [ ',kelas,' ]',' Rp. ',FORMAT(harga, 0))packagetindakan
                        from(
                            select a.transaksi_id, harga,
                                (select urut    from dt01_keu_kelas_ms where active='1' and org_id=a.org_id and kelas_id=a.kelas_id)urut,
                                (select kelas   from dt01_keu_kelas_ms where active='1' and org_id=a.org_id and kelas_id=a.kelas_id)kelas,
                                (select package from dt01_keu_package_ms where active='1' and org_id=a.org_id and package_id=a.package_id)package
                            from dt01_keu_package_dt a
                            where a.active='1'
                            and   a.org_id='".$orgid."'
                        )x
                        order by package asc, urut asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function calender($orgid){
            $query =
                    "
                        select a.transaksi_id, status,
                            concat(DATE_FORMAT(a.date, '%Y-%m-%d')) start_date,
                            concat(DATE_FORMAT(a.date, '%Y-%m-%d')) end_date,
                            (select int_pasien_id from dt01_gen_pasien_ms where active='1' and org_id=a.org_id and pasien_id=a.pasien_id)mrpasien,
                            (select name from dt01_gen_pasien_ms where active='1' and org_id=a.org_id and pasien_id=a.pasien_id)name
                        from dt01_med_ok_hd a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function dataok($orgid,$parameter){
            $query =
                    "
                        select x.*,
                                (select kelas   from dt01_keu_kelas_ms where active='1' and kelas_id=(select kelas_id from dt01_keu_package_dt where active='1' and transaksi_id=x.package_id))kelas,
                                (select package from dt01_keu_package_ms where active='1' and package_id=(select package_id from dt01_keu_package_dt where active='1' and transaksi_id=x.package_id))package,
                                (select name          from dt01_gen_pasien_ms where active='1' and pasien_id=x.pasien_id)namepasien,
                                (select int_pasien_id from dt01_gen_pasien_ms where active='1' and pasien_id=x.pasien_id)mrpasien,
                                (select phone         from dt01_gen_pasien_ms where active='1' and pasien_id=x.pasien_id)phone,
                                (select color         from dt01_gen_master_ms where active='1' and jenis_id='STATUSOK' and code=x.status)colorstatus,
                                (select master_name   from dt01_gen_master_ms where active='1' and jenis_id='STATUSOK' and code=x.status)namestatus,
                                (select master_name   from dt01_gen_master_ms where active='1' and jenis_id='REASONOK' and master_id=x.reason_id)reason,
                                (select name 		  from dt01_gen_user_data where active='1' and user_id=x.dokter_opr)operator,
                                (select name 		  from dt01_gen_user_data where active='1' and user_id=x.dokter_ans)anastesi,
                                (select name 		  from dt01_gen_user_data where active='1' and user_id=x.dokter_ank)anak,
                                (select name 		  from dt01_gen_user_data where active='1' and user_id=x.created_by)dibuatoleh,
                                (select provider      from dt01_keu_provider_ms where active='1' and provider_id=x.provider_id)provider,
                                (select harga         from dt01_keu_package_dt where active='1' and transaksi_id=x.package_id)harga
                        from(
                            select a.transaksi_id, pasien_id, episode_id, provider_id, dokter_opr, dokter_ans, dokter_ank, package_id, tindakan, diagnosis, benefit, reason_id, status, cito, created_by, created_date,
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
                            select concat('Pasien Telah Dilakukan Penjadwalan Tindakan Operasi ',tindakan,', tanggal ', date_format(date,'%d.%m.%Y'),' menunggu konfirmasi / persetujuan operating room') chat, date_format(a.created_date,'%d.%m.%Y %H.%i.%s')jambuat, created_date, created_by
                            from dt01_med_ok_hd a
                            where a.active='1'
                            and   a.status in ('5','99')
                            and   a.org_id='".$orgid."'
                            and   a.transaksi_id='".$operasiid."'
                            union
                            select concat('Tindakan operasi dibatalkan oleh ',(select name from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=a.reason_by),' dengan alasan ',(select master_name from dt01_gen_master_ms where master_id=a.reason_id)) chat, date_format(a.reason_date,'%d.%m.%Y %H.%i.%s')jambuat, reason_date created_date, created_by
                            from dt01_med_ok_hd a
                            where a.active='1'
                            and   a.status ='99'
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