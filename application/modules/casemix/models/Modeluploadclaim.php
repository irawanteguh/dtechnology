<?php
    class Modeluploadclaim extends CI_Model{

        function cekdata($orgid,$sep){
            $query =
                    "
                        select a.SEP
                        from dt01_casemix_claim a
                        where a.org_id='".$orgid."'
                        and   a.SEP='".$sep."'
                        limit 1;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function insertdata($data){           
            $sql =   $this->db->insert("dt01_casemix_claim",$data);
            return $sql;
        }


    }
?>