<?php
    class Modelrepodocument extends CI_Model{

        function dataupload($parameter,$startDate,$endDate){
            $query =
                    "
                        select x.*,
                            (select user_identifier from dt01_gen_user_data   where active='1' and certificate='3' and nik=x.assign)useridentifier,
                            (select name            from dt01_gen_user_data   where active='1' and nik=x.assign)assignname,
                            (select name            from dt01_gen_user_data   where active='1' and user_id=x.created_by)createdby,
                            (select document_name   from dt01_gen_document_ms where active='1' and jenis_doc=x.jenis_doc)jenisdocument,
                            (select master_name     from dt01_gen_master_ms   where active='1' and jenis_id='Statussign_1' and code=x.status_sign)status,
                            (select description     from dt01_gen_master_ms   where active='1' and jenis_id='Statussign_1' and code=x.status_sign)descriptionstatus,
                            (select color           from dt01_gen_master_ms   where active='1' and jenis_id='Statussign_1' and code=x.status_sign)colorstatus
                        from(
                            select a.no_file, filename, status_sign, status_file, link, note, source_file, created_date, assign, created_by, jenis_doc, pasien_idx, transaksi_idx, date_format(created_date,'%d.%m.%Y %H:%i:%s')tgljam 
                            from dt01_gen_document_file_dt a
                            where a.active='1'
                            and   a.status_sign not in ('5','99')
                            ".$parameter."

                            union

                            select a.no_file, filename, status_sign, status_file, link, note, source_file, created_date, assign, created_by, jenis_doc, pasien_idx, transaksi_idx, date_format(created_date,'%d.%m.%Y %H:%i:%s')tgljam 
                            from dt01_gen_document_file_dt a
                            where a.active='1'
                            and   a.status_sign in ('5','99')
                            and   a.created_date between '".$startDate."' and '".$endDate."'
                            ".$parameter."
                            and   a.assign=(select nik from dt01_gen_user_data where org_id=a.org_id and active='1' and certificate='3' and nik=a.assign)
                        )x
                        order by status asc, created_date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        // function dataupload($parameter,$startDate,$endDate){
        //     $query =
        //             "
        //                 SELECT 
        //                     x.*,
        //                     u1.user_identifier AS useridentifier,
        //                     u1.name            AS assignname,
        //                     u2.name            AS createdby,
        //                     d.document_name    AS jenisdocument,
        //                     m.master_name      AS status,
        //                     m.description      AS descriptionstatus,
        //                     m.color            AS colorstatus
        //                 FROM (
        //                     SELECT 
        //                         a.no_file,
        //                         a.filename,
        //                         a.status_sign,
        //                         a.status_file,
        //                         a.link,
        //                         a.note,
        //                         a.source_file,
        //                         a.created_date,
        //                         a.assign,
        //                         a.created_by,
        //                         a.jenis_doc,
        //                         a.pasien_idx,
        //                         a.transaksi_idx,
        //                         DATE_FORMAT(a.created_date,'%d.%m.%Y %H:%i:%s') AS tgljam 
        //                     FROM dt01_gen_document_file_dt a
        //                     WHERE a.active = '1'
        //                     AND a.status_sign NOT IN ('5','99')
        //                     AND a.assign IN (
        //                         SELECT nik 
        //                         FROM dt01_gen_user_data 
        //                         WHERE org_id = a.org_id 
        //                             AND active = '1' 
        //                             AND certificate = '3'
        //                     )
        //                     ${parameter}

        //                     UNION ALL

        //                     SELECT 
        //                         a.no_file,
        //                         a.filename,
        //                         a.status_sign,
        //                         a.status_file,
        //                         a.link,
        //                         a.note,
        //                         a.source_file,
        //                         a.created_date,
        //                         a.assign,
        //                         a.created_by,
        //                         a.jenis_doc,
        //                         a.pasien_idx,
        //                         a.transaksi_idx,
        //                         DATE_FORMAT(a.created_date,'%d.%m.%Y %H:%i:%s') AS tgljam 
        //                     FROM dt01_gen_document_file_dt a
        //                     WHERE a.active = '1'
        //                     AND a.status_sign IN ('5','99')
        //                     AND a.created_date BETWEEN '${startDate}' AND '${endDate}'
        //                     AND a.assign IN (
        //                         SELECT nik 
        //                         FROM dt01_gen_user_data 
        //                         WHERE org_id = a.org_id 
        //                             AND active = '1' 
        //                             AND certificate = '3'
        //                     )
        //                     ${parameter}
        //                 ) x
        //                 LEFT JOIN dt01_gen_user_data u1 
        //                     ON u1.active = '1' 
        //                     AND u1.nik = x.assign
        //                 LEFT JOIN dt01_gen_user_data u2 
        //                     ON u2.active = '1' 
        //                     AND u2.user_id = x.created_by
        //                 LEFT JOIN dt01_gen_document_ms d 
        //                     ON d.active = '1' 
        //                     AND d.jenis_doc = x.jenis_doc
        //                 LEFT JOIN dt01_gen_master_ms m 
        //                     ON m.active = '1' 
        //                     AND m.jenis_id = 'Statussign_1' 
        //                     AND m.code = x.status_sign
        //                 ORDER BY 
        //                     m.master_name ASC,
        //                     x.created_date DESC;

        //             ";

        //     $recordset = $this->db->query($query);
        //     $recordset = $recordset->result();
        //     return $recordset;
        // }

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
                        and   a.certificate='3'
                        order by name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function positionsigner(){
            $query =
                    "
                        select '1'id, 'Signer 1' position union
                        select '2'id, 'Signer 2' position union
                        select '3'id, 'Signer 3' position union
                        select '4'id, 'Signer 4' position
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
            $sql =   $this->db->update("dt01_gen_document_file_dt",$data,array("no_file"=>$nofile));
            return $sql;
        }


    }
?>