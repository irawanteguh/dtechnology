<?php
    class Modelappmanager extends CI_Model{
        
        function datarequest($orgid,$userid){
            $query =
                    "
                        select a.no_pemesanan, judul_pemesanan, note, subtotal, harga_ppn, total, status, attachment, date_format(a.created_date, '%d.%m.%Y %H:%i:%s')tglbuat,
                            (select name from dt01_gen_user_data where org_id=a.org_id and active=a.active and user_id=a.created_by)dibuatoleh,
                            (select department from dt01_gen_department_ms where org_id=a.org_id and active=a.active and department_id=a.department_id)unit
                        from dt01_lgu_pemesanan_hd a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                        and   a.status in ('2','3','4')
                        and   a.department_id in (
                                                    select department_id
                                                    from dt01_gen_department_ms
                                                    where header_id in (
                                                                            select department_id
                                                                            from dt01_gen_department_ms
                                                                            where user_id='".$userid."'
                                                                    )
                                                )
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }


    }
?>