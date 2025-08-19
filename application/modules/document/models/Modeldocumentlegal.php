<?php
    class Modeldocumentlegal extends CI_Model{

        function masterdocument(){
            $query =
                    "
                        select a.jenis_doc, document_name
                        from dt01_gen_document_ms a
                        where a.active='1'
                        and   a.jenis_id='2'
                        order by document_name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function calender($orgid){
            $query =
                    "
                        select a.transaksi_id, '1' jenisid,
                            concat(DATE_FORMAT(a.date_active, '%Y-%m-%d'))berlakumulai,
                            concat(DATE_FORMAT(a.date_active, '%Y-%m-%d'))sampaidengan,
                            (select document_name from dt01_gen_document_ms where jenis_doc=a.jenis_doc)jenisdocument
                        from dt01_gen_document_legal_dt a
                        where a.active='1'
                        and   a.org_id='".$orgid."'

                        union

                        select a.transaksi_id, '2' jenisid,
                            DATE_FORMAT(DATE_SUB(a.exp_date, INTERVAL 6 MONTH), '%Y-%m-%d') AS berlakumulai,
                            DATE_FORMAT(DATE_SUB(a.exp_date, INTERVAL 1 DAY), '%Y-%m-%d')   AS sampaidengan,
                            (select document_name from dt01_gen_document_ms where jenis_doc=a.jenis_doc)jenisdocument
                        from dt01_gen_document_legal_dt a
                        where a.active='1'
                        and   a.org_id='".$orgid."'

                        union

                        select a.transaksi_id, '3' jenisid,
                            concat(DATE_FORMAT(a.exp_date, '%Y-%m-%d'))berlakumulai,
                            concat(DATE_FORMAT(a.exp_date, '%Y-%m-%d'))sampaidengan,
                            (select document_name from dt01_gen_document_ms where jenis_doc=a.jenis_doc)jenisdocument
                        from dt01_gen_document_legal_dt a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function documentlegal($orgid){
            $query =
                    "
                        select a.transaksi_id, jenis_doc, judul, keterangan, date_Active, exp_date,
                            date_format(a.date_Active,'%d.%m.%Y')berlakumulai,
                            date_format(a.exp_date,'%d.%m.%Y')sampaidengan,
                            date_format(a.created_date,'%d.%m.%Y %H:%i:%s')tgldibuat,
                            (select name from dt01_gen_user_data where active='1' and user_id=a.created_by)dibuatoleh,
                            (select document_name from dt01_gen_document_ms where jenis_doc=a.jenis_doc)jenisdocument
                        from dt01_gen_document_legal_dt a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by created_date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertdocument($data){           
            $sql =   $this->db->insert("dt01_gen_document_legal_dt",$data);
            return $sql;
        }
        
    }
?>