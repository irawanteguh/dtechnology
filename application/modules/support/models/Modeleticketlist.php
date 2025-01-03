<?php
    class Modeleticketlist extends CI_Model{

        function dataeticket($orgid,$user,$departmentid){
            $query =
                    "
                        select a.trans_id, subject, description, status, severity, attachment, date_format(created_date, '%d.%m.%Y %H:%i:%s')createddate,
                               (select name from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=a.created_by)dibuatoleh
                        from dt01_it_support_eticket_hd a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.created_by='".$user."'
                        and   a.department_id='".$departmentid."'
                        and   a.subject <> ''
                        and   a.description <> ''
                        order by created_date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function cekdepartmentid($orgid,$userid){
            $query =
                    "
                       select a.unit_id department_id
                       from dt01_hrd_position_ms a
                       where a.active='1'
                       and   a.org_id='".$orgid."'
                       and   a.position_id=(select position_id from dt01_hrd_position_dt where active='1' and org_id=a.org_id and user_id='".$userid."')
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function updateeticket($transid,$data){           
            $sql =   $this->db->update("dt01_it_support_eticket_hd",$data,array("trans_id"=>$transid));
            return $sql;
        }

    }
?>