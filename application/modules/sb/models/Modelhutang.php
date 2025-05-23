<?php
    class Modelhutang extends CI_Model{
        
        function periode(){
            $query =
                    "
                        select distinct date_format(tgl_registrasi, '%Y')periode
                        from reg_periksa a
                        order by periode desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function dataharian($tahun) {
            $query = "
                        select a.org_id, no_pemesanan, no_pemesanan_unit, judul_pemesanan, note, subtotal, harga_ppn, total, invoice_no,
                            date(a.inv_keu_date)date,
                            date_format(a.inv_keu_date, '%d.%m.%Y') AS tanggal,
                            (select department from dt01_gen_department_ms where department_id=a.department_id)unitpemohon
                        from dt01_lgu_pemesanan_hd a
                        where a.active='1'
                        and   a.status_vice = 'Y'
                        and   a.status_dir = 'Y'
                        and   a.status not in ('15','16','17')
                        and   date_format(a.inv_keu_date, '%Y') = '".$tahun."'
                        order by org_id, inv_keu_date asc
                    ";

            $recordset = $this->db->query($query);
            return $recordset->result();
        }


    }
?>