<?php
    class Modeldisposisi extends CI_Model{

        function lembardisposisi($orgid,$suratid){
            $query =
                    "
                        select a.org_id, department_id, header_id, department, level_id, user_id,
                            (select name from dt01_gen_user_data where active='1' and user_id=a.user_id)name,
                            (select transaksi_id from dt01_sek_surat_it where active='1' and surat_id='".$suratid."' and to_department_id=a.department_id)transaksiid,
                            (select response     from dt01_sek_surat_it where active='1' and surat_id='".$suratid."' and to_department_id=a.department_id)response
                        from dt01_gen_department_ms a
                        where a.active='1'
                        and   a.level_id in ('1','2')
                        union
                        select a.org_id, department_id, header_id,  department, level_id, user_id,
                            (select name from dt01_gen_user_data where active='1' and user_id=a.user_id)name,
                            (select transaksi_id from dt01_sek_surat_it where active='1' and surat_id='".$suratid."'and to_department_id=a.department_id)transaksiid,
                            (select response     from dt01_sek_surat_it where active='1' and surat_id='".$suratid."' and to_department_id=a.department_id)response
                        from dt01_gen_department_ms a
                        where a.active='1'
                        and   a.level_id not in ('1','2')
                        and   a.org_id='".$orgid."'
                        order by level_id asc, header_id asc, department asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function suratmasuk($userid){
            $query =
                    "
                        select a.trans_id, no_urut, no_agenda, kode_surat, nomor_surat, asal_surat, dari_text, perihal, ringkasan,
                            date_format(a.tanggal_surat,'%d.%m.%Y')tglsurat,
                            date_format(a.tanggal_masuk_surat,'%d.%m.%Y')tglmasuksurat,
                            date_format(a.created_date,'%d.%m.%Y %H:%i:%s')tgldibuat,
                            (select name from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=a.created_by)dibuatoleh,
                            case 
                                when a.asal_surat='I' then
                                    coalesce(
                                                (
                                                select department
                                                from dt01_gen_department_ms
                                                where active='1'
                                                and   org_id=a.org_id
                                                and   department_id=a.dari_id
                                                ),
                                                (
                                                select name
                                                from dt01_gen_user_data
                                                where active='1'
                                                and   org_id=a.org_id
                                                and   user_id=a.dari_id
                                                )
                                            )
                                else
                                dari_text
                            end pengirimsurat,
                            case 
                                when a.asal_surat='I' then
                                (select name from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=(select user_id from dt01_gen_department_ms where active='1' and org_id=a.org_id and department_id=a.dari_id))
                                else
                                ''
                            end namapengirimsurat,
                            (
                                SELECT GROUP_CONCAT(
                                    concat_ws(
                                        '::',
                                        b.transaksi_id,
                                        b.response,
                                        ifnull(date_format(b.from_datetime,'%d.%m.%Y %H:%i:%s'),''),
                                        ifnull(date_format(b.to_datetime,'%d.%m.%Y %H:%i:%s'),''),
                                        (select org_name from dt01_gen_organization_ms where org_id=b.to_org_id),
                                        (select name from dt01_gen_user_data where user_id=b.to_user_id)
                                    )
                                    ORDER BY b.from_datetime ASC
                                    separator ';'
                                    
                                )
                                
                                FROM dt01_sek_surat_it b
                                WHERE b.active = '1'
                                and   b.surat_id=a.trans_id
                            ) disposisi

                        from dt01_sek_surat_hd a
                        where a.active='1'
                        and   a.trans_id in (select surat_id from dt01_sek_surat_it where active='1' and to_user_id='".$userid."')
                        order by created_date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function cekresponse($suratid,$userid){
            $query =
                    "
                        select a.response
                        from dt01_sek_surat_it a
                        where a.active='1'
                        and   a.response='Y'
                        and   a.surat_id='".$suratid."'
                        and   a.to_user_id='".$userid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function chat($userid,$refid){
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
                            select a.chat, date_format(created_date,'%d.%m.%Y %H.%i.%s')jambuat, created_date, created_by
                            from dt01_gen_chat_dt a
                            where a.active='1'
                            and   a.ref_id='".$refid."'
                        )x
                        order by created_date asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertchat($data){           
            $sql =   $this->db->insert("dt01_gen_chat_dt",$data);
            return $sql;
        }


        function insertdisposisi($data){           
            $sql =   $this->db->insert("dt01_sek_surat_it",$data);
            return $sql;
        }

        function updatedisposisi($suratid,$userid,$data){           
            $sql =   $this->db->update("dt01_sek_surat_it",$data,array("surat_id"=>$suratid,"to_user_id"=>$userid));
            return $sql;
        }


    }
?>