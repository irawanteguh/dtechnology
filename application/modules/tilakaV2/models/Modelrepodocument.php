<?php
    class Modelrepodocument extends CI_Model{

        function datarepository($parameter){
            $query =
                    "
                        select a.no_file, filename, note_1, note_2, location, type, status, response, date_format(created_date,'%d.%m.%Y %H:%i:%s')tgljam,
                                (select name from dt01_gen_user_data where active='1' and user_id=a.created_by)createdby,
                                (select document_name from dt01_gen_document_ms where active='1' and jenis_doc=a.jenis_doc)jenisdocument,
                                (
                                    select group_concat(concat((select name from dt01_gen_user_data where nik=b.nik),'_',b.type) SEPARATOR ';') 
                                    from dt01_gen_tte_it b
                                    where b.active='1'
                                    and   b.no_file=a.no_file
                                )assign
                        from dt01_gen_tte_hd a
                        where a.active='1'
                        ".$parameter."
                        order by created_date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterdocument(){
            $query =
                    "
                        select a.jenis_doc, document_name
                        from dt01_gen_document_ms a
                        where a.active='1'
                        order by document_name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterposition(){
            $query =
                    "
                        select 'D'id, 'Default By System'metod union
                        select 'C'id, 'By Tag Coordinate' metod
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function userassign($orgid){
            $query =
                    "
                        select a.nik, replace(name,',','.')name
                        from dt01_gen_user_data a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.certificate='3'
                        order by name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertsigndocument($data){           
            $sql =   $this->db->insert("dt01_gen_tte_hd",$data);
            return $sql;
        }

        function insertsigndocumentassign($data){           
            $sql =   $this->db->insert("dt01_gen_tte_it",$data);
            return $sql;
        }

        function updatefile($data,$nofile){           
            $sql =   $this->db->update("dt01_gen_tte_hd",$data,array("no_file"=>$nofile));
            return $sql;
        }

    }
?>