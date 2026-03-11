<?php
    class ModelSyncTTE extends CI_Model{

        function datatransaksi(){
            $query =
                    "
                        SELECT 
                            a.org_id,
                            a.no_file,
                            a.assign,
                            a.pasien_idx,
                            a.transaksi_idx,
                            a.source_file,
                            b.document_name AS jenisdocument
                        FROM dt01_gen_document_file_dt a
                        LEFT JOIN dt01_gen_document_ms b 
                            ON b.jenis_doc = a.jenis_doc
                        WHERE a.active = '1'
                        AND   a.assign <> ''
                        AND   a.status_sign IN ('1','0')
                        AND   a.created_date >= DATE_FORMAT(NOW(), '%Y-%m-01')
                        AND   a.created_date <  DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 1 MONTH), '%Y-%m-01')
                        AND   NOT EXISTS (
                                SELECT 1
                                FROM dt01_sign_document_dt c
                                WHERE c.no_file = a.no_file
                        )
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
        
    }
?>