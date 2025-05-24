<?php
    class Modelpiutang extends CI_Model{
        
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
                        select a.org_id, ptd, date(admission_date)date, date_format(a.admission_date, '%d.%m.%Y') AS tanggal, mrn, nama_pasien, nokartu, sep, dpjp, tarif_inacbg
                        from dt01_casemix_claim a
                        where date_format(a.admission_date, '%Y') = '".$tahun."'
                        order by org_id, admission_date asc
                    ";

            $recordset = $this->db->query($query);
            return $recordset->result();
        }


    }
?>