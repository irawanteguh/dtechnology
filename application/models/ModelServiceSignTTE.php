<?php
    class ModelServiceSignTTE extends CI_Model{

        function checkduplicate($nofile){
            $query =
                    "
                        select count(no_file)jml
                        from dt01_sign_document_dt a
                        where a.active='1'
                        and   a.no_file='".$nofile."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function checkdocumentpending($signerid){
            $query =
                    "
                        select b.transaksi_id
                        from dt01_sign_document_dt b
                        where b.status_sign = '2'
                        and b.provider_sign = 'Tilaka'
                        and b.type_of = 'Signature'
                        and b.quick_sign = '2'
                        and b.signer_id = '".$signerid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function uploaddocument(){
            $query =
                    "
                        select a.org_id, transaksi_id, no_file, signer_id, storage_in, storage_out, type_of, type_certificate, signature_type, signature_field, from_in, DATE_FORMAT(a.created_date,'%d-%m-%Y %H:%i:%s') createddate,
                            (select user_identifier from dt01_gen_user_data where nik=a.signer_id)useridentifier,
                            (select name from dt01_gen_user_data where nik=a.signer_id)name
                        from dt01_sign_document_dt a
                        where a.status_sign='0'
                        and   a.provider_sign='Tilaka'
                        limit 20;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function requestquicksign(){
            $query =
                    "
                        select a.org_id, transaksi_id, no_file, filename, storage_in, storage_out, signer_id, type_certificate, signature_type, signature_field, user_identifier useridentifier, from_in, DATE_FORMAT(a.created_date,'%d-%m-%Y %H:%i:%s') createddate,
                                (select name from dt01_gen_user_data where nik=a.signer_id)name,
                                (select email from dt01_gen_user_data where nik=a.signer_id)email,
                                (select org_name from dt01_gen_organization_ms where org_id=a.org_id)orgname
                        from dt01_sign_document_dt a
                        where a.status_sign='1'
                        and   a.provider_sign='Tilaka'
                        and   a.type_of='Signature'
                        and   a.quick_sign in ('0','2')
                        AND NOT EXISTS (
                            SELECT 1 
                            FROM dt01_sign_document_dt b
                            WHERE b.status_sign = '2'
                            AND b.provider_sign = 'Tilaka'
                            AND b.type_of = 'Signature'
                            AND b.quick_sign = '2'
                            AND b.signer_id = a.signer_id
                        )
                        group by a.transaksi_id
                        order by upload_date asc
                        limit 10;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function requestregulersign(){
            $query =
                    "
                        select distinct a.org_id, signer_id, user_identifier useridentifier, from_in, storage_in, signature_type, signature_field,
                            (select name from dt01_gen_user_data where nik=a.signer_id)name,
                            (select email from dt01_gen_user_data where nik=a.signer_id)email
                        from dt01_sign_document_dt a
                        where a.active='1'
                        and   a.status_sign='1'
                        and   a.quick_sign='1'
                        limit 10;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function requestregulersigndetail($signerid){
            $query =
                    "
                        select a.transaksi_id, no_file, filename, from_in, storage_in,
                            (select org_name from dt01_gen_organization_ms where org_id=a.org_id)orgname
                        from dt01_sign_document_dt a
                        where a.active='1'
                        and   a.status_sign='1'
                        and   a.quick_sign='1'
                        and   a.signer_id='".$signerid."'
                        limit 50;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function statussignquicksign(){
            $query =
                    "
                        (
                            SELECT 
                                '2' AS jenis,
                                a.transaksi_id,
                                a.request_id,
                                a.user_identifier AS useridentifier,
                                a.storage_out,
                                a.requestsign_date
                            FROM dt01_sign_document_dt a
                            WHERE a.active='1'
                            AND a.status_sign in ('3','4')
                            AND a.quick_sign='2'
                            AND a.provider_sign='Tilaka'
                        )
                        UNION ALL
                        (
                            select distinct 
                                '1' AS jenis,
                                ''transaksi_id,
                                a.request_id,
                                a.user_identifier AS useridentifier,
                                a.storage_out,
                                a.requestsign_date
                            FROM dt01_sign_document_dt a
                            WHERE a.active='1'
                            AND a.status_sign='6'
                            AND a.quick_sign='1'
                            AND a.provider_sign='Tilaka'
                        )
                        ORDER BY requestsign_date ASC
                        LIMIT 20;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function listexecute(){
            $query =
                    "
                        select distinct a.request_id, user_identifier useridentifier
                        from dt01_sign_document_dt a
                        where a.active='1'
                        and   a.quick_sign='1'
                        and   a.status_sign='4'
                        limit 10;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function listcompressfile(){
            $query =
                    "
                        select a.transaksi_id, user_identifier useridentifier, from_in, storage_out, no_file
                        from dt01_sign_document_dt a
                        where a.no_file='202601310000660022501756'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updatedocument($data,$transaksiid){           
            $sql =   $this->db->update("dt01_sign_document_dt",$data,array("transaksi_id"=>$transaksiid));
            return $sql;
        }

        function updatedocumentrequestid($data,$requestid){           
            $sql =   $this->db->update("dt01_sign_document_dt",$data,array("request_id"=>$requestid));
            return $sql;
        }
        
    }
?>