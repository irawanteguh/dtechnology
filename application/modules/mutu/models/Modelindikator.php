<?php
    class Modelindikator extends CI_Model{
        
        function masterindikator($orgid){

            $query = "
                        select a.mutu, definisi_operasional, numerator, denumerator, target, dimensi_mutu, tujuan, dasar_pemikiran, jenis_indikator, kriteria_inklusi, kriteria_eksklusi, formula
                        from dt01_mutu_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by jenis_indikator, mutu
                    ";

            $recordset = $this->db->query($query);
            return $recordset->result();
        }

    }
?>