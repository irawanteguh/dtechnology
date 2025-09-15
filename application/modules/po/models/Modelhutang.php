<?php
    class Modelhutang extends CI_Model{
        
        function masterorganization(){
            $query =
                    "
                        select a.org_id, org_name
                        from dt01_gen_organization_ms a
                        where a.active='1'
                        and   a.holding='N'
                        order by org_name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function periode(){
            $query =
                    "
                        select distinct date_format(a.created_date, '%Y')periode
                        from dt01_lgu_pemesanan_hd a
                        order by periode desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function datahutang($orgid,$tahun) {
            $query = "
                        select a.org_id, no_pemesanan, no_pemesanan_unit, judul_pemesanan, note, subtotal, harga_ppn, total, invoice_no,
                            date(a.created_date)date,
                            date_format(a.created_date, '%d.%m.%Y') AS tanggal,
                            (select department from dt01_gen_department_ms where department_id=a.department_id)unitpemohon
                        from dt01_lgu_pemesanan_hd a
                        where a.active='1'
                        and   a.status='15'
                        and   a.org_id='".$orgid."'
                        and   date_format(a.created_date, '%Y') = '".$tahun."'
                        order by org_id, created_date asc
                    ";

            $recordset = $this->db->query($query);
            return $recordset->result();
        }


    }
?>