<?php
    class Modeltilaka extends CI_Model{

        function pencariandata($orgid,$status){
            $query =
                    "
                        select a.no_file, source_file,
                            (select user_identifier from dt01_gen_user_data   where org_id=a.org_id and active='1' and nik=a.assign)useridentifier,
                            (select name            from dt01_gen_user_data   where org_id=a.org_id and active='1' and nik=a.assign)assignname,
                            (select document_name   from dt01_gen_document_ms where org_id=a.org_id and active='1' and jenis_doc=a.jenis_doc)jenisdocument
                        from dt01_gen_document_file_dt a
                        where a.active      = '1'
                        and   a.status_file = '1'
                        and   a.org_id      = '".$orgid."'
                        and   a.assign=(select nik from dt01_gen_user_data where org_id=a.org_id and active='1' and certificate='3' and nik=a.assign)
                        ".$status."
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

    }
?>