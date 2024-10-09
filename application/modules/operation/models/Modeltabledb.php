
<?php
    class Modeltabledb extends CI_Model{

        function mastertabledb(){
            $query =
                    "
                        SELECT *, ROUND(((data_length + index_length) / 1024 / 1024), 2) AS SIZE
                        FROM information_schema.TABLES
                        ORDER BY TABLE_SCHEMA asc, (data_length + index_length) desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result_array();
            return $recordset;
        }

        public function table($tableName) {
            $query = $this->db->query("SELECT * FROM " . $this->db->escape_str($tableName));
            if ($query === false) {
                return false; // Properly return false if query fails
            }
            return $query;
        }
        

    }
?>