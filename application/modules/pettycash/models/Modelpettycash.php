<?php
    class Modelpettycash extends CI_Model{
        
        function nokwitansi($orgid){
            $query =
                    "
                        select concat(
                                        
                                        lpad(
                                            coalesce(
                                                (
                                                    select COUNT(transaksi_id)+1
                                                    from dt01_keu_rekening_it
                                                    where org_id='".$orgid."'
                                                    and   date_format(created_date, '%Y') = date_format(current_date, '%Y')
                                                ),
                                                1
                                            ),
                                            3,
                                            '0'
                                        ),
                                        '/CASH/KEU/',
                                        date_format(now(), '%m'),
                                        '/',
                                        date_format(now(), '%Y')
                                ) nokwitansi

                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

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

        function datapettycash($orgid,$parameter){
            $query =
                    "
                        select a.transaksi_id, no_kwitansi, note, cash_in, cash_out, balance, status, date_format(a.created_date, '%d.%m.%Y %H:%i:%s')tglbuat,
                               (select account from dt01_keu_rekening_ms where org_id=a.org_id and rekening_id=a.rekening_id)rekeningname,
                               (select account_id from dt01_keu_rekening_ms where org_id=a.org_id and rekening_id=a.rekening_id)rekeningid,
                               (select name from dt01_gen_user_data where active=a.active and org_id=a.org_id and user_id=a.created_by)dibuatoleh,
                               (select department from dt01_gen_department_ms where org_id=a.org_id and active=a.active and department_id=a.department_id)unit
                        from dt01_keu_rekening_it a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        ".$parameter."
                        order by rekeningname asc, created_date asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function checkbalancelast($orgid){
            $query =
                    "
                        select a.balance
                        from dt01_keu_rekening_it a
                        where a.active='1'
                        and   a.status='6'
                        and   a.org_id='".$orgid."'
                        order by created_date desc
                        limit 1;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertpettycash($data){           
            $sql =   $this->db->insert("dt01_keu_rekening_it",$data);
            return $sql;
        }

        function updatepettycash($transaksiid,$data){           
            $sql =   $this->db->update("dt01_keu_rekening_it",$data,array("transaksi_id"=>$transaksiid));
            return $sql;
        }

    }
?>