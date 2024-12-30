<?php
    class Modelrepodocument extends CI_Model{

        function datarepository($parameter){
            $query =
                    "
                        select a.trans_id, no_file, filename, note_1, note_2, location, type, date_format(created_date,'%d.%m.%Y %H:%i:%s')tgljam, status,
                                (select name from dt01_gen_user_data where active='1' and user_id=a.created_by)createdby,
                                (select document_name from dt01_gen_document_ms where active='1' and jenis_doc=a.jenis_doc)jenisdocument,
                                (
                                    SELECT GROUP_CONCAT((select name from dt01_gen_user_data where nik=b.nik) SEPARATOR ';') 
                                    FROM dt01_gen_tte_it b
                                    WHERE b.active='1'
                                    and   b.no_file=a.no_file
                                ) assign
                        from dt01_gen_tte_hd a
                        where a.active='1'
                        ".$parameter."
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterdocument($orgid){
            $query =
                    "
                        select a.jenis_doc, document_name
                        from dt01_gen_document_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by document_name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function userassign($orgid){
            $query =
                    "
                        select a.nik, replace(name,',','.')name
                        from dt01_gen_user_data a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.certificate='3'
                        order by name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertsigndocument($data){           
            $sql =   $this->db->insert("dt01_gen_tte_hd",$data);
            return $sql;
        }

        function insertsigndocumentassign($data){           
            $sql =   $this->db->insert("dt01_gen_tte_it",$data);
            return $sql;
        }

        function updatefile($data,$transid){           
            $sql =   $this->db->update("dt01_gen_tte_hd",$data,array("trans_id"=>$transid));
            return $sql;
        }

    }
?>