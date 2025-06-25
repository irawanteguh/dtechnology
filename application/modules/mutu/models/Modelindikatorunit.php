<?php
    class Modelindikatorunit extends CI_Model{
        
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

        function masterindikator($orgid,$periode,$department){
            $query = "
                        select a.mutu, definisi_operasional, numerator, denumerator, target, dimensi_mutu, tujuan, dasar_pemikiran, jenis_indikator, kriteria_inklusi, kriteria_eksklusi, formula
                        from dt01_mutu_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.mutu_id in (select mutu_id from dt01_mutu_unit_hd where active='1' and org_id='".$orgid."' and periode='".$periode."' $department)
                        order by jenis_indikator, mutu
                    ";

            $recordset = $this->db->query($query);
            return $recordset->result();
        }

    }
?>