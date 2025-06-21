<?php
    class Modelmasterbarang extends CI_Model{
        
        function masterbarang($orgid){
            $query =
                    "
                        select a.barang_id, buku_id, nama_barang, final_stok, type, jenis_id, satuan_beli_id, satuan_pakai_id, date_format(last_updated_date, '%d.%m.%Y %H:%i:%s')last_updated_date,
                               (select satuan from dt01_lgu_satuan_ms where active='1' and org_id=a.org_id and satuan_id=a.satuan_beli_id)satuanbeli,
                               (select satuan from dt01_lgu_satuan_ms where active='1' and org_id=a.org_id and satuan_id=a.satuan_pakai_id)satuanpakai,
                               (select jenis from dt01_lgu_jenis_barang_ms where active='1' and org_id=a.org_id and jenis_id=a.jenis_id)jenis,
                               (select name from dt01_gen_user_data where org_id=a.org_id and active='1' and user_id=a.last_updated_by)namaupdate,
                               (select buku from dt01_keu_buku_dagang_ms where active='1' and buku_id=a.buku_id)buku
                        from dt01_lgu_barang_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by nama_barang
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function itemtype($orgid){
            $query =
                    "
                        select a.jenis_id, jenis
                        from dt01_lgu_jenis_barang_ms a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                        order by jenis asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function category(){
            $query =
                    "
                        select a.buku_id, buku
                        from dt01_keu_buku_dagang_ms a
                        where a.active='1'
                        and   a.jenis_id in ('2','3')
                        order by buku asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function classification(){
            $query =
                    "
                        select '1' typeid, 'consumable' type union
                        select '2' typeid, 'assets' type
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function satuan($orgid){
            $query =
                    "
                        select a.satuan_id, satuan
                        from dt01_lgu_satuan_ms a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                        order by satuan asc
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