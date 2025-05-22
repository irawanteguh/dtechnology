<?php
    class Modelinsight extends CI_Model{

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

        function periodebulan(){
            $query =
                    "
                        select distinct date_format(date, '%m.%Y')id, date_format(date, '%M %Y')periode
                        from dt01_report_income_dt a
                        order by date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        // function datainsight($parameter) {
        //     $query = "
        //                 select 
        //                     (select sum(coalesce(u_rj+u_ri,0)) from dt01_report_income_dt where active='1' ".$parameter.")rmbumum,
        //                     (select sum(coalesce(a_rj+a_ri,0)) from dt01_report_income_dt where active='1' ".$parameter.")rmbasuransi,
        //                     (select sum(coalesce(b_rj+b_ri,0)) from dt01_report_income_dt where active='1' ".$parameter.")rmbbpjs,
        //                     (select sum(coalesce(mcu_cash+mcu_inv,0)) from dt01_report_income_dt where active='1' ".$parameter.")rmbmcu,
        //                     (select sum(coalesce(pob,0)) from dt01_report_income_dt where active='1' ".$parameter.")rmbpob,
        //                     (select sum(coalesce(lain)) from dt01_report_income_dt where active='1' ".$parameter.")rmblain,
                            
        //                     (select sum(coalesce(u_rj+u_ri,0)) from dt01_report_income_dt where active='1' and org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' ".$parameter.")rsmsumum,
        //                     (select sum(coalesce(a_rj+a_ri,0)) from dt01_report_income_dt where active='1' and org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' ".$parameter.")rsmsasuransi,
        //                     (select sum(coalesce(b_rj+b_ri,0)) from dt01_report_income_dt where active='1' and org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' ".$parameter.")rsmsbpjs,
        //                     (select sum(coalesce(mcu_cash+mcu_inv,0)) from dt01_report_income_dt where active='1' and org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' ".$parameter.")rsmsmcu,
        //                     (select sum(coalesce(pob,0)) from dt01_report_income_dt where active='1' and org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' ".$parameter.")rsmspob,
        //                     (select sum(coalesce(lain)) from dt01_report_income_dt where active='1' and org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' ".$parameter.")rsmslain,

        //                     (select sum(coalesce(u_rj+u_ri,0)) from dt01_report_income_dt where active='1' and org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' ".$parameter.")rsiabmumum,
        //                     (select sum(coalesce(a_rj+a_ri,0)) from dt01_report_income_dt where active='1' and org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' ".$parameter.")rsiabmasuransi,
        //                     (select sum(coalesce(b_rj+b_ri,0)) from dt01_report_income_dt where active='1' and org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' ".$parameter.")rsiabmbpjs,
        //                     (select sum(coalesce(mcu_cash+mcu_inv,0)) from dt01_report_income_dt where active='1' and org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' ".$parameter.")rsiabmmcu,
        //                     (select sum(coalesce(pob,0)) from dt01_report_income_dt where active='1' and org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' ".$parameter.")rsiabmpob,
        //                     (select sum(coalesce(lain)) from dt01_report_income_dt where active='1' and org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' ".$parameter.")rsiabmlain,

        //                     (select sum(coalesce(u_rj+u_ri,0)) from dt01_report_income_dt where active='1' and org_id='a4633f72-4d67-4f65-a050-9f6240704151' ".$parameter.")rstumum,
        //                     (select sum(coalesce(a_rj+a_ri,0)) from dt01_report_income_dt where active='1' and org_id='a4633f72-4d67-4f65-a050-9f6240704151' ".$parameter.")rstasuransi,
        //                     (select sum(coalesce(b_rj+b_ri,0)) from dt01_report_income_dt where active='1' and org_id='a4633f72-4d67-4f65-a050-9f6240704151' ".$parameter.")rstbpjs,
        //                     (select sum(coalesce(mcu_cash+mcu_inv,0)) from dt01_report_income_dt where active='1' and org_id='a4633f72-4d67-4f65-a050-9f6240704151' ".$parameter.")rstmcu,
        //                     (select sum(coalesce(pob,0)) from dt01_report_income_dt where active='1' and org_id='a4633f72-4d67-4f65-a050-9f6240704151' ".$parameter.")rstpob,
        //                     (select sum(coalesce(lain)) from dt01_report_income_dt where active='1' and org_id='a4633f72-4d67-4f65-a050-9f6240704151' ".$parameter.")rstlain

        //             ";

        //     $recordset = $this->db->query($query);
        //     return $recordset->result();
        // }

        function datainsight($parameter1, $parameter2) {
            $query = "
                        
                            -- Subquery untuk pendapatan
                            WITH pendapatan AS (
                                SELECT 
                                    a.org_id,
                                    SUM(COALESCE(u_rj + u_ri, 0)) AS umum,
                                    SUM(COALESCE(a_rj + a_ri, 0)) AS asuransi,
                                    SUM(COALESCE(b_rj + b_ri, 0)) AS bpjs,
                                    SUM(COALESCE(mcu_cash + mcu_inv, 0)) AS mcu,
                                    SUM(COALESCE(pob, 0)) AS obat,
                                    SUM(COALESCE(lain, 0)) AS lain
                                FROM dt01_report_income_dt a
                                WHERE a.active = '1'
                                $parameter1
                                GROUP BY a.org_id
                            ),

                            -- Subquery untuk pengeluaran berdasarkan jenis barang
                            pengeluaran AS (
                                SELECT 
                                    h.org_id,
                                    SUM(CASE WHEN b.jenis_id = '03658297-b9eb-4107-bd6f-ad4430db491c' THEN COALESCE(p.total, 0) ELSE 0 END) AS medis,
                                    SUM(CASE WHEN b.jenis_id = '03b3a729-cf6c-4abe-85fe-e2df7d226110' THEN COALESCE(p.total, 0) ELSE 0 END) AS rumah_tangga,
                                    SUM(CASE WHEN b.jenis_id IN ('1b358482-7bea-45fb-b1b2-f55521c914f5','ff479f7a-00c7-4fdb-a031-803c8ca74216') THEN COALESCE(p.total, 0) ELSE 0 END) AS atk_percetakan,
                                    SUM(CASE WHEN b.jenis_id = '542476c2-186a-4a2c-bb6f-17c34e44d6a9' THEN COALESCE(p.total, 0) ELSE 0 END) AS it,
                                    SUM(CASE WHEN b.jenis_id IN ('ae620818-f956-4069-b988-2312983686a0','af3e3966-5e98-444c-bde9-712d7d8b67c4') THEN COALESCE(p.total, 0) ELSE 0 END) AS gizi_dapur,
                                    SUM(CASE WHEN b.jenis_id = 'c98d4236-f1d0-4eec-8b74-737cdf2d8f32' THEN COALESCE(p.total, 0) ELSE 0 END) AS farmasi
                                FROM dt01_lgu_pemesanan_hd h
                                LEFT JOIN dt01_lgu_pemesanan_dt p 
                                    ON p.no_pemesanan = h.no_pemesanan AND p.org_id = h.org_id
                                LEFT JOIN dt01_lgu_barang_ms b 
                                    ON b.barang_id = p.barang_id
                                WHERE h.status IN ('16', '17')
                                $parameter2
                                GROUP BY h.org_id
                            )

                            -- Gabungkan keduanya
                            SELECT 
                                p.org_id,
                                p.umum,
                                p.asuransi,
                                p.bpjs,
                                p.mcu,
                                p.obat,
                                p.lain,
                                COALESCE(e.medis, 0) AS medis,
                                COALESCE(e.rumah_tangga, 0) AS rumah_tangga,
                                COALESCE(e.atk_percetakan, 0) AS atk_percetakan,
                                COALESCE(e.it, 0) AS it,
                                COALESCE(e.gizi_dapur, 0) AS gizi_dapur,
                                COALESCE(e.farmasi, 0) AS farmasi
                            FROM pendapatan p
                            LEFT JOIN pengeluaran e ON e.org_id = p.org_id;
                    ";

                    $recordset = $this->db->query($query);
                    return $recordset->result();
                }



    }
?>