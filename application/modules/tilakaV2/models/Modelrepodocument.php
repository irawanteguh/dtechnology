<?php
    class Modelrepodocument extends CI_Model{

        public function dataupload($parameter, $startDate, $endDate){
            $query = "
                
                WITH RECURSIVE x AS (

                    /* ================= DATA FILTERED ================= */
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
                    WHERE a.active = '1'
                    AND ({$parameter})
                    AND (
                        a.status_sign NOT IN ('5','99')
                        OR (
                            a.status_sign IN ('5','99')
                            AND a.created_date BETWEEN '{$startDate}' AND '{$endDate}'
                        )
                    )
                ),

                split_assign AS (

                    /* ===== ITERASI PERTAMA ===== */
                    SELECT
                        x.no_file,
                        1 AS ord,
                        SUBSTRING_INDEX(x.assign, ';', 1) AS nik,
                        SUBSTRING(x.assign, LENGTH(SUBSTRING_INDEX(x.assign, ';', 1)) + 2) AS rest
                    FROM x
                    WHERE x.assign IS NOT NULL
                    AND x.assign <> ''

                    UNION ALL

                    /* ===== ITERASI LANJUTAN ===== */
                    SELECT
                        s.no_file,
                        s.ord + 1,
                        SUBSTRING_INDEX(s.rest, ';', 1),
                        SUBSTRING(s.rest, LENGTH(SUBSTRING_INDEX(s.rest, ';', 1)) + 2)
                    FROM split_assign s
                    WHERE s.rest <> ''
                )

                SELECT
                    x.*,

                    /* ===== SIGNER INFO (ORDER SAFE) ===== */
                    GROUP_CONCAT(u.user_identifier ORDER BY s.ord SEPARATOR ';') AS useridentifier,
                    GROUP_CONCAT(COALESCE(u.name, s.nik) ORDER BY s.ord SEPARATOR ';') AS assignname,

                    /* ===== INFO TAMBAHAN (JOIN, BUKAN SUBQUERY) ===== */
                    cu.name          AS createdby,
                    dm.document_name AS jenisdocument,
                    ms.master_name   AS status,
                    ms.description   AS descriptionstatus,
                    ms.color         AS colorstatus

                FROM x
                JOIN split_assign s
                    ON s.no_file = x.no_file

                LEFT JOIN dt01_gen_user_data u
                    ON u.nik = s.nik
                    AND u.active = '1'

                LEFT JOIN dt01_gen_user_data cu
                    ON cu.user_id = x.created_by
                    AND cu.active = '1'

                LEFT JOIN dt01_gen_document_ms dm
                    ON dm.jenis_doc = x.jenis_doc
                    AND dm.active = '1'

                LEFT JOIN dt01_gen_master_ms ms
                    ON ms.jenis_id = 'Statussign_1'
                    AND ms.code = x.status_sign
                    AND ms.active = '1'

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
                    x.tgljam,
                    cu.name,
                    dm.document_name,
                    ms.master_name,
                    ms.description,
                    ms.color

                ORDER BY
                    x.status_sign ASC,
                    x.created_date DESC;




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