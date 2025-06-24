<?php
    class Modelgrafik extends CI_Model{
        
        

        function datagrafik() {

            $query = "
                        SELECT
                            t.MUTU_ID,
                            m.MUTU,
                            t.ORG_ID,
                            DATE_FORMAT(t.PERIODE, '%Y-%m') AS BULAN,
                            SUM(t.NUMERATOR) AS TOTAL_NUMERATOR,
                            SUM(t.DENUMERATOR) AS TOTAL_DENUMERATOR,
                            CASE
                                WHEN SUM(t.DENUMERATOR) = 0 THEN 0
                                ELSE ROUND(SUM(t.NUMERATOR) / SUM(t.DENUMERATOR) * 100, 2)
                            END AS CAPAIAN_PERSEN
                        FROM
                            dt01_mutu_trx t
                        JOIN
                            dt01_mutu_ms m ON t.MUTU_ID = m.MUTU_ID
                        GROUP BY
                            t.MUTU_ID, m.MUTU, t.ORG_ID, DATE_FORMAT(t.PERIODE, '%Y-%m')
                        ORDER BY
                            BULAN ASC, m.MUTU ASC;
                    ";

            $recordset = $this->db->query($query);
            return $recordset->result();
        }


    }
?>