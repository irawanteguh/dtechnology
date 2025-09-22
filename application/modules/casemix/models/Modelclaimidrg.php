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


    }
?>