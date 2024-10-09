<?php
    class Modelmasterclient extends CI_Model{

        function listclient(){
            $query =
                    "
                        select a.*
                        from dt01_gen_organization_ms a
                        order by created_date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function modulesms(){
            $query =
                    "
                        select a.modules_id, modules_name, parent, modules_header_id,
                            case 
                                when a.modules_id='9b873e90-d8fd-48f3-8c98-ec2aff0c207f' then '1'
                                when a.modules_id='1eebee7e-a774-4572-a660-8ab49f6a734a' then '1'
                                when a.modules_id='6c105bb7-633d-4f59-b0d0-37b6dcc59bb7' then '1'
                                when a.modules_id='951544df-6ad1-482d-89e0-4bd3d348e215' then '1'
                                when a.modules_id='8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614' then '1'
                                when a.modules_id='d97e8a15-4a46-4389-a8ff-ab0f694d6d95' then '1'
                                when a.modules_id='5e9a1b26-93fe-4dbc-af0e-2967710e4483' then '1'
                                when a.modules_id='07eab05f-be52-45ce-8a53-8dd69df443f4' then '1'
                                when a.modules_id='f9afc38a-bb61-4f98-b593-211766ec6133' then '1'
                                when a.modules_id='04ee7f51-5847-4099-9d70-7b4f4d9a989c' then '1'
                                else
                                '0'
                            end active
                            
                        from dt01_gen_modules_ms a
                        where a.active='1'
                        order by parent asc, modules_name
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterenvironment(){
            $query =
                    "
                        select 'ORGID_SATUSEHAT' environment_name, '' dev, '' prod,  1 urut union
                        select 'CLIENTID_SATUSEHAT' environment_name, '' dev, '' prod,  2 urut union
                        select 'CLIENTSECRET_SATUSEHAT' environment_name, '' dev, '' prod,  3 urut union
                        select 'AUTHURL_SATUSEHAT' environment_name, 'https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1' dev, 'https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1' prod,  4 urut union
                        select 'BASEURL_SATUSEHAT' environment_name, 'https://api-satusehat-stg.kemkes.go.id' dev, 'https://api-satusehat-stg.kemkes.go.id' prod,  5 urut union
                        select 'CLIENT_ID_TILAKA' environment_name, '' dev, '' prod,  6 urut union
                        select 'CLIENT_SECRET_TILAKA' environment_name, '' dev, '' prod,  7 urut union
                        select 'TILAKA_BASE_URL' environment_name, 'https://sb-api.tilaka.id/' dev, 'https://api.tilaka.id/' prod,  8 urut union
                        select 'TILAKALITE_URL' environment_name, '' dev, '' prod,  9 urut union
                        select 'PATHFILE_POST_TILAKA' environment_name, '' dev, '' prod,  10 urut union
                        select 'PATHFILE_GET_TILAKA' environment_name, '' dev, '' prod,  11 urut  union
                        select 'HEIGHT' environment_name, '70' dev, '70' prod,  12 urut union
                        select 'WIDTH' environment_name, '550' dev, '550' prod,  13 urut union
                        select 'COORDINATE_X' environment_name, '10' dev, '10' prod,  14 urut union
                        select 'COORDINATE_Y' environment_name, '10' dev, '10' prod,  15 urut union
                        select 'PAGE' environment_name, '1' de, '1' prodv,  16 urut union
                        select 'ORG_ID' environment_name, '' dev, '' prod,  17 urut union
                        select 'MAX_VALUE_ACTIVITY' environment_name, '70' dev, '70' prod,  18 urut union
                        select 'MAX_VALUE_ASSESSMENT' environment_name, '30' dev, '30' prod,  19 urut union
                        select 'END_VALID_ACTIVITY' environment_name, '5' dev, '5' prod,  20 urut union
                        select 'START_VALID_ASSESSMENT' environment_name, '1' dev, '1' prod,  21 urut union
                        select 'END_VALID_ASSESSMENT' environment_name, '2' dev, '2' prod,  22 urut
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertenviroment($data){           
            $sql =   $this->db->insert("dt01_gen_enviroment_ms",$data);
            return $sql;
        }

        function insertuseradministrator($data){           
            $sql =   $this->db->insert("dt01_gen_user_data",$data);
            return $sql;
        }

        function insertrolems($data){           
            $sql =   $this->db->insert("dt01_gen_role_ms",$data);
            return $sql;
        }

        function insertroledt($data){           
            $sql =   $this->db->insert("dt01_gen_role_dt",$data);
            return $sql;
        }

        function insertroleaccess($data){           
            $sql =   $this->db->insert("dt01_gen_role_access",$data);
            return $sql;
        }

        function insertmasterclient($data){           
            $sql =   $this->db->insert("dt01_gen_organization_ms",$data);
            return $sql;
        }

        function updatemasterclient($data, $orgid){           
            $sql =   $this->db->update("dt01_gen_organization_ms",$data,array("org_id"=>$orgid));
            return $sql;
        }

    }
?>