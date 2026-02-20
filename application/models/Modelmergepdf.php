<?php
    class Modelmergepdf extends CI_Model{

        function listmerge(){
            $query =
                    "
                        select x.*
                        from(
                            select distinct a.pasien_idx, transaksi_idx, count(no_file)jml
                            from dt01_gen_document_file_dt a
                            where a.active='1'
                            and   a.status_sign='5'
                            and   a.status_file='1'
                            group by a.pasien_idx, transaksi_idx
                        )x
                        where x.jml > 1
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function listfiles($transaksiid){
            $query =
                    "
                        select distinct a.no_file, source_file
                        from dt01_gen_document_file_dt a
                        where a.active='1'
                        and   a.status_sign='5'
                        and   a.status_file='1'
                        and   a.transaksi_idx='".$transaksiid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

    }
?>