<?php
    class Modelregistrasiusertilaka extends CI_Model{

        function datakaryawan($orgid,$parameter)
        {
            $query =
                    "
                        select a.*
                        from dt01_gen_user_data a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                        and   a.nik='1521027'
                        and   a.name like '%".$parameter."%' or a.identity_no like '%".$parameter."%' or a.email like '%".$parameter."%'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function dataregistrasi($orgid,$userid)
        {
            $query =
                    "
                        select a.*
                        from dt01_gen_user_data a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                        and   a.user_id='".$userid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }


    }
?>