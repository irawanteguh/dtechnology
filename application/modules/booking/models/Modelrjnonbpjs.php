<?php
    class Modelrjnonbpjs extends CI_Model{
        
        function datapasien($parameter){
            $query =
                    "
                        select a.no_rkm_medis, nm_pasien
                        from pasien a
                        where a.no_rkm_medis='".$parameter."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        
    }
?>