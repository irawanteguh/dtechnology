<?php
    class Modeleticketview extends CI_Model{

        function dataeticket($orgid,$user){
            $query =
                    "
                        select a.trans_id, subject, description, status, severity_id, attachment, category_id, date_format(created_date, '%d.%m.%Y %H:%i:%s')createddate,
                               (select name from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=a.created_by)dibuatoleh,
                               (select department from dt01_gen_department_ms where active='1' and org_id=a.org_id and department_id=a.department_id)department,
                               (select master_name from dt01_gen_master_ms where active='1' and org_id=a.org_id and master_id=a.severity_id)severity,
                               (select master_name from dt01_gen_master_ms where active='1' and org_id=a.org_id and master_id=a.category_id)category,
                               (select master_name from dt01_gen_master_ms where active='1' and org_id=a.org_id and master_id=a.problem_id)problem
                        from dt01_it_support_eticket_hd a
                        where a.active='1'
                        and   a.status in ('2','4')
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

        function masterseverity($orgid){
            $query =
                    "
                        select a.master_id, master_name
                        from dt01_gen_master_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.jenis_id='Severity_1'
                        order by urut asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterpic($orgid){
            $query =
                    "
                        select a.master_id, master_name
                        from dt01_gen_master_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.jenis_id='Category_1'
                        order by urut asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterproblem($orgid){
            $query =
                    "
                        select a.master_id, master_name
                        from dt01_gen_master_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.jenis_id='Problem_1'
                        order by urut asc
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