<?php
    class Modeldocument extends CI_Model{

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

        function insertdocumentadd($data){           
            $sql =   $this->db->insert("dt01_gen_document_ms",$data);
            return $sql;
        }

    }
?>