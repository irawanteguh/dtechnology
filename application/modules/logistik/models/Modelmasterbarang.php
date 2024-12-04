<?php
    class Modelmasterbarang extends CI_Model{
        
        function masterbarang($orgid){
            $query =
                    "
                        select a.barang_id, nama_barang, final_stok, type,
                               (select satuan from dt01_lgu_satuan_ms where active='1' and org_id=a.org_id and satuan_id=a.satuan_beli_id)satuanbeli,
                               (select satuan from dt01_lgu_satuan_ms where active='1' and org_id=a.org_id and satuan_id=a.satuan_pakai_id)satuanpakai,
                               (select jenis from dt01_lgu_jenis_barang_ms where active='1' and org_id=a.org_id and jenis_id=a.jenis_id)jenis
                        from dt01_lgu_barang_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by nama_barang
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updatemasterbarang($data,$barangid){           
            $sql =   $this->db->update("dt01_lgu_barang_ms",$data,array("barang_id"=>$barangid));
            return $sql;
        }

        function insertitem($data){           
            $sql =   $this->db->insert("dt01_lgu_barang_ms",$data);
            return $sql;
        }

    }
?>