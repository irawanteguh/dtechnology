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
                        select distinct date_format(tgl_registrasi, '%m.%Y')id, date_format(tgl_registrasi, '%M %Y')periode
                        from reg_periksa a
                        order by tgl_registrasi desc
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

        function datainsight($parameter) {
            $query = "
                        SELECT
                            org_id,
                            SUM(COALESCE(u_rj + u_ri, 0)) AS umum,
                            SUM(COALESCE(a_rj + a_ri, 0)) AS asuransi,
                            SUM(COALESCE(b_rj + b_ri, 0)) AS bpjs,
                            SUM(COALESCE(mcu_cash + mcu_inv, 0)) AS mcu,
                            SUM(COALESCE(pob, 0)) AS obat,
                            SUM(COALESCE(lain, 0)) AS lain
                        FROM dt01_report_income_dt
                        WHERE active = '1'
                        $parameter
                        GROUP BY org_id;


                    ";

            $recordset = $this->db->query($query);
            return $recordset->result();
        }


    }
?>