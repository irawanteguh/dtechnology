<?php
    class Modelleka extends CI_Model{

        function result($orgid,$transid){
            $query =
                    "
                        select x.*,
                            (
                                select
                                        case
                                            WHEN x.id='001' AND x.header_id='001' THEN GROUP_CONCAT(COALESCE(height_value, ''), ';', COALESCE(height_normal, ''), ';', COALESCE(height_note, ''), ';')
                                            WHEN x.id='002' AND x.header_id='001' THEN GROUP_CONCAT(COALESCE(weight_value, ''), ';', COALESCE(weight_normal, ''), ';', COALESCE(weight_note, ''), ';')
                                            WHEN x.id='003' AND x.header_id='001' THEN GROUP_CONCAT(COALESCE(bmi_value, ''), ';', COALESCE(bmi_normal, ''), ';', COALESCE(bmi_note, ''), ';')


                                            WHEN x.id='001' AND x.header_id='002' THEN GROUP_CONCAT(COALESCE(fat_zflv_value, ''), ';', COALESCE(fat_zflv_normal, ''), ';', COALESCE(fat_zflv_note, ''), ';')
                                            WHEN x.id='002' AND x.header_id='002' THEN GROUP_CONCAT(COALESCE(fat_jcdx_value, ''), ';', COALESCE(fat_jcdx_normal, ''), ';', COALESCE(fat_jcdx_note, ''), ';')
                                            WHEN x.id='003' AND x.header_id='002' THEN GROUP_CONCAT(COALESCE(fat_tsfl_value, ''), ';', COALESCE(fat_tsfl_normal, ''), ';', COALESCE(fat_tsfl_note, ''), ';')
                                            WHEN x.id='004' AND x.header_id='002' THEN GROUP_CONCAT(COALESCE(fat_tsflv_value, ''), ';', COALESCE(fat_tsflv_normal, ''), ';', COALESCE(fat_tsflv_note, ''), ';')
                                            WHEN x.id='005' AND x.header_id='002' THEN GROUP_CONCAT(COALESCE(fat_zfl_value, ''), ';', COALESCE(fat_zfl_normal, ''), ';', COALESCE(fat_zfl_note, ''), ';')
                                            WHEN x.id='006' AND x.header_id='002' THEN GROUP_CONCAT(COALESCE(fat_jrl_value, ''), ';', COALESCE(fat_jrl_normal, ''), ';', COALESCE(fat_jrl_note, ''), ';')
                                            WHEN x.id='007' AND x.header_id='002' THEN GROUP_CONCAT(COALESCE(fat_jrlv_value, ''), ';', COALESCE(fat_jrlv_normal, ''), ';', COALESCE(fat_jrlv_note, ''), ';')
                                            WHEN x.id='008' AND x.header_id='002' THEN GROUP_CONCAT(COALESCE(fat_gy_value, ''), ';', COALESCE(fat_gy_normal, ''), ';', COALESCE(fat_gy_note, ''), ';')
                                            WHEN x.id='009' AND x.header_id='002' THEN GROUP_CONCAT(COALESCE(fat_qztz_value, ''), ';', COALESCE(fat_qztz_normal, ''), ';', COALESCE(fat_qztz_note, ''), ';')
                                            WHEN x.id='010' AND x.header_id='002' THEN GROUP_CONCAT(COALESCE(fat_dbzlv_value, ''), ';', COALESCE(fat_dbzlv_normal, ''), ';', COALESCE(fat_dbzlv_note, ''), ';')
                                            WHEN x.id='011' AND x.header_id='002' THEN GROUP_CONCAT(COALESCE(fat_xbnyl_value, ''), ';', COALESCE(fat_xbnyl_normal, ''), ';', COALESCE(fat_xbnyl_note, ''), ';')
                                            WHEN x.id='012' AND x.header_id='002' THEN GROUP_CONCAT(COALESCE(fat_xbwyl_value, ''), ';', COALESCE(fat_xbwyl_normal, ''), ';', COALESCE(fat_xbwyl_note, ''), ';')
                                            WHEN x.id='013' AND x.header_id='002' THEN GROUP_CONCAT(COALESCE(fat_xbnylv_value, ''), ';', COALESCE(fat_xbnylv_normal, ''), ';', COALESCE(fat_xbnylv_note, ''), ';')
                                            WHEN x.id='014' AND x.header_id='002' THEN GROUP_CONCAT(COALESCE(fat_xbwylv_value, ''), ';', COALESCE(fat_xbwylv_normal, ''), ';', COALESCE(fat_xbwylv_note, ''), ';')
                                            WHEN x.id='015' AND x.header_id='002' THEN GROUP_CONCAT(COALESCE(fat_dbz_value, ''), ';', COALESCE(fat_dbz_normal, ''), ';', COALESCE(fat_dbz_note, ''), ';')
                                            WHEN x.id='016' AND x.header_id='002' THEN GROUP_CONCAT(COALESCE(fat_nzzf_value, ''), ';', COALESCE(fat_nzzf_normal, ''), ';', COALESCE(fat_nzzf_note, ''), ';')
                                            WHEN x.id='017' AND x.header_id='002' THEN GROUP_CONCAT(COALESCE(fat_gl_value, ''), ';', COALESCE(fat_gl_normal, ''), ';', COALESCE(fat_gl_note, ''), ';')


                                            WHEN x.id='001' AND x.header_id='003' THEN GROUP_CONCAT(COALESCE(tiwen_value, ''), ';', COALESCE(tiwen_normal, ''), ';', COALESCE(tiwen_note, ''), ';')

                                            WHEN x.id='001' AND x.header_id='004' THEN GROUP_CONCAT(COALESCE(spo2_sp_value, ''), ';', COALESCE(spo2_sp_normal, ''), ';', COALESCE(spo2_sp_note, ''), ';')

                                            WHEN x.id='001' AND x.header_id='005' THEN GROUP_CONCAT(COALESCE(blood_high_value, ''), ';', COALESCE(blood_high_normal, ''), ';', COALESCE(blood_high_note, ''), ';')
                                            WHEN x.id='002' AND x.header_id='005' THEN GROUP_CONCAT(COALESCE(blood_low_value, ''), ';', COALESCE(blood_low_normal, ''), ';', COALESCE(blood_low_note, ''), ';')
                                            WHEN x.id='003' AND x.header_id='005' THEN GROUP_CONCAT(COALESCE(blood_rate_value, ''), ';', COALESCE(blood_rate_normal, ''), ';', COALESCE(blood_rate_note, ''), ';')

                                            WHEN x.id='001' AND x.header_id='006' THEN GROUP_CONCAT(COALESCE(xt_type_value, ''), ';', COALESCE(xt_type_normal, ''), ';', COALESCE(xt_type_note, ''), ';')
                                            WHEN x.id='002' AND x.header_id='006' THEN GROUP_CONCAT(COALESCE(xt_value_value, ''), ';', COALESCE(xt_value_normal, ''), ';', COALESCE(xt_value_note, ''), ';')

                                            WHEN x.id='001' AND x.header_id='007' THEN GROUP_CONCAT(COALESCE(xhdb_value_value, ''), ';', COALESCE(xhdb_value_normal, ''), ';', COALESCE(xhdb_value_note, ''), ';')
                                            WHEN x.id='002' AND x.header_id='007' THEN GROUP_CONCAT(COALESCE(xzsx_chd_value, ''), ';', COALESCE(xzsx_chd_normal, ''), ';', COALESCE(xzsx_chd_note, ''), ';')
                                            WHEN x.id='003' AND x.header_id='007' THEN GROUP_CONCAT(COALESCE(xzsx_chol_value, ''), ';', COALESCE(xzsx_chol_normal, ''), ';', COALESCE(xzsx_chol_note, ''), ';')
                                            WHEN x.id='004' AND x.header_id='007' THEN GROUP_CONCAT(COALESCE(xzsx_hdl_value, ''), ';', COALESCE(xzsx_hdl_normal, ''), ';', COALESCE(xzsx_hdl_note, ''), ';')
                                            WHEN x.id='005' AND x.header_id='007' THEN GROUP_CONCAT(COALESCE(xzsx_ldl_value, ''), ';', COALESCE(xzsx_ldl_normal, ''), ';', COALESCE(xzsx_ldl_note, ''), ';')
                                            WHEN x.id='006' AND x.header_id='007' THEN GROUP_CONCAT(COALESCE(xzsx_tg_value, ''), ';', COALESCE(xzsx_tg_normal, ''), ';', COALESCE(xzsx_tg_note, ''), ';')


                                            WHEN x.id='001' AND x.header_id='008' THEN GROUP_CONCAT(COALESCE(dgc_value, ''), ';', COALESCE(dgc_normal, ''), ';', COALESCE(dgc_note, ''), ';')

                                            WHEN x.id='001' AND x.header_id='009' THEN GROUP_CONCAT(COALESCE(ns_value, ''), ';', COALESCE(ns_normal, ''), ';', COALESCE(ns_note, ''), ';')

                                            WHEN x.id='001' AND x.header_id='010' THEN GROUP_CONCAT(COALESCE(nyfx_bil_value, ''), ';', COALESCE(nyfx_bil_normal, ''), ';', COALESCE(nyfx_bil_note, ''), ';')
                                            WHEN x.id='002' AND x.header_id='010' THEN GROUP_CONCAT(COALESCE(nyfx_bld_value, ''), ';', COALESCE(nyfx_bld_normal, ''), ';', COALESCE(nyfx_bld_note, ''), ';')
                                            WHEN x.id='003' AND x.header_id='010' THEN GROUP_CONCAT(COALESCE(nyfx_ca_value, ''), ';', COALESCE(nyfx_ca_normal, ''), ';', COALESCE(nyfx_ca_note, ''), ';')
                                            WHEN x.id='004' AND x.header_id='010' THEN GROUP_CONCAT(COALESCE(nyfx_cre_value, ''), ';', COALESCE(nyfx_cre_normal, ''), ';', COALESCE(nyfx_cre_note, ''), ';')
                                            WHEN x.id='005' AND x.header_id='010' THEN GROUP_CONCAT(COALESCE(nyfx_glu_value, ''), ';', COALESCE(nyfx_glu_normal, ''), ';', COALESCE(nyfx_glu_note, ''), ';')
                                            WHEN x.id='006' AND x.header_id='010' THEN GROUP_CONCAT(COALESCE(nyfx_ket_value, ''), ';', COALESCE(nyfx_ket_normal, ''), ';', COALESCE(nyfx_ket_note, ''), ';')
                                            WHEN x.id='007' AND x.header_id='010' THEN GROUP_CONCAT(COALESCE(nyfx_leu_value, ''), ';', COALESCE(nyfx_leu_normal, ''), ';', COALESCE(nyfx_leu_note, ''), ';')
                                            WHEN x.id='008' AND x.header_id='010' THEN GROUP_CONCAT(COALESCE(nyfx_ma_value, ''), ';', COALESCE(nyfx_ma_normal, ''), ';', COALESCE(nyfx_ma_note, ''), ';')
                                            WHEN x.id='009' AND x.header_id='010' THEN GROUP_CONCAT(COALESCE(nyfx_nit_value, ''), ';', COALESCE(nyfx_nit_normal, ''), ';', COALESCE(nyfx_nit_note, ''), ';')
                                            WHEN x.id='010' AND x.header_id='010' THEN GROUP_CONCAT(COALESCE(nyfx_ph_value, ''), ';', COALESCE(nyfx_ph_normal, ''), ';', COALESCE(nyfx_ph_note, ''), ';')
                                            WHEN x.id='011' AND x.header_id='010' THEN GROUP_CONCAT(COALESCE(nyfx_pro_value, ''), ';', COALESCE(nyfx_pro_normal, ''), ';', COALESCE(nyfx_pro_note, ''), ';')
                                            WHEN x.id='012' AND x.header_id='010' THEN GROUP_CONCAT(COALESCE(nyfx_sg_value, ''), ';', COALESCE(nyfx_sg_normal, ''), ';', COALESCE(nyfx_sg_note, ''), ';')
                                            WHEN x.id='013' AND x.header_id='010' THEN GROUP_CONCAT(COALESCE(nyfx_ubg_value, ''), ';', COALESCE(nyfx_ubg_normal, ''), ';', COALESCE(nyfx_ubg_note, ''), ';')
                                            WHEN x.id='014' AND x.header_id='010' THEN GROUP_CONCAT(COALESCE(nyfx_vc_value, ''), ';', COALESCE(nyfx_vc_normal, ''), ';', COALESCE(nyfx_vc_note, ''), ';')
                                            

                                            WHEN x.id='001' AND x.header_id='011' THEN GROUP_CONCAT(COALESCE(fgn_bz_value, ''), ';', COALESCE(fgn_bz_normal, ''), ';', COALESCE(fgn_bz_note, ''), ';')
                                            WHEN x.id='002' AND x.header_id='011' THEN GROUP_CONCAT(COALESCE(fgn_fev1_value, ''), ';', COALESCE(fgn_fev1_normal, ''), ';', COALESCE(fgn_fev1_note, ''), ';')
                                            WHEN x.id='003' AND x.header_id='011' THEN GROUP_CONCAT(COALESCE(fgn_fvc_value, ''), ';', COALESCE(fgn_fvc_normal, ''), ';', COALESCE(fgn_fvc_note, ''), ';')
                                            WHEN x.id='004' AND x.header_id='011' THEN GROUP_CONCAT(COALESCE(fgn_bz_value, ''), ';', COALESCE(fgn_bz_normal, ''), ';', COALESCE(fgn_bz_note, ''), ';')
                                            
                                            WHEN x.id='001' AND x.header_id='012' THEN GROUP_CONCAT(COALESCE(ecg_data_value, ''), ';', '', ';', '', ';')
                                            WHEN x.id='002' AND x.header_id='012' THEN GROUP_CONCAT(COALESCE(ecg_result_value, ''), ';', '', ';', '', ';')
                                            WHEN x.id='003' AND x.header_id='012' THEN GROUP_CONCAT(COALESCE(ecg_xinlv_value, ''), ';', '', ';', '', ';')
                                            
                                            WHEN x.id='001' AND x.header_id='013' THEN GROUP_CONCAT(COALESCE(ecg12_data_value, ''), ';', '', ';', '', ';')
                                            WHEN x.id='002' AND x.header_id='013' THEN GROUP_CONCAT(COALESCE(ecg12_result_value, ''), ';', COALESCE(ecg12_result_normal, ''), ';', COALESCE(ecg12_result_note, ''), ';')
                                            WHEN x.id='003' AND x.header_id='013' THEN GROUP_CONCAT(COALESCE(ecg12_heart_rate_value, ''), ';', COALESCE(ecg12_heart_rate_normal, ''), ';', COALESCE(ecg12_heart_rate_note, ''), ';')
                                            WHEN x.id='004' AND x.header_id='013' THEN GROUP_CONCAT(COALESCE(ecg12_p_axis_value, ''), ';', COALESCE(ecg12_p_axis_normal, ''), ';', COALESCE(ecg12_p_axis_note, ''), ';')
                                            WHEN x.id='005' AND x.header_id='013' THEN GROUP_CONCAT(COALESCE(ecg12_qrs_axis_value, ''), ';', COALESCE(ecg12_qrs_axis_normal, ''), ';', COALESCE(ecg12_qrs_axis_note, ''), ';')
                                            WHEN x.id='006' AND x.header_id='013' THEN GROUP_CONCAT(COALESCE(ecg12_t_axis_value, ''), ';', COALESCE(ecg12_t_axis_normal, ''), ';', COALESCE(ecg12_t_axis_note, ''), ';')
                                            WHEN x.id='007' AND x.header_id='013' THEN GROUP_CONCAT(COALESCE(ecg12_pr_value, ''), ';', COALESCE(ecg12_pr_normal, ''), ';', COALESCE(ecg12_pr_note, ''), ';')
                                            WHEN x.id='008' AND x.header_id='013' THEN GROUP_CONCAT(COALESCE(ecg12_qrs_value, ''), ';', COALESCE(ecg12_qrs_normal, ''), ';', COALESCE(ecg12_qrs_note, ''), ';')
                                            WHEN x.id='009' AND x.header_id='013' THEN GROUP_CONCAT(COALESCE(ecg12_qt_value, ''), ';', COALESCE(ecg12_qt_normal, ''), ';', COALESCE(ecg12_qt_note, ''), ';')
                                            WHEN x.id='010' AND x.header_id='013' THEN GROUP_CONCAT(COALESCE(ecg12_qtc_value, ''), ';', COALESCE(ecg12_qtc_normal, ''), ';', COALESCE(ecg12_qtc_note, ''), ';')
                                            WHEN x.id='011' AND x.header_id='013' THEN GROUP_CONCAT(COALESCE(ecg12_rv5_value, ''), ';', COALESCE(ecg12_rv5_normal, ''), ';', COALESCE(ecg12_rv5_note, ''), ';')
                                            WHEN x.id='012' AND x.header_id='013' THEN GROUP_CONCAT(COALESCE(ecg12_sv1_value, ''), ';', COALESCE(ecg12_sv1_normal, ''), ';', COALESCE(ecg12_sv1_note, ''), ';')
                                            WHEN x.id='013' AND x.header_id='013' THEN GROUP_CONCAT(COALESCE(ecg12_sample_rate_value, ''), ';', COALESCE(ecg12_sample_rate_normal, ''), ';', COALESCE(ecg12_sample_rate_note, ''), ';')
                                            WHEN x.id='014' AND x.header_id='013' THEN GROUP_CONCAT(COALESCE(ecg12_sample_time_value, ''), ';', COALESCE(ecg12_sample_time_normal, ''), ';', COALESCE(ecg12_sample_time_note, ''), ';')
                                        
                                            WHEN x.id='001' AND x.header_id='014' THEN GROUP_CONCAT(COALESCE(ytb_waist_value, ''), ';', COALESCE(ytb_waist_normal, ''), ';', COALESCE(ytb_waist_note, ''), ';')
                                            WHEN x.id='002' AND x.header_id='014' THEN GROUP_CONCAT(COALESCE(ytb_hip_value, ''), ';', COALESCE(ytb_hip_normal, ''), ';', COALESCE(ytb_hip_note, ''), ';')
                                            WHEN x.id='003' AND x.header_id='014' THEN GROUP_CONCAT(COALESCE(ytb_whr_value, ''), ';', COALESCE(ytb_whr_normal, ''), ';', COALESCE(ytb_whr_note, ''), ';')
                                            
                                            WHEN x.id='001' AND x.header_id='015' THEN GROUP_CONCAT(COALESCE(shili_left_eye_value, ''), ';', COALESCE(shili_left_eye_normal, ''), ';', COALESCE(shili_left_eye_note, ''), ';')
                                            WHEN x.id='002' AND x.header_id='015' THEN GROUP_CONCAT(COALESCE(shili_right_eye_value, ''), ';', COALESCE(shili_right_eye_normal, ''), ';', COALESCE(shili_right_eye_note, ''), ';')
                                            
                                            WHEN x.id='001' AND x.header_id='016' THEN GROUP_CONCAT(COALESCE(semang_value, ''), ';', COALESCE(semang_normal, ''), ';', COALESCE(semang_note, ''), ';')
                                            
                                            WHEN x.id='001' AND x.header_id='017' THEN GROUP_CONCAT(COALESCE(xlcp_ucla_value, ''), ';', COALESCE(xlcp_ucla_normal, ''), ';', COALESCE(xlcp_ucla_note, ''), ';')
                                            WHEN x.id='002' AND x.header_id='017' THEN GROUP_CONCAT(COALESCE(xlcp_lnyy_value, ''), ';', COALESCE(xlcp_lnyy_normal, ''), ';', COALESCE(xlcp_lnyy_note, ''), ';')
                                            WHEN x.id='003' AND x.header_id='017' THEN GROUP_CONCAT(COALESCE(xlcp_zpyy_value, ''), ';', COALESCE(xlcp_zpyy_normal, ''), ';', COALESCE(xlcp_zpyy_note, ''), ';')
                                            WHEN x.id='004' AND x.header_id='017' THEN GROUP_CONCAT(COALESCE(xlcp_hmdjl_value, ''), ';', COALESCE(xlcp_hmdjl_normal, ''), ';', COALESCE(xlcp_hmdjl_note, ''), ';')
                                            WHEN x.id='005' AND x.header_id='017' THEN GROUP_CONCAT(COALESCE(xlcp_qxjkd_value, ''), ';', COALESCE(xlcp_qxjkd_normal, ''), ';', COALESCE(xlcp_qxjkd_note, ''), ';')
                                            WHEN x.id='006' AND x.header_id='017' THEN GROUP_CONCAT(COALESCE(xlcp_zcjkpd_value, ''), ';', COALESCE(xlcp_zcjkpd_normal, ''), ';', COALESCE(xlcp_zcjkpd_note, ''), ';')
                                            WHEN x.id='007' AND x.header_id='017' THEN GROUP_CONCAT(COALESCE(xlcp_shmyd_value, ''), ';', COALESCE(xlcp_shmyd_normal, ''), ';', COALESCE(xlcp_shmyd_note, ''), ';')
                                            WHEN x.id='008' AND x.header_id='017' THEN GROUP_CONCAT(COALESCE(xlcp_rgza_value, ''), ';', COALESCE(xlcp_rgza_normal, ''), ';', COALESCE(xlcp_rgza_note, ''), ';')
                                            WHEN x.id='009' AND x.header_id='017' THEN GROUP_CONCAT(COALESCE(xlcp_pstr_value, ''), ';', COALESCE(xlcp_pstr_normal, ''), ';', COALESCE(xlcp_pstr_note, ''), ';')
                                            WHEN x.id='010' AND x.header_id='017' THEN GROUP_CONCAT(COALESCE(xlcp_hfxx_value, ''), ';', COALESCE(xlcp_hfxx_normal, ''), ';', COALESCE(xlcp_hfxx_note, ''), ';')
                                            WHEN x.id='011' AND x.header_id='017' THEN GROUP_CONCAT(COALESCE(xlcp_eq_value, ''), ';', COALESCE(xlcp_eq_normal, ''), ';', COALESCE(xlcp_eq_note, ''), ';')
                                            WHEN x.id='012' AND x.header_id='017' THEN GROUP_CONCAT(COALESCE(xlcp_smzkpg_value, ''), ';', COALESCE(xlcp_smzkpg_normal, ''), ';', COALESCE(xlcp_smzkpg_note, ''), ';')
                                            
                                            WHEN x.id='001' AND x.header_id='018' THEN GROUP_CONCAT(COALESCE(zybs_value, ''), ';', '', ';', '', ';')
                                            WHEN x.id='002' AND x.header_id='018' THEN GROUP_CONCAT(COALESCE(zybs_1, ''), ';', '', ';', '', ';')
                                            WHEN x.id='003' AND x.header_id='018' THEN GROUP_CONCAT(COALESCE(zybs_2, ''), ';', '', ';', '', ';')
                                            WHEN x.id='004' AND x.header_id='018' THEN GROUP_CONCAT(COALESCE(zybs_3, ''), ';', '', ';', '', ';')
                                            WHEN x.id='005' AND x.header_id='018' THEN GROUP_CONCAT(COALESCE(zybs_4, ''), ';', '', ';', '', ';')
                                            WHEN x.id='006' AND x.header_id='018' THEN GROUP_CONCAT(COALESCE(zybs_5, ''), ';', '', ';', '', ';')
                                            WHEN x.id='007' AND x.header_id='018' THEN GROUP_CONCAT(COALESCE(zybs_6, ''), ';', '', ';', '', ';')
                                            WHEN x.id='008' AND x.header_id='018' THEN GROUP_CONCAT(COALESCE(zybs_7, ''), ';', '', ';', '', ';')
                                            WHEN x.id='009' AND x.header_id='018' THEN GROUP_CONCAT(COALESCE(zybs_8, ''), ';', '', ';', '', ';')
                                            WHEN x.id='010' AND x.header_id='018' THEN GROUP_CONCAT(COALESCE(zybs_9, ''), ';', '', ';', '', ';')
                                            else
                                            ';;;'
                                        end
                                from dt01_receivedata_data_leka
                                where org_id='".$orgid."'
                                and   transaksi_id='".$transid."'
                            )resultdata
                        from(
                            select '001' as id, 'H' as jenis, '' as header_id, 'Height Weight and BMI' as examination, '' as unit union
                            select '002' as id, 'H' as jenis, '' as header_id, 'Body Fat' as examination, '' as unit union
                            select '003' as id, 'H' as jenis, '' as header_id, 'Body Temperature' as examination, '' as unit union
                            select '004' as id, 'H' as jenis, '' as header_id, 'Blood Oxygen' as examination, '' as unit union
                            select '005' as id, 'H' as jenis, '' as header_id, 'Blood Pressure' as examination, '' as unit union
                            select '006' as id, 'H' as jenis, '' as header_id, 'Blood Sugar' as examination, '' as unit union
                            select '007' as id, 'H' as jenis, '' as header_id, 'Blood Test' as examination, '' as unit union
                            select '008' as id, 'H' as jenis, '' as header_id, 'Cholesterol' as examination, '' as unit union
                            select '009' as id, 'H' as jenis, '' as header_id, 'Uric Acid' as examination, '' as unit union
                            select '010' as id, 'H' as jenis, '' as header_id, 'Urine Test' as examination, '' as unit union
                            select '011' as id, 'H' as jenis, '' as header_id, 'Lung Function' as examination, '' as unit union
                            select '012' as id, 'H' as jenis, '' as header_id, 'Fast ECG' as examination, '' as unit union
                            select '013' as id, 'H' as jenis, '' as header_id, '12 Lead ECG' as examination, '' as unit union
                            select '014' as id, 'H' as jenis, '' as header_id, 'Waist Hip Rate' as examination, '' as unit union
                            select '015' as id, 'H' as jenis, '' as header_id, 'Vision' as examination, '' as unit union
                            select '016' as id, 'H' as jenis, '' as header_id, 'Color Blindness' as examination, '' as unit union
                            select '017' as id, 'H' as jenis, '' as header_id, 'Psychological Tests' as examination, '' as unit union
                            select '018' as id, 'H' as jenis, '' as header_id, 'TCM Constitution Identification' as examination, '' as unit union
                            
                            select '001' as id, 'D' as jenis, '001' as header_id, 'Height' as examination, 'cm' as unit union
                            select '002' as id, 'D' as jenis, '001' as header_id, 'Weight' as examination, 'kg' as unit union
                            select '003' as id, 'D' as jenis, '001' as header_id, 'Body Mass Index (BMI) [Ratio]' as examination, 'kg/m2' as unit union

                            select '001' as id, 'D' as jenis, '002' as header_id, 'Fat Rate' as examination, '%' as unit union
                            select '002' as id, 'D' as jenis, '002' as header_id, 'Basal metabolism' as examination, 'kcal' as unit union
                            select '003' as id, 'D' as jenis, '002' as header_id, 'Water Content' as examination, 'kg' as unit union
                            select '004' as id, 'D' as jenis, '002' as header_id, 'Water Rate' as examination, '%' as unit union
                            select '005' as id, 'D' as jenis, '002' as header_id, 'Fat Content' as examination, 'kg' as unit union
                            select '006' as id, 'D' as jenis, '002' as header_id, 'Muscle Content' as examination, 'kg' as unit union
                            select '007' as id, 'D' as jenis, '002' as header_id, 'Muscle Rate' as examination, '%' as unit union
                            select '008' as id, 'D' as jenis, '002' as header_id, 'Bone Salt' as examination, 'kg' as unit union
                            select '009' as id, 'D' as jenis, '002' as header_id, 'Fat Free Mass' as examination, 'kg' as unit union
                            select '010' as id, 'D' as jenis, '002' as header_id, 'Protein Rate' as examination, '%' as unit union
                            select '011' as id, 'D' as jenis, '002' as header_id, 'Intracellular Fluid Volume' as examination, 'L' as unit union
                            select '012' as id, 'D' as jenis, '002' as header_id, 'Extracellular Fluid Volume' as examination, 'L' as unit union
                            select '013' as id, 'D' as jenis, '002' as header_id, 'Intracellular Fluid Rate' as examination, '%' as unit union
                            select '014' as id, 'D' as jenis, '002' as header_id, 'Extracellular fluid rate' as examination, 'L' as unit union
                            select '015' as id, 'D' as jenis, '002' as header_id, 'protein' as examination, 'L' as unit union
                            select '016' as id, 'D' as jenis, '002' as header_id, 'Visceral' as examination, 'L' as unit union
                            select '017' as id, 'D' as jenis, '002' as header_id, 'bone mass' as examination, 'L' as unit union

                            select '001' as id, 'D' as jenis, '003' as header_id, 'Temperature' as examination, '°C' as unit union
                            select '001' as id, 'D' as jenis, '004' as header_id, 'Blood Oxygen' as examination, '%' as unit union
                            select '001' as id, 'D' as jenis, '005' as header_id, 'Systolic Blood Pressure' as examination, 'mmHg' as unit union
                            select '002' as id, 'D' as jenis, '005' as header_id, 'Diastolic Blood Pressure' as examination, 'mmHg' as unit union
                            select '003' as id, 'D' as jenis, '005' as header_id, 'Heart Rate' as examination, 'bpm' as unit union
                            select '001' as id, 'D' as jenis, '006' as header_id, 'Types of Blood Glucose Measurement' as examination, '' as unit union
                            select '002' as id, 'D' as jenis, '006' as header_id, 'Blood Glucose Level' as examination, 'mg/dL' as unit union
                            select '001' as id, 'D' as jenis, '007' as header_id, 'Hemoglobin' as examination, '' as unit union
                            select '002' as id, 'D' as jenis, '007' as header_id, 'Cholesterol Ratio' as examination, '' as unit union
                            select '003' as id, 'D' as jenis, '007' as header_id, 'Total Cholesterol' as examination, '' as unit union
                            select '004' as id, 'D' as jenis, '007' as header_id, 'High Density Lipoprotein' as examination, '' as unit union
                            select '005' as id, 'D' as jenis, '007' as header_id, 'Lipo Density Lipoprotein' as examination, '' as unit union
                            select '006' as id, 'D' as jenis, '007' as header_id, 'Tryglyceride' as examination, '' as unit union

                            select '001' as id, 'D' as jenis, '008' as header_id, 'Cholesterol value' as examination, 'mg/dL' as unit union

                            select '001' as id, 'D' as jenis, '009' as header_id, 'Uric acid value' as examination, 'mg/dL' as unit union
                            
                            select '001' as id, 'D' as jenis, '010' as header_id, 'Billirubin' as examination, '' as unit union
                            select '002' as id, 'D' as jenis, '010' as header_id, 'Billirubin ratio' as examination, '' as unit union
                            select '003' as id, 'D' as jenis, '010' as header_id, 'Calsium' as examination, '' as unit union
                            select '004' as id, 'D' as jenis, '010' as header_id, 'Creatinin' as examination, '' as unit union
                            select '005' as id, 'D' as jenis, '010' as header_id, 'Glucose' as examination, '' as unit union
                            select '006' as id, 'D' as jenis, '010' as header_id, 'Keton' as examination, '' as unit union
                            select '007' as id, 'D' as jenis, '010' as header_id, 'Leucocyte' as examination, '' as unit union
                            select '008' as id, 'D' as jenis, '010' as header_id, 'Magnesium' as examination, '' as unit union
                            select '009' as id, 'D' as jenis, '010' as header_id, 'Nitrogen' as examination, '' as unit union
                            select '010' as id, 'D' as jenis, '010' as header_id, 'Acidity measurement' as examination, '' as unit union
                            select '011' as id, 'D' as jenis, '010' as header_id, 'Protein' as examination, '' as unit union
                            select '012' as id, 'D' as jenis, '010' as header_id, 'Urinary specific gravity' as examination, '' as unit union
                            select '013' as id, 'D' as jenis, '010' as header_id, 'Urobilinogen' as examination, '' as unit union
                            select '014' as id, 'D' as jenis, '010' as header_id, 'Vitamin C' as examination, '' as unit union

                            select '001' as id, 'D' as jenis, '011' as header_id, 'Peak expiratory flow' as examination, 'L/min' as unit union
                            select '002' as id, 'D' as jenis, '011' as header_id, 'Forced expiratory volume in the first second' as examination, 'L' as unit union
                            select '003' as id, 'D' as jenis, '011' as header_id, 'forced vital capacity' as examination, 'L' as unit union
                            select '004' as id, 'D' as jenis, '011' as header_id, 'Forced expiratory volume in the first second / forced vital capacity' as examination, '%' as unit union

                            select '001' as id, 'D' as jenis, '012' as header_id, 'ECG result' as examination, '' as unit union
                            select '002' as id, 'D' as jenis, '012' as header_id, 'ECG waveform picture data' as examination, '' as unit union
                            select '003' as id, 'D' as jenis, '012' as header_id, 'ECG waveform picture data length' as examination, 'ms' as unit union
                            select '001' as id, 'D' as jenis, '013' as header_id, 'Ecg report picture data' as examination, '' as unit union
                            select '002' as id, 'D' as jenis, '013' as header_id, 'diagnosis result' as examination, '' as unit union
                            select '003' as id, 'D' as jenis, '013' as header_id, 'heart rate' as examination, 'bpm' as unit union
                            select '004' as id, 'D' as jenis, '013' as header_id, 'P axis' as examination, 'degrees' as unit union
                            select '005' as id, 'D' as jenis, '013' as header_id, 'QRS axis' as examination, 'degrees' as unit union
                            select '006' as id, 'D' as jenis, '013' as header_id, 'T axis' as examination, 'degrees' as unit union
                            select '007' as id, 'D' as jenis, '013' as header_id, 'PR interval' as examination, 'ms' as unit union
                            select '008' as id, 'D' as jenis, '013' as header_id, 'QRS time limit' as examination, 'ms' as unit union
                            select '009' as id, 'D' as jenis, '013' as header_id, 'QT interval' as examination, 'ms' as unit union
                            select '010' as id, 'D' as jenis, '013' as header_id, 'QTc interval' as examination, 'ms' as unit union
                            select '011' as id, 'D' as jenis, '013' as header_id, 'RV5 value' as examination, 'mV' as unit union
                            select '012' as id, 'D' as jenis, '013' as header_id, 'SV1 value' as examination, 'mV' as unit union
                            select '013' as id, 'D' as jenis, '013' as header_id, 'sampling frequency' as examination, 'Hz' as unit union
                            select '014' as id, 'D' as jenis, '013' as header_id, 'Sampling duration' as examination, 's' as unit union
                            select '001' as id, 'D' as jenis, '014' as header_id, 'waistline' as examination, 'cm' as unit union
                            select '002' as id, 'D' as jenis, '014' as header_id, 'hipline' as examination, 'cm' as unit union
                            select '003' as id, 'D' as jenis, '014' as header_id, 'waist hip rate' as examination, '' as unit union
                            select '001' as id, 'D' as jenis, '015' as header_id, 'left eye' as examination, '' as unit union
                            select '002' as id, 'D' as jenis, '015' as header_id, 'Visual acuity of the left eye' as examination, '' as unit union
                            select '003' as id, 'D' as jenis, '015' as header_id, 'Left eye visual cues' as examination, '' as unit union
                            select '004' as id, 'D' as jenis, '015' as header_id, 'right eye' as examination, '' as unit union
                            select '005' as id, 'D' as jenis, '015' as header_id, 'Visual acuity of the right eye' as examination, '' as unit union
                            select '006' as id, 'D' as jenis, '015' as header_id, 'Visual cues in right eye' as examination, '' as unit union
                            select '001' as id, 'D' as jenis, '016' as header_id, 'Color blindness result' as examination, '' as unit union
                            select '001' as id, 'D' as jenis, '017' as header_id, 'UCLA Loneliness scale score' as examination, '' as unit union
                            select '002' as id, 'D' as jenis, '017' as header_id, 'Geriatric depression Scale score' as examination, '' as unit union
                            select '003' as id, 'D' as jenis, '017' as header_id, 'Self-rated depression scale score' as examination, '' as unit union
                            select '004' as id, 'D' as jenis, '017' as header_id, 'Hamilton Anxiety Scale score' as examination, '' as unit union
                            select '005' as id, 'D' as jenis, '017' as header_id, 'Emotional health test scores' as examination, '' as unit union
                            select '006' as id, 'D' as jenis, '017' as header_id, 'Self-measured health rating scale score' as examination, '' as unit union
                            select '007' as id, 'D' as jenis, '017' as header_id, 'Life satisfaction Scale score' as examination, '' as unit union
                            select '008' as id, 'D' as jenis, '017' as header_id, 'Personality disorder personality test score' as examination, '' as unit union
                            select '009' as id, 'D' as jenis, '017' as header_id, 'PSTR Adult stress test scores' as examination, '' as unit union
                            select '010' as id, 'D' as jenis, '017' as header_id, 'Harvard sexuality test score' as examination, '' as unit union
                            select '011' as id, 'D' as jenis, '017' as header_id, 'Emotional intelligence (EQ) test score' as examination, '' as unit union
                            select '012' as id, 'D' as jenis, '017' as header_id, 'Sleep status assessment score' as examination, '' as unit union
                            select '001' as id, 'D' as jenis, '018' as header_id, 'TCM constitution type' as examination, '' as unit union
                            select '002' as id, 'D' as jenis, '018' as header_id, 'Yang deficiency quality score' as examination, '' as unit union
                            select '003' as id, 'D' as jenis, '018' as header_id, 'Yin deficiency quality score' as examination, '' as unit union
                            select '004' as id, 'D' as jenis, '018' as header_id, 'Qi deficiency quality score' as examination, '' as unit union
                            select '005' as id, 'D' as jenis, '018' as header_id, 'Phlegm-dampness score' as examination, '' as unit union
                            select '006' as id, 'D' as jenis, '018' as header_id, 'Humidity and heat quality score' as examination, '' as unit union
                            select '007' as id, 'D' as jenis, '018' as header_id, 'Blood stasis score' as examination, '' as unit union
                            select '008' as id, 'D' as jenis, '018' as header_id, 'Special quality score' as examination, '' as unit union
                            select '009' as id, 'D' as jenis, '018' as header_id, 'Qi stagnation quality score' as examination, '' as unit union
                            select '010' as id, 'D' as jenis, '018' as header_id, 'Peace and quality score' as examination, '' as unit

                        )x

                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function listexamination($orgid){
            $query =
                    "
                        select a.transaksi_id, name, photo, encounter_id, id_number, upper(LEFT(a.name, 1)) initial, sex, nation, bod, address, exam_id, device_id, age, date_format(created_date,'%d.%m.%Y')createddate,
                               ecg12_data_value
                        from dt01_receivedata_data_leka a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function resultexaminationsatusehat($orgid,$transsaksiid){
            $query =
                    "
                        select a.*,  DATE_FORMAT(DATE_SUB(created_date, INTERVAL 7 HOUR), '%Y-%m-%dT%H:%i:%s') assessmentdate
                        from dt01_receivedata_data_leka a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.transaksi_id='".$transsaksiid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updateencounter($data, $transid){           
            $sql =   $this->db->update("dt01_receivedata_data_leka",$data,array("transaksi_id"=>$transid));
            return $sql;
        }

        function insertlogsatusehat($data){           
            $sql =   $this->db->insert("dt01_satusehat_bundle",$data);
            return $sql;
        }

    }
?>