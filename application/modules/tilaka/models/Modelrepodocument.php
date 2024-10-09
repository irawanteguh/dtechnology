<?php
    class Modelrepodocument extends CI_Model{

        function dataupload($parameter){
            $query =
                    "
                        select x.*
                        from(
                            select a.NO_FILE, FILENAME, STATUS_SIGN, STATUS_FILE, LINK, NOTE, SOURCE_FILE, created_date, DATE_FORMAT(CREATED_DATE,'%d.%m.%Y %H:%i:%s')tgljam, pasien_idx, transaksi_idx,
                                    (select USER_IDENTIFIER from dt01_gen_user_data where active='1' and nik=a.assign)useridentifier,
                                    (select NAME from dt01_gen_user_data where active='1' and nik=a.assign)assignname,
                                     (select NAME from dt01_gen_user_data where active='1' and user_id=a.created_by)createdby,
                                    (select DOCUMENT_NAME from dt01_gen_document_ms where active='1' and JENIS_DOC=a.JENIS_DOC)jenisdocumen
                            from dt01_gen_document_file_dt a
                            where a.active='1'
                            ".$parameter." 
                            and a.created_date >= NOW() - INTERVAL 3 DAY
                        )x
                        order by created_date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function checkroleaccess($orgid,$userid){
            $query =
                    "
                        select a.trans_id
                        from dt01_gen_role_access a
                        where a.org_id='".$orgid."'
                        and   a.user_id='".$userid."'
                        and   a.role_id='34c2e933-4b1b-47cd-8497-71de44ac4e01'
                        and   a.active='1'
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
                        select a.nik, name
                        from dt01_gen_user_data a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.certificate='2'
                        order by name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertsigndocument($data){           
            $sql =   $this->db->insert("dt01_gen_document_file_dt",$data);
            return $sql;
        }

        function updatefile($data,$nofile){           
            $sql =   $this->db->update("dt01_gen_document_file_dt",$data,array("NO_FILE"=>$nofile));
            return $sql;
        }


    }
?>