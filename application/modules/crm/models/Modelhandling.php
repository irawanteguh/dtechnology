<?php
    class Modelhandling extends CI_Model{
        
        function datahandling($orgid){
            $query =
                    "
                        select a.trans_id, code, nama, no_identitas, no_hp, lantai, nama_petugas, saran, department_id, status, attachment, filename, filename_buktitl, answer_instalasi, bukti_tl, response,
                               date_format(a.created_date, '%d.%m.%Y %H:%i:%s') tgldibuat,
                               date_format(a.datetime_fwd_department, '%d.%m.%Y %H:%i:%s') tgldepartment,
                               date_format(a.datetime_fwd_manager, '%d.%m.%Y %H:%i:%s') tglmanager,
                               date_format(a.datetime_fwd_marketing, '%d.%m.%Y %H:%i:%s') tglmarketing,
                               date_format(a.datetime_fwd_pasien, '%d.%m.%Y %H:%i:%s') tglpasien,
                               (select org_name from dt01_gen_organization_ms where org_id=a.org_id)nameorg,
                               (select device_id from dt01_whatsapp_device_ms where org_id=a.org_id and device_id in ('2221','2222','2223'))deviceid,
                               (select department from dt01_gen_department_ms where active='1' and department_id=a.department_id)department,
                               (select name from dt01_gen_user_data where active='1' and user_id=(select user_id from dt01_gen_department_ms where active='1' and department_id=a.department_id))namapic,
                               (select no_hp from dt01_gen_user_data where active='1' and user_id=(select user_id from dt01_gen_department_ms where active='1' and department_id=a.department_id))nohppic,
                               (select master_name from dt01_gen_master_ms where jenis_id='CRM_1' and code=a.status)statusname,
                               (select color from dt01_gen_master_ms where jenis_id='CRM_1' and code=a.status)statuscolor
                        from dt01_crm_saran_hd a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                        order by status asc, created_date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }


        function masterdepartment(){
            $query =
                    "
                        select a.department_id, department
                        from dt01_gen_department_ms a
                        where a.active='1'
                        and   a.level_id='5'
                        order by department asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function datasaran($transid){
            $query =
                    "
                        select a.org_id, trans_id, code, nama, saran, no_hp, response,
                               (select org_name from dt01_gen_organization_ms where org_id=a.org_id)nameorg,
                               (select no_hp from dt01_gen_user_data where user_id=(select user_id from dt01_gen_department_ms where org_id=a.org_id and department_id='e47a3989-52c2-4827-a62f-967a8cc05438'))nohpmarketing,
                               (select name from dt01_gen_user_data where user_id=(select user_id from dt01_gen_department_ms where org_id=a.org_id and department_id='e47a3989-52c2-4827-a62f-967a8cc05438'))namamarketing
                               
                        from dt01_crm_saran_hd a
                        where a.trans_id='".$transid."'
                        limit 1;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function simpanboardcast($data){           
            $sql =   $this->db->insert("dt01_whatsapp_broadcast_hd",$data);
            return $sql;
        }

        function updatesaran($data,$userid){           
            $sql =   $this->db->update("dt01_crm_saran_hd",$data,array("trans_id"=>$userid));
            return $sql;
        }

    }
?>
