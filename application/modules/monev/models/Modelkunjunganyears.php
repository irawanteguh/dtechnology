<?php
    class Modelkunjunganyears extends CI_Model{

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

        function kunjungan($periode){
            $query =
                    "
                        WITH monthly_data AS (
                            SELECT  
                                DATE_FORMAT(tgl_registrasi, '%m.%Y') AS periode,
                                COUNT(IF(status_lanjut = 'Ralan', 1, NULL)) AS jmlrj,
                                COUNT(IF(
                                    status_lanjut = 'Ranap' 
                                    AND no_rawat IN (
                                        SELECT no_rawat FROM piutang_pasien
                                    ) 
                                    AND no_rawat IN (
                                        SELECT no_rawat FROM kamar_inap
                                    ), 1, NULL
                                )) AS jmlri
                            FROM reg_periksa
                            WHERE DATE_FORMAT(tgl_registrasi, '%Y') = '".$periode."'
                            AND stts <> 'Batal'
                            GROUP BY DATE_FORMAT(tgl_registrasi, '%m.%Y')
                        ),
                        total_counts AS (
                            SELECT 
                                SUM(jmlrj) AS total_jmlrj,
                                SUM(jmlri) AS total_jmlri,
                                COUNT(*) AS months_passed
                            FROM monthly_data
                        )
                        SELECT 
                            md.*,
                            ROUND(tc.total_jmlrj / NULLIF(tc.months_passed, 0), 0) AS avgrj,
                            ROUND(tc.total_jmlri / NULLIF(tc.months_passed, 0), 0) AS avgri
                        FROM monthly_data md
                        JOIN total_counts tc
                        ORDER BY md.periode ASC;


                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function kunjunganpoli($periode){
            $query =
                    "
                        select date_format(tgl_registrasi, '%Y') periode, kd_poli, count(no_rawat) jmltahunini,
                            (select count(no_rawat) from reg_periksa  where status_lanjut=a.status_lanjut and stts=a.stts and kd_poli=a.kd_poli and year(tgl_registrasi) = year(a.tgl_registrasi) - 1) jmlthnlalu,
                            (select upper(nm_poli) from poliklinik where kd_poli = a.kd_poli) AS namapoli
                                
                        from reg_periksa a
                        where a.status_lanjut = 'Ralan'
                        and a.kd_poli <>'-'
                        and a.stts<>'Batal'
                        and date_format(tgl_registrasi, '%Y') = '".$periode."'
                        group by periode, a.kd_poli
                        order by jmltahunini desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

    }
?>