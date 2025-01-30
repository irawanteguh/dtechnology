<?php
    class Modelpettycash extends CI_Model{
        

        function masterunit($orgid,$parameter){
            $query =
                    "
                        select a.department_id, department
                        from dt01_gen_department_ms a
                        where a.org_id='".$orgid."'
                        ".$parameter."
                        and   a.active='1'
                        order by department asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function datapettycash($orgid){
            $query =
                    "
                        select a.no_kwitansi, note, cash_in, cash_out, balance, date_format(a.created_date, '%d.%m.%Y %H:%i:%s')tglbuat,
                               (select name from dt01_gen_user_data where active=a.active and org_id=a.org_id and user_id=a.created_by)dibuatoleh,
                               (select department from dt01_gen_department_ms where org_id=a.org_id and active=a.active and department_id=a.department_id)unit
                        from dt01_keu_petty_cash_it a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by created_date asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function checkbalancelast($orgid){
            $query =
                    "
                        select a.balance
                        from dt01_keu_petty_cash_it a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by created_date desc
                        limit 1;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertpettycash($data){           
            $sql =   $this->db->insert("dt01_keu_petty_cash_it",$data);
            return $sql;
        }

    }
?>