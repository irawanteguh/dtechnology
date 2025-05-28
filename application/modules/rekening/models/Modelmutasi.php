<?php
    class Modelmutasi extends CI_Model{

        function rekening($orgid){
            $query =
                    "
                        select a.rekening_id, concat(account,' ',account_id)keterangan
                        from dt01_keu_rekening_ms a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                        order by account asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function datamutasi($orgid,$rekeningid,$parameter){
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
                        and   a.rekening_id='".$rekeningid."'
                        ".$parameter."
                        order by rekeningname asc, created_date asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

    }
?>