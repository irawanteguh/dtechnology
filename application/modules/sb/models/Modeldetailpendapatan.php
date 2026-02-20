<?php
    class Modeldetailpendapatan extends CI_Model{
        
        function periode(){
            $query =
                    "
                        select distinct date_format(tgl_registrasi, '%Y')periode
                        from reg_periksa a
                        order by periode desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }
        
        function dataharian($tahun) {
            $query = "
                        SELECT 
                            a.org_id, 
                            a.date, 
                            a.u_rj, a.u_ri, a.a_rj, a.a_ri, a.b_rj, a.b_ri,
                            a.mcu_cash, a.mcu_inv, a.pob, a.lain,
                            a.k_urj, a.k_uri, a.k_arj, a.k_ari, a.k_brj, a.k_bri,
                            a.k_mcu_cash, a.k_mcu_inv,
                            DATE_FORMAT(a.date, '%d') AS tanggal,

                            cmp.u_rj        AS u_rj_compare,
                            cmp.u_ri        AS u_ri_compare,
                            cmp.a_rj        AS a_rj_compare,
                            cmp.a_ri        AS a_ri_compare,
                            cmp.b_rj        AS b_rj_compare,
                            cmp.b_ri        AS b_ri_compare,
                            cmp.mcu_inv     AS mcu_inv_compare,
                            cmp.pob         AS pob_compare,
                            cmp.lain        AS lain_compare,

                            COALESCE(claim_rj.total_claim, 0) AS claimbpjsrj,
                            COALESCE(claim_ri.total_claim, 0) AS claimbpjsri

                        FROM dt01_report_income_dt a

                        -- JOIN ke tabel compare
                        LEFT JOIN dt01_report_income_dt_compare cmp
                            ON cmp.org_id = a.org_id
                            AND cmp.date = a.date
                            AND cmp.active = a.active

                        -- Klaim RJ
                        LEFT JOIN (
                            SELECT org_id, admission_date, SUM(tarif_inacbg) AS total_claim
                            FROM dt01_casemix_claim
                            WHERE ptd = '2'
                            GROUP BY org_id, admission_date
                        ) AS claim_rj ON claim_rj.org_id = a.org_id AND claim_rj.admission_date = a.date

                        -- Klaim RI
                        LEFT JOIN (
                            SELECT org_id, admission_date, SUM(tarif_inacbg) AS total_claim
                            FROM dt01_casemix_claim
                            WHERE ptd = '1'
                            GROUP BY org_id, admission_date
                        ) AS claim_ri ON claim_ri.org_id = a.org_id AND claim_ri.admission_date = a.date

                        WHERE 
                            a.active = '1' 
                            AND DATE_FORMAT(a.date, '%Y') = '".$tahun."'

                        ORDER BY 
                            a.org_id ASC, a.date ASC
                    ";

            $recordset = $this->db->query($query);
            return $recordset->result();
        }


    }
?>