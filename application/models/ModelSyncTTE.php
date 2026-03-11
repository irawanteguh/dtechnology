<?php
    class ModelSyncTTE extends CI_Model{

        function datatransaksi(){
            $query =
                    "
                        SELECT distinct 
                            a.org_id,
                            a.no_file,
                            a.assign,
                            a.pasien_idx,
                            a.transaksi_idx,
                            a.source_file,
                            a.jenis_doc
                        FROM dt01_gen_document_file_dt a
                        WHERE a.active = '1'
                        AND   a.assign <> ''
                        AND   a.status_sign='0'
                        LIMIT 10;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertdocument($data){           
            $sql =   $this->db->insert("dt01_sign_document_dt",$data);
            return $sql;
        }

        function updatedocument($data,$no_file){           
            $sql =   $this->db->update("dt01_gen_document_file_dt",$data,array("no_file"=>$no_file));
            return $sql;
        }
        
    }
?>