<?php
    class Modelinsight extends CI_Model{

        

        function datainsight() {
            $query = "
                        WITH RECURSIVE calendar AS (
                            SELECT DATE('2025-01-01') AS tanggal
                            UNION ALL
                            SELECT DATE_ADD(tanggal, INTERVAL 1 MONTH)
                            FROM calendar
                            WHERE tanggal < DATE('2025-12-01')
                        )
                        SELECT DATE_FORMAT(tanggal, '%M') AS periode,
                            (select coalesce(sum(u_rj+u_ri+a_rj+a_ri+b_rj+b_ri+lain),0) from dt01_report_income_dt where org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' and date_format(date,'%m')=date_format(tanggal,'%m'))totalrsms,
                            (select coalesce(sum(u_rj+u_ri+a_rj+a_ri+b_rj+b_ri+lain),0) from dt01_report_income_dt where org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' and date_format(date,'%m')=date_format(tanggal,'%m'))totalrsiabm,
                            (select coalesce(sum(u_rj+u_ri+a_rj+a_ri+b_rj+b_ri+lain),0) from dt01_report_income_dt where org_id='a4633f72-4d67-4f65-a050-9f6240704151' and date_format(date,'%m')=date_format(tanggal,'%m'))totalrst,
                            (select coalesce(sum(u_rj+u_ri),0) from dt01_report_income_dt where org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' and date_format(date,'%m')=date_format(tanggal,'%m'))umumtotalrsms,
                            (select coalesce(sum(u_rj+u_ri),0) from dt01_report_income_dt where org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' and date_format(date,'%m')=date_format(tanggal,'%m'))umumtotalrsiabm,
                            (select coalesce(sum(u_rj+u_ri),0) from dt01_report_income_dt where org_id='a4633f72-4d67-4f65-a050-9f6240704151' and date_format(date,'%m')=date_format(tanggal,'%m'))umumtotalrst,
                            (select coalesce(sum(a_rj+a_ri),0) from dt01_report_income_dt where org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' and date_format(date,'%m')=date_format(tanggal,'%m'))asuransitotalrsms,
                            (select coalesce(sum(a_rj+a_ri),0) from dt01_report_income_dt where org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' and date_format(date,'%m')=date_format(tanggal,'%m'))asuransitotalrsiabm,
                            (select coalesce(sum(a_rj+a_ri),0) from dt01_report_income_dt where org_id='a4633f72-4d67-4f65-a050-9f6240704151' and date_format(date,'%m')=date_format(tanggal,'%m'))asuransitotalrst,
                            (select coalesce(sum(b_rj+b_ri),0) from dt01_report_income_dt where org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' and date_format(date,'%m')=date_format(tanggal,'%m'))bpjstotalrsms,
                            (select coalesce(sum(b_rj+b_ri),0) from dt01_report_income_dt where org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' and date_format(date,'%m')=date_format(tanggal,'%m'))bpjstotalrsiabm,
                            (select coalesce(sum(b_rj+b_ri),0) from dt01_report_income_dt where org_id='a4633f72-4d67-4f65-a050-9f6240704151' and date_format(date,'%m')=date_format(tanggal,'%m'))bpjstotalrst,
                            (select coalesce(sum(lain),0) from dt01_report_income_dt where org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' and date_format(date,'%m')=date_format(tanggal,'%m'))laintotalrsms,
                            (select coalesce(sum(lain),0) from dt01_report_income_dt where org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' and date_format(date,'%m')=date_format(tanggal,'%m'))laintotalrsiabm,
                            (select coalesce(sum(lain),0) from dt01_report_income_dt where org_id='a4633f72-4d67-4f65-a050-9f6240704151' and date_format(date,'%m')=date_format(tanggal,'%m'))laintotalrst
                        FROM calendar;

                    ";

            $recordset = $this->db->query($query);
            return $recordset->result();
        }


    }
?>