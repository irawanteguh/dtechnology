<?php
    class Modelnotification extends CI_Model{

        function informationkpi($orgid){
            $query =
                    "
                        select x.*,
                                case
                                    when DAY(CURDATE()) between startassessment and endassessment then
                                            date_format(DATE_SUB(CURDATE(), INTERVAL 1 MONTH),'%m.%Y')
                                    else
                                        date_format(CURDATE(),'%m.%Y')
                                end periodeidassessment,
                                case
                                    when DAY(CURDATE()) between startassessment and endassessment then
                                        CONCAT(MONTHNAME(DATE_SUB(CURDATE(), INTERVAL 1 MONTH)), ' ', YEAR(DATE_SUB(CURDATE(), INTERVAL 1 MONTH)))
                                    else
                                        CONCAT(MONTHNAME(CURDATE()), ' ', YEAR(CURDATE()))
                                end periodeketeranganassessment,
                                case 
                                    when DAY(CURDATE()) <= endactivity then
                                        date_format(DATE_SUB(CURDATE(), INTERVAL 1 MONTH),'%m.%Y')
                                    else
                                        date_format(CURDATE(),'%m.%Y')
                                end periodeidactivity,
                                case 
                                    when DAY(CURDATE()) <= endactivity then
                                        CONCAT(MONTHNAME(DATE_SUB(CURDATE(), INTERVAL 1 MONTH)), ' ', YEAR(DATE_SUB(CURDATE(), INTERVAL 1 MONTH)))
                                    else
                                        CONCAT(MONTHNAME(CURDATE()), ' ', YEAR(CURDATE()))
                                end periodeketeranganactivity,
                                case 
                                    when DAY(CURDATE()) <= endactivity then
                                        CONCAT(MONTHNAME(CURDATE()), ' ', YEAR(CURDATE()))
                                    else
                                        CONCAT(MONTHNAME(DATE_ADD(CURDATE(), INTERVAL 1 MONTH)), ' ', YEAR(DATE_ADD(CURDATE(), INTERVAL 1 MONTH)))
                                end periodeketeranganbatassactivity,
                                case
                                    when DAY(CURDATE()) between startassessment and endassessment then
                                            CONCAT(MONTHNAME(CURDATE()), ' ', YEAR(CURDATE()))
                                    else
                                        CONCAT(MONTHNAME(DATE_ADD(CURDATE(), INTERVAL 1 MONTH)), ' ', YEAR(DATE_ADD(CURDATE(), INTERVAL 1 MONTH)))
                                end keteranganbatasassessment

                        from(
                        select
                            (select prod from dt01_gen_enviroment_ms where active='1' and org_id='".$orgid."' and environment_name='START_VALID_ASSESSMENT') startassessment,
                            (select prod from dt01_gen_enviroment_ms where active='1' and org_id='".$orgid."' and environment_name='END_VALID_ASSESSMENT') endassessment,
                            (select prod from dt01_gen_enviroment_ms where active='1' and org_id='".$orgid."' and environment_name='END_VALID_ACTIVITY') endactivity
                        )x                     
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

    }
?>