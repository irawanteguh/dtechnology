<?php
    class Modelimportdata extends CI_Model{

        function locationid($orgid, $name) {
            $sql = "
                SELECT a.trans_id
                FROM dt01_lgu_assets_ms a
                WHERE a.active = '1'
                  AND a.jenis_id = '2'
                  AND a.org_id = ?
                  AND a.name = ?
                LIMIT 1
            ";
        
            $query = $this->db->query($sql, array($orgid, $name));
            $result = $query->row();
            return $result ? $result->trans_id : null;
        }
        

        function cekdatanoinventaris($orgid,$noinventaris) {
            $query = "
                select a.trans_id
                from dt01_lgu_assets_ms a
                where a.active='1'
                and   a.jenis_id='1'
                and   a.org_id='".$orgid."'
                and   a.no_inventaris='".$noinventaris."'
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