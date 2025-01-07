<?php
    class Modeltilakaservicebulk extends CI_Model{

        function dataupload($parameter){
            $query =
                    "
                        select a.no_file, location,
                               (select user_identifier from dt01_gen_user_data where org_id=a.org_id and active='1' and certificate='3' and nik=(select nik from dt01_gen_tte_it where active='1' and org_id=a.org_id and status='0' and no_file=a.no_file))useridentifier,
                               (select type from dt01_gen_tte_it where active='1' and org_id=a.org_id and status='0' and no_file=a.no_file)type
                        from dt01_gen_tte_hd a
                        where a.active='1'
                        ".$parameter."
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function datasignerdocument($orgid){
            $query =
                    "
                        select distinct a.nik,
                            (select user_identifier from dt01_gen_user_data where org_id=a.org_id and active='1' and certificate='3' and nik=a.nik)useridentifier,
                            (select name            from dt01_gen_user_data where org_id=a.org_id and active='1' and certificate='3' and nik=a.nik)name
                        from dt01_gen_tte_it a
                        where a.active='1'
                        and   a.status='0'
                        and   a.org_id='".$orgid."'
                        and   a.nik=(select nik from dt01_gen_user_data where org_id=a.org_id and active='1' and certificate='3' and user_identifier<>'' and nik=a.nik)
                        and   a.no_file=(select no_file from dt01_gen_tte_hd where org_id=a.org_id and active='1' and status='2' and type='S' and no_file=a.no_file)
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function datalisfile($orgid,$nik){
            $query =
                    "
                        select a.no_file, filename, location,
                               (select org_name      from dt01_gen_organization_ms where active='1' and org_id=a.org_id)orgname
                        from dt01_gen_tte_hd a
                        where a.active='1'
                        and   a.status='2'
                        and   a.type='S'
                        and   a.org_id='".$orgid."'
                        and   a.no_file in (select no_file from dt01_gen_tte_it where org_id=a.org_id and active='1' and status='0' and nik='".$nik."')
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function positionsign($orgid,$nik,$nofile){
            $query =
                    "
                        select a.type, coordinate_x, coordinate_y, page
                        from dt01_gen_tte_it a
                        where a.active='1'
                        and   a.status='0'
                        and   a.org_id='".$orgid."'
                        and   a.nik=(select nik from dt01_gen_user_data where org_id=a.org_id and active='1' and certificate='3' and user_identifier<>''and nik='".$nik."')
                        and   a.no_file='".$nofile."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updatefile($data,$transid){           
            $sql =   $this->db->update("dt01_gen_tte_hd",$data,array("no_file"=>$transid));
            return $sql;
        }

        function updatefilename($data,$filename){           
            $sql =   $this->db->update("dt01_gen_tte_hd",$data,array("filename"=>$filename));
            return $sql;
        }

        function updatesigner($data,$transid){           
            $sql =   $this->db->update("dt01_gen_tte_it",$data,array("no_file"=>$transid));
            return $sql;
        }

    }
?>