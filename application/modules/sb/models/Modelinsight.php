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
        
        function dataharian($tahun) {
            $query = "
                        select a.org_id, date, u_rj, u_ri, a_rj, a_ri, b_rj, b_ri, mcu_cash, mcu_inv, pob, lain,
                            DATE_FORMAT(date, '%d') AS tanggal,
                            (select u_rj from dt01_report_income_dt_compare where active=a.active and org_id=a.org_id and date=a.date)u_rj_compare,
                            (select u_ri from dt01_report_income_dt_compare where active=a.active and org_id=a.org_id and date=a.date)u_ri_compare,
                            (select a_rj from dt01_report_income_dt_compare where active=a.active and org_id=a.org_id and date=a.date)a_rj_compare,
                            (select a_ri from dt01_report_income_dt_compare where active=a.active and org_id=a.org_id and date=a.date)a_ri_compare,
                            (select b_rj from dt01_report_income_dt_compare where active=a.active and org_id=a.org_id and date=a.date)b_rj_compare,
                            (select b_ri from dt01_report_income_dt_compare where active=a.active and org_id=a.org_id and date=a.date)b_ri_compare,
                            (select mcu_inv from dt01_report_income_dt_compare where active=a.active and org_id=a.org_id and date=a.date)mcu_inv_compare,
                            (select pob from dt01_report_income_dt_compare where active=a.active and org_id=a.org_id and date=a.date)pob_compare,
                            (select lain from dt01_report_income_dt_compare where active=a.active and org_id=a.org_id and date=a.date)lain_compare,
                            (select sum(tarif_inacbg) from dt01_casemix_claim where org_id=a.org_id and ptd='2' and admission_date=a.date)claimbpjsrj,
                            (select sum(tarif_inacbg) from dt01_casemix_claim where org_id=a.org_id and ptd='1' and admission_date=a.date)claimbpjsri 

                        from dt01_report_income_dt a
                        where a.active='1'
                        and   date_format(a.date,'%Y')='".$tahun."'
                        order by org_id asc, date asc
                    ";

            $recordset = $this->db->query($query);
            return $recordset->result();
        }


    }
?>