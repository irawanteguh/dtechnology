<?php
    class Modelmasterbarang extends CI_Model{
        
        function masterbarang($orgid){
            $query =
                    "
                        select a.nama_barang, final_stok
                        from dt01_lgu_barang_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by nama_barang
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

    }
?>