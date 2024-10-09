<?php
    class Modelenvironment extends CI_Model{

        function masterenvironment($orgid){
            $query =
                    "
                        select a.env_id, environment_name, dev, prod
                        from dt01_gen_enviroment_ms a
                        where a.org_id='".$orgid."'
                        order by urut ASC
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updateenvironment($envid,$data){           
            $sql =   $this->db->update("dt01_gen_enviroment_ms",$data,array("env_id"=>$envid));
            return $sql;
        }


    }
?>