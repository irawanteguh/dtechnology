<?php
    class Modelsigndocument extends CI_Model{

        function statusdocument($nofile){
            $query =
                    "
                        select a.no_file, created_date, jenis_doc, pasien_idx, transaksi_idx, note, active, status_sign, status_file,
                            (select document_name from dt01_gen_document_ms where jenis_doc=a.jenis_doc)typedocument,
                            (select name from dt01_gen_user_data where nik=a.assign)assignname,
                            (select master_name from dt01_gen_master_ms where jenis_id='Statussign_1' and code=a.status_sign)status
                        from dt01_gen_document_file_dt a
                        where a.no_file='".$nofile."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function insertsigndocument($data){           
            $sql =   $this->db->insert("dt01_gen_document_file_dt",$data);
            return $sql;
        }

    }
?>