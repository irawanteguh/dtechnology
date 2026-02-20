<?php
    class Modelstockopame extends CI_Model{
        
        function mutasibarang($orgid){
            $query =
                    "
                        select a.transaksi_id, masuk, keluar, qty, date_format(created_date, '%d.%m.%Y %H:%i:%s')tgltransaksi,
                            (select location from dt01_gen_location_ms where active='1' and org_id=a.org_id and location_id=a.location_id)location,
                            (select nama_barang from dt01_lgu_barang_ms where active='1' and org_id=a.org_id and barang_id=a.barang_id)namabarang,
                            (select name from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=a.created_by)dibuatoleh,
                            (select department from dt01_gen_department_ms where org_id=a.org_id and department_id=a.department_id)unit

                        from dt01_lgu_mutasi_barang a
                        where a.org_id='".$orgid."'
                        order by created_date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

    }
?>