<?php
    class Modeloverview extends CI_Model{

        function dataeticket($orgid,$user){
            $query =
                    "
                        select a.trans_id, subject, description, status, severity_id, attachment
                        from dt01_it_support_eticket_hd a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.created_by='".$user."'
                        and   a.subject <> ''
                        and   a.description <> ''
                        order by created_date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function cekdataeticket($orgid,$transid){
            $query =
                    "
                        select a.subject, description, status, severity_id
                        from dt01_it_support_eticket_hd a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.trans_id='".$transid."'
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

        function inserteticket($data){           
            $sql =   $this->db->insert("dt01_it_support_eticket_hd",$data);
            return $sql;
        }

        function updateeticket($transid,$data){           
            $sql =   $this->db->update("dt01_it_support_eticket_hd",$data,array("trans_id"=>$transid));
            return $sql;
        }

    }
?>