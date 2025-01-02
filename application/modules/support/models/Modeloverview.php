<?php
    class Modeloverview extends CI_Model{

        function dataeticket($orgid,$user){
            $query =
                    "
                        select a.subject, description, status, severity
                        from dt01_it_support_eticket_hd a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.created_by='".$user."'
                        order by created_date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function inserteticket($data){           
            $sql =   $this->db->insert("dt01_it_support_eticket_hd",$data);
            return $sql;
        }

    }
?>