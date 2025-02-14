<?php
    class modellistassets extends CI_Model{

        function masterbarang($orgid){
            $query =
                    "
                        select a.barang_id, nama_barang
                        from dt01_lgu_barang_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.type='2'
                        order by nama_barang asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterassets($orgid){
            $query =
                    "
                        select a.trans_id, no_assets, note, serial_number,
                            (select nama_barang from dt01_lgu_barang_ms where barang_id=a.barang_id)namabarang,
                            (select name from dt01_gen_user_data where user_id=a.created_by)dibuatoleh
                            
                        from dt01_lgu_assets_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertassets($data){           
            $sql =   $this->db->insert("dt01_lgu_assets_ms",$data);
            return $sql;
        }

    }
?>