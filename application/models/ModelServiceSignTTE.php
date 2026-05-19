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
                        SELECT 
                            a.org_id,
                            a.transaksi_id,
                            a.no_file,
                            a.signer_id,
                            a.storage_in,
                            a.storage_out,
                            a.type_of,
                            a.type_certificate,
                            a.signature_type,
                            a.signature_field,
                            a.from_in,
                            DATE_FORMAT(a.created_date,'%d-%m-%Y %H:%i:%s') AS createddate,

                            (
                                SELECT GROUP_CONCAT(
                                    b.user_identifier
                                    ORDER BY FIND_IN_SET(
                                        b.nik,
                                        REPLACE(a.signer_id, ';', ',')
                                    )
                                    SEPARATOR ';'
                                )
                                FROM dt01_gen_user_data b
                                WHERE FIND_IN_SET(
                                    b.nik,
                                    REPLACE(a.signer_id, ';', ',')
                                )
                            ) AS useridentifier,

                            (
                                SELECT GROUP_CONCAT(
                                    b.name
                                    ORDER BY FIND_IN_SET(
                                        b.nik,
                                        REPLACE(a.signer_id, ';', ',')
                                    )
                                    SEPARATOR ';'
                                )
                                FROM dt01_gen_user_data b
                                WHERE FIND_IN_SET(
                                    b.nik,
                                    REPLACE(a.signer_id, ';', ',')
                                )
                            ) AS name

                        FROM dt01_sign_document_dt a
                        WHERE a.status_sign = '0'
                        AND a.provider_sign = 'Tilaka'
                        LIMIT 20;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function requestquicksign(){
            $query =
                    "
                        SELECT 
                            a.org_id,
                            a.transaksi_id,
                            a.no_file,
                            a.filename,
                            a.storage_in,
                            a.storage_out,
                            a.signer_id,
                            a.type_certificate,
                            a.signature_type,
                            a.signature_field,
                            a.user_identifier AS useridentifier,
                            a.from_in,

                            DATE_FORMAT(
                                a.created_date,
                                '%d-%m-%Y %H:%i:%s'
                            ) AS createddate,

                            (
                                SELECT GROUP_CONCAT(
                                    b.name
                                    ORDER BY FIND_IN_SET(
                                        b.nik,
                                        REPLACE(a.signer_id, ';', ',')
                                    )
                                    SEPARATOR ';'
                                )
                                FROM dt01_gen_user_data b
                                WHERE FIND_IN_SET(
                                    b.nik,
                                    REPLACE(a.signer_id, ';', ',')
                                )
                            ) AS name,

                            (
                                SELECT GROUP_CONCAT(
                                    b.email
                                    ORDER BY FIND_IN_SET(
                                        b.nik,
                                        REPLACE(a.signer_id, ';', ',')
                                    )
                                    SEPARATOR ';'
                                )
                                FROM dt01_gen_user_data b
                                WHERE FIND_IN_SET(
                                    b.nik,
                                    REPLACE(a.signer_id, ';', ',')
                                )
                            ) AS email,

                            (
                                SELECT org_name
                                FROM dt01_gen_organization_ms
                                WHERE org_id = a.org_id
                            ) AS orgname

                        FROM dt01_sign_document_dt a

                        WHERE a.status_sign = '1'
                        AND a.provider_sign = 'Tilaka'
                        AND a.type_of = 'Signature'
                        AND a.quick_sign IN ('0','2')

                        AND NOT EXISTS (
                            SELECT 1
                            FROM dt01_sign_document_dt b
                            WHERE b.status_sign = '2'
                            AND b.provider_sign = 'Tilaka'
                            AND b.type_of = 'Signature'
                            AND b.quick_sign = '2'

                            AND (
                                FIND_IN_SET(
                                    b.signer_id,
                                    REPLACE(a.signer_id, ';', ',')
                                )
                                OR
                                FIND_IN_SET(
                                    a.signer_id,
                                    REPLACE(b.signer_id, ';', ',')
                                )
                            )
                        )

                        GROUP BY a.transaksi_id

                        ORDER BY a.upload_date ASC

                        LIMIT 10;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function requestregulersign(){
            $query =
                    "
                        SELECT DISTINCT
                            a.org_id,
                            a.signer_id,
                            a.user_identifier AS useridentifier,
                            a.from_in,
                            a.storage_in,
                            a.signature_type,
                            a.signature_field,

                            (
                                SELECT GROUP_CONCAT(
                                    b.name
                                    ORDER BY FIND_IN_SET(
                                        b.nik,
                                        REPLACE(a.signer_id, ';', ',')
                                    )
                                    SEPARATOR ';'
                                )
                                FROM dt01_gen_user_data b
                                WHERE b.org_id = a.org_id
                                AND FIND_IN_SET(
                                    b.nik,
                                    REPLACE(a.signer_id, ';', ',')
                                )
                            ) AS name,

                            (
                                SELECT GROUP_CONCAT(
                                    b.email
                                    ORDER BY FIND_IN_SET(
                                        b.nik,
                                        REPLACE(a.signer_id, ';', ',')
                                    )
                                    SEPARATOR ';'
                                )
                                FROM dt01_gen_user_data b
                                WHERE b.org_id = a.org_id
                                AND FIND_IN_SET(
                                    b.nik,
                                    REPLACE(a.signer_id, ';', ',')
                                )
                            ) AS email,

                            (select org_name from dt01_gen_organization_ms where org_id=a.org_id)orgname

                        FROM dt01_sign_document_dt a

                        WHERE a.active = '1'
                        AND a.status_sign = '1'
                        AND a.quick_sign = '1'

                        LIMIT 10;
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

        // function statussignquicksign(){
        //     $query =
        //             "
        //                 (
        //                     SELECT 
        //                         '2' AS jenis,
        //                         a.transaksi_id,
        //                         a.request_id,
        //                         a.user_identifier AS useridentifier,
        //                         a.storage_out,
        //                         a.requestsign_date
        //                     FROM dt01_sign_document_dt a
        //                     WHERE a.active='1'
        //                     AND a.status_sign in ('3','4')
        //                     AND a.quick_sign='2'
        //                     AND a.provider_sign='Tilaka'
        //                 )
        //                 UNION ALL
        //                 (
        //                     select distinct 
        //                         '1' AS jenis,
        //                         a.transaksi_id,
        //                         a.request_id,
        //                         a.user_identifier AS useridentifier,
        //                         a.storage_out,
        //                         a.requestsign_date
        //                     FROM dt01_sign_document_dt a
        //                     WHERE a.active='1'
        //                     AND a.status_sign='6'
        //                     AND a.quick_sign='1'
        //                     AND a.provider_sign='Tilaka'
        //                 )
        //                 ORDER BY requestsign_date ASC
        //                 LIMIT 20;
        //             ";

        //     $recordset = $this->db->query($query);
        //     $recordset = $recordset->result();
        //     return $recordset;
        // }

        function statussignquicksign(){
            $query =
                    "
                        SELECT
                            CASE
                                WHEN a.quick_sign = '2' THEN '2'
                                WHEN a.quick_sign = '1' THEN '1'
                            END AS jenis,

                            a.transaksi_id,
                            a.request_id,
                            a.user_identifier AS useridentifier,
                            a.storage_out,
                            a.requestsign_date

                        FROM dt01_sign_document_dt a

                        WHERE a.active = '1'
                        AND a.provider_sign = 'Tilaka'

                        AND (
                                (
                                    a.status_sign IN ('3','4')
                                    AND a.quick_sign = '2'
                                )

                                OR

                                (
                                    a.status_sign = '6'
                                    AND a.quick_sign in ('1','2')
                                )
                            )

                        ORDER BY a.requestsign_date ASC

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
                        and   a.status_sign in ('4','7')
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