<?php
    class Modelclaimidrg extends CI_Model{

        function mastericd10($keyword){
            $query =
                    "
                        select x.*
                        from(
                            select a.code, code_2, concat(a.code,' ',description)description, validcode
                            from dt01_casemix_icd_ms a
                            where a.system='ICD_10_2010_IM'
                        )x
                        where upper(x.description) like upper('".$keyword."%')
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function jeniskelamin(){
            $query =
                    "
                        select '1' code,'Laki-laki'keterangan union 
                        select '2' code,'Perempuan'keterangan
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function jenisrawat(){
            $query =
                    "
                        select '1' code,'Rawat Inap'keterangan union 
                        select '2' code,'Rawat Jalan'keterangan union
                        select '3' code,'Rawat IGD'keterangan
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function kelasrawat(){
            $query =
                    "
                        select '1' code,'Kelas 1'keterangan union 
                        select '2' code,'Kelas 2'keterangan union
                        select '3' code,'Kelas 3'keterangan
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }


    }
?>