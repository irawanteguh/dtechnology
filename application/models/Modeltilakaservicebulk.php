<?php
    class Modeltilakaservicebulk extends CI_Model{

        function dataupload($orgid){
            $query =
                    "
                        select a.trans_id, no_file, location
                        from dt01_gen_tte_hd a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.status='1' or response='File Not Found'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function datasignerdocument($orgid){
            $query =
                    "
                        select a.trans_id, nik, type, tag, no_file,
                            (select user_identifier from dt01_gen_user_data where active=a.active and org_id=a.org_id and nik=a.nik)useridentifier,
                            (select location from dt01_gen_tte_hd where active=a.active and org_id=a.org_id and no_file=a.no_file)location
                        from dt01_gen_tte_it a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.status='0'
                        and   a.nik=(select nik from dt01_gen_user_data where active=a.active and org_id=a.org_id and nik=a.nik and user_identifier<>'')
                        and   a.no_file=(select no_file from dt01_gen_tte_hd where active=a.active and org_id=a.org_id and no_file=a.no_file and status='2')
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updatefile($data,$transid){           
            $sql =   $this->db->update("dt01_gen_tte_hd",$data,array("trans_id"=>$transid));
            return $sql;
        }

        function updatesigner($data,$transid){           
            $sql =   $this->db->update("dt01_gen_tte_it",$data,array("trans_id"=>$transid));
            return $sql;
        }

    }
?>