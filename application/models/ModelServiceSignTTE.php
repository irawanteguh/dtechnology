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

        function uploaddocument(){
            $query =
                    "
                        select a.org_id, transaksi_id, no_file, signer_id, storage_in, storage_out, type_of, type_certificate, signature_type, signature_field, from_in, DATE_FORMAT(a.created_date,'%d-%m-%Y %H:%i:%s') createddate,
                            (select user_identifier from dt01_gen_user_data where nik=a.signer_id)useridentifier,
                            (select name from dt01_gen_user_data where nik=a.signer_id)name
                        from dt01_sign_document_dt a
                        where a.status_sign='0'
                        and   a.provider_sign='Tilaka'
                        limit 5;
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
                        group by a.transaksi_id
                        order by upload_date asc
                        limit 5;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function statussignquicksign(){
            $query =
                    "
                        select a.transaksi_id, request_id, user_identifier useridentifier, storage_out
                        from dt01_sign_document_dt a
                        where a.active='1'
                        and   a.status_sign='3'
                        and   a.quick_sign='2'
                        and   a.provider_sign='Tilaka'
                        group by a.transaksi_id
                        order by requestsign_date asc
                        limit 5;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updatedocument($data,$transaksiid){           
            $sql =   $this->db->update("dt01_sign_document_dt",$data,array("transaksi_id"=>$transaksiid));
            return $sql;
        }
        
    }
?>