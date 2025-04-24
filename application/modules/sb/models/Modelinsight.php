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
        
        function datainsight($tahun) {
            $tanggal_awal = $tahun . '-01-01';
            $tanggal_akhir = $tahun . '-12-31';

            $query = "
                        WITH RECURSIVE calendar AS (
                            SELECT DATE('$tanggal_awal') AS tanggal
                            UNION ALL
                            SELECT DATE_ADD(tanggal, INTERVAL 1 MONTH)
                            FROM calendar
                            WHERE tanggal < DATE('$tanggal_akhir')
                        )
                        SELECT DATE_FORMAT(tanggal, '%M') AS periode,
                            (select coalesce(sum(u_rj+u_ri+a_rj+a_ri+b_rj+b_ri+lain),0) from dt01_report_income_dt where org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))totalrsms,
                            (select coalesce(sum(u_rj+u_ri+a_rj+a_ri+b_rj+b_ri+lain),0) from dt01_report_income_dt where org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))totalrsiabm,
                            (select coalesce(sum(u_rj+u_ri+a_rj+a_ri+b_rj+b_ri+lain),0) from dt01_report_income_dt where org_id='a4633f72-4d67-4f65-a050-9f6240704151' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))totalrst,
                            (select coalesce(sum(u_rj+u_ri),0) from dt01_report_income_dt where org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))umumtotalrsms,
                            (select coalesce(sum(u_rj+u_ri),0) from dt01_report_income_dt where org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))umumtotalrsiabm,
                            (select coalesce(sum(u_rj+u_ri),0) from dt01_report_income_dt where org_id='a4633f72-4d67-4f65-a050-9f6240704151' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))umumtotalrst,
                            (select coalesce(sum(a_rj+a_ri),0) from dt01_report_income_dt where org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))asuransitotalrsms,
                            (select coalesce(sum(a_rj+a_ri),0) from dt01_report_income_dt where org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))asuransitotalrsiabm,
                            (select coalesce(sum(a_rj+a_ri),0) from dt01_report_income_dt where org_id='a4633f72-4d67-4f65-a050-9f6240704151' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))asuransitotalrst,
                            (select coalesce(sum(b_rj+b_ri),0) from dt01_report_income_dt where org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))bpjstotalrsms,
                            (select coalesce(sum(b_rj+b_ri),0) from dt01_report_income_dt where org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))bpjstotalrsiabm,
                            (select coalesce(sum(b_rj+b_ri),0) from dt01_report_income_dt where org_id='a4633f72-4d67-4f65-a050-9f6240704151' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))bpjstotalrst,
                            (select coalesce(sum(lain),0) from dt01_report_income_dt where org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))laintotalrsms,
                            (select coalesce(sum(lain),0) from dt01_report_income_dt where org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))laintotalrsiabm,
                            (select coalesce(sum(lain),0) from dt01_report_income_dt where org_id='a4633f72-4d67-4f65-a050-9f6240704151' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))laintotalrst
                        FROM calendar;

                    ";

            $recordset = $this->db->query($query);
            return $recordset->result();
        }


    }
?>