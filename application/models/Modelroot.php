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

        // function menu(){
        //     $query =
        //             "
        //                 select a.*
        //                 from dt01_gen_modules_ms a
        //                 where a.active='1'
        //                 order by urut asc
        //             ";

        //     $recordset = $this->db->query($query);
        //     $recordset = $recordset->result_array();
        //     return $recordset;
        // }

        function menu($userid){
            $query =
                    "
                        select a.*
                        from dt01_gen_modules_ms a
                        where a.active='1'
                        and   a.modules_id in (select modules_id from dt01_gen_role_dt where active='1' and role_id in(select role_id from dt01_gen_role_access where active='1' and user_id='".$userid."'))
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