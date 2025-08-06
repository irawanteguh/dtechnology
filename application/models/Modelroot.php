<?php
    class Modelroot extends CI_Model{

        function environment($dtechclientid){
            $query =
                    "
                        select a.*
                        from dt01_gen_enviroment_ms a
                        where a.active='1'
                        and   a.org_id='".$dtechclientid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result_array();
            return $recordset;
        }

        function menu($parameter){
            $query =
                    "
                        select a.*
                        from dt01_gen_modules_ms a
                        where a.active='1'
                        and   a.parent='C'

                        union

                        select a.*
                        from dt01_gen_modules_ms a
                        where a.active='1'
                        ".$parameter."
                        order by urut asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result_array();
            return $recordset;
        }

        function referensi(){
            $query =
                    "
                        select a.*
                        from dt01_gen_referensi_dt a
                        where a.active='1'
                        order by referensi asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result_array();
            return $recordset;
        }

    }
?>