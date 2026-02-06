<?php
    class Modelmekari extends CI_Model{
        
        function liststatus(){
            $query =
                    "
                        select distinct a.email, user_id
                        from dt01_tte_user_mekari_dt a
                        where a.status='not_started'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertusermekari($data){           
            $sql =   $this->db->insert("dt01_tte_user_mekari_dt",$data);
            return $sql;
        }


        
    }
?>