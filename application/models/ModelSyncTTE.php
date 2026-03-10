<?php
    class ModelSyncTTE extends CI_Model{

        function datatransaksi(){
            $query =
                    "
                        select a.org_id, no_file, assign, pasien_idx, transaksi_idx, source_file,
                            (select document_name from dt01_gen_document_ms where jenis_doc=a.jenis_doc)jenisdocument
                        from dt01_gen_document_file_dt a
                        where a.active='1'
                        and   a.status_sign='0'
                        and   a.assign in ('2501785','2501756')
                        and   a.no_file not in (select no_file from dt01_sign_document_dt)
                        limit 5;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertdocument($data){           
            $sql =   $this->db->insert("dt01_sign_document_dt",$data);
            return $sql;
        }
        
    }
?>