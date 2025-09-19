<?php
    class Modelstatus extends CI_Model{
        
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

        function datamonitoring($orgid,$tahun){
            $query =
                    "
                        select a.no_pemesanan, no_pemesanan_unit, judul_pemesanan, note, department_id, method, total, cito, status,

                            date_format(a.created_date, '%d.%m.%Y %H:%i:%s')tglbuat,
                            date_format(a.kains_date, '%d.%m.%Y %H:%i:%s')kainsdate,
                            date_format(a.koordinator_date, '%d.%m.%Y %H:%i:%s')koordinatordate,

                            (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.created_by)dibuatoleh,
                            (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.kains_id)kainsname,
                            (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.koordinator_id)koordinatorname,

                            (select department from dt01_gen_department_ms where org_id=a.org_id and active=a.active and department_id=a.department_id)unitpelaksana,
                            (select color       from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_2' and code=a.method)colorjenis,
                            (select master_name from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_2' and code=a.method)namejenis,
                            (select color       from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_3' and code=a.status)colorstatus,
                            (select master_name from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_3' and code=a.status)namestatus,
                            (select department from dt01_gen_department_ms where department_id=a.department_id)department,
                            case
                                when a.status='0' then
                                '0'
                                else
                                '1'
                            end flagkains,
                            case
                                when department_id=(select department_id from dt01_gen_department_ms where department_id=a.department_id and head_koordinator='Y') then
                                '1'
                                else
                                '0'
                            end flagkoordinator
                        from dt01_lgu_pemesanan_hd a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                        and   a.version='2.0.0.0'
                        and a.method='4'
                        and   YEAR(a.created_date)='".$tahun."'
                        order by created_date desc
                        
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }


    }
?>