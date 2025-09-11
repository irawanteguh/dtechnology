<?php
    class Modelgrafik extends CI_Model{
        
        function masterorganization(){
            $query =
                    "
                        select a.org_id, org_name
                        from dt01_gen_organization_ms a
                        where a.active='1'
                        and   a.holding='N'
                        and   a.org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524'
                        order by org_name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function periode(){
            $query =
                    "
                        select distinct date_format(a.created_date, '%Y')periode
                        from dt01_lgu_pemesanan_hd a
                        order by periode desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function datagrafik($orgid,$tahun){
            $query =
                    "
                        select a.method, department_id, total,
                            (select master_name from dt01_gen_master_ms where jenis_id='PO_2' and code=a.method)jenis,
                            (select department from dt01_gen_department_ms where department_id=a.department_id)department
                        from dt01_lgu_pemesanan_hd a
                        where a.active='1'
                        and   a.status in ('16','17')
                        and   a.org_id='".$orgid."'
                        and   YEAR(a.created_date)='".$tahun."'
                        
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }


    }
?>