<?php
    class Modelmonitoringasset extends CI_Model{

        function masterorganization($parameter){
            $query =
                    "
                        select a.org_id, org_name
                        from dt01_gen_organization_ms a
                        where a.active='1'
                        and   a.holding='N'
                        ".$parameter."
                        order by org_name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function grafikoverview() {
            $query = "
                select *
                from view_assets_detail
                order by kategori asc, last_update_date desc
            ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }
    }
?>