<?php
    class Modeldocument extends CI_Model{

        function mastertypedocument(){
            $query =
                    "
                        select '1'jenis_id, 'Dokumen Rekam Medis'keterangan union
                        select '2'jenis_id, 'Dokumen Legal Rumah Sakit'keterangan
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterdocument(){
            $query =
                    "
                        select a.jenis_doc, document_name
                        from dt01_gen_document_ms a
                        where a.active='1'
                        order by jenis_id desc, document_name asc
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