<?php
    class Modeleticketview extends CI_Model{

        function dataeticket($orgid,$user){
            $query =
                    "
                        select a.trans_id, subject, description, status, severity, attachment, date_format(created_date, '%d.%m.%Y %H:%i:%s')createddate,
                               (select name from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=a.created_by)dibuatoleh,
                               (select department from dt01_gen_department_ms where active='1' and org_id=a.org_id and department_id=a.department_id)department
                        from dt01_it_support_eticket_hd a
                        where a.active='1'
                        and   a.status='2'
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

        function masterseverity(){
            $query =
                    "
                        select '0'id, 'Low'metod union
                        select '1'id, 'Middle' metod union
                        select '2'id, 'High' metod
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterpic(){
            $query =
                    "
                        select '0'id, 'Software'metod union
                        select '1'id, 'Database Administrator' metod union
                        select '2'id, 'Network' metod union
                        select '3'id, 'Hardware' metod union
                        select '4'id, 'Analyst' metod
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updateeticket($transid,$data){           
            $sql =   $this->db->update("dt01_it_support_eticket_hd",$data,array("trans_id"=>$transid));
            return $sql;
        }

    }
?>