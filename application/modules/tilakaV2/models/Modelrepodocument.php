<?php
    class Modelrepodocument extends CI_Model{

        // function dataupload($parameter,$startDate,$endDate){
        //     $query =
        //             "
        //                 select x.*,
        //                     /* USER IDENTIFIER (LIST) */
        //                         (
        //                             SELECT GROUP_CONCAT(u.user_identifier SEPARATOR '; ')
        //                             FROM dt01_gen_user_data u
        //                             WHERE u.active = '1'
        //                             AND u.certificate = '3'
        //                             AND FIND_IN_SET(u.nik, REPLACE(x.assign, ';', ','))
        //                         ) AS useridentifier,

        //                         /* ASSIGN NAME (LIST) */
        //                         (
        //                             SELECT GROUP_CONCAT(u.name SEPARATOR '; ')
        //                             FROM dt01_gen_user_data u
        //                             WHERE u.active = '1'
        //                             AND FIND_IN_SET(u.nik, REPLACE(x.assign, ';', ','))
        //                         ) AS assignname,

        //                     (select name            from dt01_gen_user_data   where active='1' and user_id=x.created_by)createdby,
        //                     (select document_name   from dt01_gen_document_ms where active='1' and jenis_doc=x.jenis_doc)jenisdocument,
        //                     (select master_name     from dt01_gen_master_ms   where active='1' and jenis_id='Statussign_1' and code=x.status_sign)status,
        //                     (select description     from dt01_gen_master_ms   where active='1' and jenis_id='Statussign_1' and code=x.status_sign)descriptionstatus,
        //                     (select color           from dt01_gen_master_ms   where active='1' and jenis_id='Statussign_1' and code=x.status_sign)colorstatus
        //                 from(
        //                     select a.no_file, filename, status_sign, status_file, link, note, source_file, created_date, assign, created_by, jenis_doc, pasien_idx, transaksi_idx, date_format(created_date,'%d.%m.%Y %H:%i:%s')tgljam 
        //                     from dt01_gen_document_file_dt a
        //                     where a.active='1'
        //                     and   a.status_sign not in ('5','99')
        //                     ".$parameter."

        //                     union

        //                     select a.no_file, filename, status_sign, status_file, link, note, source_file, created_date, assign, created_by, jenis_doc, pasien_idx, transaksi_idx, date_format(created_date,'%d.%m.%Y %H:%i:%s')tgljam 
        //                     from dt01_gen_document_file_dt a
        //                     where a.active='1'
        //                     and   a.status_sign in ('5','99')
        //                     and   a.created_date between '".$startDate."' and '".$endDate."'
        //                     ".$parameter."
        //                     and   a.assign=(select nik from dt01_gen_user_data where org_id=a.org_id and active='1' and certificate='3' and nik=a.assign)
        //                 )x
        //                 order by status asc, created_date desc
        //             ";

        //     $recordset = $this->db->query($query);
        //     $recordset = $recordset->result();
        //     return $recordset;
        // }

        function dataupload($parameter, $startDate, $endDate){
            $query = "
                SELECT
                    x.*,

                    /* ===== SESUAI JUMLAH & URUTAN ASSIGN ===== */
                    GROUP_CONCAT(u.user_identifier ORDER BY ja.ord SEPARATOR '; ') AS useridentifier,
                    GROUP_CONCAT(u.name ORDER BY ja.ord SEPARATOR '; ') AS assignname,

                    /* ===== INFO TAMBAHAN ===== */
                    (
                        SELECT name
                        FROM dt01_gen_user_data
                        WHERE active='1'
                        AND user_id = x.created_by
                        LIMIT 1
                    ) AS createdby,

                    (
                        SELECT document_name
                        FROM dt01_gen_document_ms
                        WHERE active='1'
                        AND jenis_doc = x.jenis_doc
                        LIMIT 1
                    ) AS jenisdocument,

                    (
                        SELECT master_name
                        FROM dt01_gen_master_ms
                        WHERE active='1'
                        AND jenis_id='Statussign_1'
                        AND code = x.status_sign
                        LIMIT 1
                    ) AS status,

                    (
                        SELECT description
                        FROM dt01_gen_master_ms
                        WHERE active='1'
                        AND jenis_id='Statussign_1'
                        AND code = x.status_sign
                        LIMIT 1
                    ) AS descriptionstatus,

                    (
                        SELECT color
                        FROM dt01_gen_master_ms
                        WHERE active='1'
                        AND jenis_id='Statussign_1'
                        AND code = x.status_sign
                        LIMIT 1
                    ) AS colorstatus

                FROM (

                    /* ================= DATA AKTIF ================= */
                    SELECT
                        a.no_file,
                        a.filename,
                        a.status_sign,
                        a.status_file,
                        a.link,
                        a.note,
                        a.source_file,
                        a.created_date,
                        a.assign,
                        a.created_by,
                        a.jenis_doc,
                        a.pasien_idx,
                        a.transaksi_idx,
                        DATE_FORMAT(a.created_date,'%d.%m.%Y %H:%i:%s') AS tgljam
                    FROM dt01_gen_document_file_dt a
                    WHERE a.active='1'
                    AND a.status_sign NOT IN ('5','99')
                    AND (
                        {$parameter}
                    )

                    UNION

                    /* ================= DATA SELESAI ================= */
                    SELECT
                        a.no_file,
                        a.filename,
                        a.status_sign,
                        a.status_file,
                        a.link,
                        a.note,
                        a.source_file,
                        a.created_date,
                        a.assign,
                        a.created_by,
                        a.jenis_doc,
                        a.pasien_idx,
                        a.transaksi_idx,
                        DATE_FORMAT(a.created_date,'%d.%m.%Y %H:%i:%s') AS tgljam
                    FROM dt01_gen_document_file_dt a
                    WHERE a.active='1'
                    AND a.status_sign IN ('5','99')
                    AND a.created_date BETWEEN '{$startDate}' AND '{$endDate}'
                    AND (
                        {$parameter}
                    )
                    AND a.assign = (
                        SELECT nik
                        FROM dt01_gen_user_data
                        WHERE org_id = a.org_id
                        AND active='1'
                        AND certificate='3'
                        AND nik = a.assign
                        LIMIT 1
                    )

                ) x

                /* ===== EXPLODE ASSIGN ===== */
                JOIN JSON_TABLE(
                    CONCAT(
                        '[\"',
                        REPLACE(IFNULL(x.assign,''), ';', '\",\"'),
                        '\"]'
                    ),
                    '$[*]' COLUMNS (
                        ord FOR ORDINALITY,
                        nik VARCHAR(50) PATH '$'
                    )
                ) ja ON ja.nik <> ''

                /* ===== USER DIKUNCI 1 ROW PER NIK ===== */
                LEFT JOIN (
                    SELECT
                        nik,
                        MAX(user_identifier) AS user_identifier,
                        MAX(name) AS name
                    FROM dt01_gen_user_data
                    WHERE active='1'
                    AND certificate='3'
                    GROUP BY nik
                ) u ON u.nik = ja.nik

                /* ===== GROUPING ===== */
                GROUP BY
                    x.no_file,
                    x.created_date,
                    x.filename,
                    x.status_sign,
                    x.status_file,
                    x.link,
                    x.note,
                    x.source_file,
                    x.assign,
                    x.created_by,
                    x.jenis_doc,
                    x.pasien_idx,
                    x.transaksi_idx,
                    x.tgljam

                /* ===== SORTING ===== */
                ORDER BY
                    x.status_sign ASC,
                    x.created_date DESC
            ";

            return $this->db->query($query)->result();
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