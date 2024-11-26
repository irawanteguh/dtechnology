<?php
    class Modelappmanager extends CI_Model{
        
        function datarequest($orgid,$userid){
            $query =
                    "
                        select a.no_pemesanan, judul_pemesanan, note, subtotal, harga_ppn, total, status, invoice, attachment, date_format(a.created_date, '%d.%m.%Y %H:%i:%s')tglbuat,
                            (select name from dt01_gen_user_data where org_id=a.org_id and active=a.active and user_id=a.created_by)dibuatoleh,
                            (select department from dt01_gen_department_ms where org_id=a.org_id and active=a.active and department_id=a.department_id)unit,

                            case 
                                when status = '0'  then 'badge-light-info|New'
                                when status = '1'  then 'badge-light-danger|Cancelled'
                                when status = '2'  then 'badge-light-info|Waiting Approval Manager'
                                when status = '3'  then 'badge-light-danger|Cancelled Manager'
                                when status = '4'  then 'badge-light-info|Approval Manager'
                                when status = '5'  then 'badge-light-danger|Cancelled Finance'
                                when status = '6'  then 'badge-light-info|Approval Finance'
                                when status = '7'  then 'badge-light-danger|Cancelled Vice Director'
                                when status = '8'  then 'badge-light-info|Approval Vice Director'
                                when status = '9'  then 'badge-light-danger|Cancelled Director'
                                when status = '10' then 'badge-light-info|Approval Director'
                                when status = '11' then 'badge-light-info|Invoice Submission'
                                when status = '12' then 'badge-light-danger|Invoice Cancelled Manager'
                                when status = '13' then 'badge-light-info|Invoice Approval Manager'
                                when status = '14' then 'badge-light-danger|Invoice Cancelled Vice Director'
                                when status = '15' then 'badge-light-info|Invoice Approval Vice Director'
                                when status = '16' then 'badge-light-danger|Invoice Cancelled Director'
                                when status = '17' then 'badge-light-info|Invoice Approval Director'
                                when status = '18' then 'badge-light-danger|Invoice Cancelled Finance'
                                when status = '19' then 'badge-light-info|Invoice Approval Finance'
                                when status = '20' then 'badge-light-success|Payment Success'
                                else 'badge-light-secondary|Unknown'
                            end as decoded_status

                        from dt01_lgu_pemesanan_hd a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                        and   a.status in ('2','3','4','11','12','13','20')
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