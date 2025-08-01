<?php
    class Rootsystem {
        protected static $app;
        public static $segment1;
        public static $segment2;
        public static $resultmenu;
        public static $resultreferensi;

        public static function system(){
            self::$app      = &get_instance();
            self::$segment1 = self::$app->uri->segment(1);

            self::checksession();

            if(self::$segment1!="auth" && self::$segment1!="booking" && self::$segment1!="public"){
                self::init();
                self::category();
                self::referensi();
            }
            
        }

        public static function checksession(){
            if(self::$app->uri->segment(1)!="auth" && self::$app->uri->segment(1)!="booking" && self::$app->uri->segment(1)!="public"){
                if(!self::$app->session->userdata('loggedin')){
                    redirect("auth/sign");
                }
            }
        }

        public static function init(){
            self::$app = &get_instance();
            self::$app->load->model("Modelroot");
            self::$segment1        = self::$app->uri->segment(1);
            self::$segment2        = self::$app->uri->segment(2);
            if($_SESSION['leveluser']==="83e9982c-814a-4349-89fb-cbee6f34e340"){
                $parameter="";
            }else{
                $parameter="and   a.modules_id in (select modules_id from dt01_gen_role_dt where active='1' and role_id in(select role_id from dt01_gen_role_access where active='1' and user_id='".$_SESSION['userid']."'))";
            }
            self::$resultmenu      = self::$app->Modelroot->menu($parameter);
            self::$resultreferensi = self::$app->Modelroot->referensi();
        }

        public static function category(){
            $category            = "";
            $menuheader          = "";
            $menuprofile         = "";
            $menuprofileshortcut = "";
            $menusupport         = "";
            $quicklink           = "";

            foreach (self::$resultmenu as $cat) {
                if($cat["PARENT"] === "C"){
                    $category .="<div class='menu-item'>";
                        $category .="<div class='menu-content pb-2'>";
                            $category .="<span class='menu-section text-muted text-uppercase fs-8 ls-1'>".$cat['MODULES_NAME']."</span>";
                        $category .="</div>";
                    $category .="</div>";
                    $category .=self::generate_menu($cat['MODULES_ID'], self::$resultmenu);
                    
                    $menuheader .="<div data-kt-menu-trigger='click' data-kt-menu-placement='bottom-start' class='menu-item menu-lg-down-accordion me-lg-1'>";
                        $menuheader .="<span class='menu-link py-3'><span class='menu-title'>".$cat['MODULES_NAME']."</span><span class='menu-arrow d-lg-none'></span></span>";
                        $menuheader .="<div class='menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px'>";
                            $menuheader .="<div data-kt-menu-trigger='{\"default\":\"click\", \"lg\": \"hover\"}' data-kt-menu-placement='right-start' class='menu-item menu-lg-down-accordion'>";
                                $menuheader .=self::generate_menuheader($cat['MODULES_ID'], self::$resultmenu);
                            $menuheader .="</div>";
                        $menuheader .="</div>";
                    $menuheader .="</div>";
                }else{
                    if($cat["PARENT"] === "N") {
                        if($cat['PACKAGE']==="profile"){
                            $isActive = ($cat['PACKAGE'] === self::$segment1 && $cat['DEF_CONTROLLER'] === self::$segment2);
                            $classbtn = $isActive ? "active" : "";

                            $menuprofile .="<li class='nav-item'>";
                            $menuprofile .="<a class='nav-link text-active-primary me-6 ".$classbtn."' href='".base_url()."index.php/".$cat['PACKAGE']."/".$cat['DEF_CONTROLLER']."'>".$cat['MODULES_NAME']."</a>";
                            $menuprofile .="</li>";

                            $menuprofileshortcut .="<div class='menu-item px-3'>";
                            $menuprofileshortcut .="<a class='menu-link px-5' href='".base_url()."index.php/".$cat['PACKAGE']."/".$cat['DEF_CONTROLLER']."'>".$cat['MODULES_NAME']."</a>";
                            $menuprofileshortcut .="</div>";
                        }

                        if($cat['PACKAGE']==="support"){
                            $isActive = ($cat['PACKAGE'] === self::$segment1 && $cat['DEF_CONTROLLER'] === self::$segment2);
                            $classbtn = $isActive ? "active" : "";

                            $menusupport .="<li class='nav-item my-1'>";
                            $menusupport .="<a class='btn btn-color-gray-600 btn-active-white btn-active-color-primary fw-boldest fs-8 fs-lg-base nav-link px-3 px-lg-8 mx-1 text-uppercase ".$classbtn."' href='".base_url()."index.php/".$cat['PACKAGE']."/".$cat['DEF_CONTROLLER']."'>".$cat['MODULES_NAME']."</a>";
                            $menusupport .="</li>";
                        }
                    }
                }

                if($cat["QUICK"] === "Y"){
                    $quicklink .="<div class='col-6'>";
                        $quicklink .="<a href='".base_url()."index.php/".$cat['PACKAGE']."/".$cat['DEF_CONTROLLER']."' class='d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end border-bottom'>";
                            $quicklink .="<i class='".$cat['ICON']." text-primary fa-2x mb-3'></i>";
                            $quicklink .= "<span class='fs-5 fw-bold text-gray-800 mb-0 text-center d-block text-truncate' style='max-width: 100%;'>".$cat['MODULES_NAME']."</span>";
                            $quicklink .="<span class='fs-7 text-gray-400'>".$cat['MODULES_NAME']."</span>";
                        $quicklink .="</a>";
                    $quicklink .="</div>";
                }
            }

            $data["menu"]                = !empty($category) ? $category    : "";
            $data["menuheader"]          = !empty($menuheader) ? $menuheader: "";
            $data["menuprofile"]         = !empty($menuprofile) ? $menuprofile: "";
            $data["menusupport"]         = !empty($menusupport) ? $menusupport: "";
            $data["menuprofileshortcut"] = !empty($menuprofileshortcut) ? $menuprofileshortcut: "";
            $data["quicklink"]           = !empty($quicklink) ? $quicklink    : "";

            self::$app->load->vars($data);
        }

        public static function generate_menuheader($parent_id){
            $menu_html = "";
        
            foreach(self::$resultmenu as $menu){
                if($menu["MODULES_HEADER_ID"] === $parent_id){
        
                    if($menu["PARENT"] === "Y"){
                        $menu_html .= "<div data-kt-menu-trigger='{default:\"click\", lg: \"hover\"}' data-kt-menu-placement='right-start' class='menu-item menu-lg-down-accordion'>";
                            $menu_html .= "<span class='menu-link py-3'><span class='menu-icon'><span class='svg-icon svg-icon-2'><i class='".$menu['ICON']."'></i></span></span><span class='menu-title'>".$menu['MODULES_NAME']."</span><span class='menu-arrow'></span></span>";
                            $menu_html .= "<div class='menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg py-lg-4 w-lg-225px'>";
                                $menu_html .= self::generate_submenuheader($menu['MODULES_ID'], self::$resultmenu);
                            $menu_html .= "</div>";
                        $menu_html .= "</div>";
                    } else {
                        $menu_html .= "<div class='menu-item'>";
                        $menu_html .= "<a class='menu-link py-3' href='".base_url()."index.php/".$menu['PACKAGE']."/".$menu['DEF_CONTROLLER']."' data-bs-toggle='tooltip' data-bs-trigger='hover' data-bs-dismiss='click' data-bs-placement='right' data-bs-original-title='Klik Untuk Membuka Menu ".$menu['MODULES_NAME']."'>";
                        $menu_html .= "<span class='menu-icon'>";
                        $menu_html .= "<span class='svg-icon svg-icon-2'>";
                        $menu_html .= "<i class='".$menu['ICON']."'></i>";
                        $menu_html .= "</span>";
                        $menu_html .= "</span>";
                        $menu_html .= "<span class='menu-title'>".$menu['MODULES_NAME']."</span>";
                        $menu_html .= "</a>";
                        $menu_html .= "</div>";
                    }
                }
            }
        
            return $menu_html;
        }
        
        public static function generate_submenuheader($parent_id){
            $submenu_html = "";
        
            foreach (self::$resultmenu as $submenu) {
                if ($submenu['MODULES_HEADER_ID'] === $parent_id) {

                    if($submenu["PARENT"] === "Y"){
                        $submenu_html .="<div data-kt-menu-trigger='{\"default\":\"click\", \"lg\": \"hover\"}' data-kt-menu-placement='right-start' class='menu-item menu-lg-down-accordion'>";
                        $submenu_html .="<span class='menu-link py-3'><span class='menu-icon'><span class='svg-icon svg-icon-2'><i class='".$submenu['ICON']."'></i></span></span><span class='menu-title'>".$submenu['MODULES_NAME']."</span><span class='menu-arrow'></span></span>";
                        $submenu_html .="<div class='menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg py-lg-4 w-lg-225px'>";
                        $submenu_html .= self::generate_submenuheader($submenu['MODULES_ID'], self::$resultmenu);
                        $submenu_html .="</div>";
                        $submenu_html .="</div>";
                    }else{
                        $submenu_html .="<div class='menu-item'>";
                        $submenu_html .="<a class='menu-link py-3' href='".base_url()."index.php/".$submenu['PACKAGE']."/".$submenu['DEF_CONTROLLER']."' data-bs-toggle='tooltip' data-bs-trigger='hover' data-bs-dismiss='click' data-bs-placement='right' data-bs-original-title='Klik Untuk Membuka Menu ".$submenu['MODULES_NAME']."'>";
                        $submenu_html .="<span class='menu-icon'>";
                        $submenu_html .="<span class='svg-icon svg-icon-2'>";
                        $submenu_html .="<i class='".$submenu['ICON']."'></i>";
                        $submenu_html .="</span>";
                        $submenu_html .="</span>";
                        $submenu_html .="<span class='menu-title'>".$submenu['MODULES_NAME']."</span>";
                        $submenu_html .="</a>";
                        $submenu_html .="</div>";
                    }
                }
            }
            return $submenu_html;
        }

        public static function generate_menu($parent_id){
            $menu_html = "";
            $classbtn  = "";
            $classhead = "";

            foreach(self::$resultmenu as $menu){
                if($menu["MODULES_HEADER_ID"] === $parent_id){

                    $isActive  = ($menu['PACKAGE'] === self::$segment1 && $menu['DEF_CONTROLLER'] === self::$segment2);
                    $isshow    = ($menu['PACKAGE'] === self::$segment1);

                    $classbtn  = $isActive ? "menu-link active" : "menu-link";
                    $classhead = $isshow ? "menu-item menu-accordion hover show" : "menu-item menu-accordion";

                    if($menu["PARENT"] === "Y"){
                        $menu_html .="<div data-kt-menu-trigger='click' class='".$classhead."'>";
                        $menu_html .="<span class='menu-link'>";
                        $menu_html .="<span class='menu-icon'>";
                        $menu_html .="<i class='".$menu['ICON']." fs-3'></i>";
                        $menu_html .="</span>";
                        $menu_html .="<span class='menu-title'>".$menu['MODULES_NAME']."</span>";
                        $menu_html .="<span class='menu-arrow'></span>";
                        $menu_html .="</span>";
                        $menu_html .="<div class='menu-sub menu-sub-accordion menu-active-bg' style=''>";
                        $menu_html .="<div data-kt-menu-trigger='click' class='".$classhead."'>";
                        $menu_html .= self::generate_submenu($menu['MODULES_ID'], self::$resultmenu);
                        $menu_html .="</div>";
                        $menu_html .="</div>";
                        $menu_html .="</div>";
                    }else{
                        $menu_html .="<div class='menu-item'>";
                        $menu_html .="<a class='".$classbtn."' href='".base_url()."index.php/".$menu['PACKAGE']."/".$menu['DEF_CONTROLLER']."'>";
                        $menu_html .="<span class='menu-icon'>";
                        $menu_html .="<i class='".$menu['ICON']." fs-3'></i>";
                        $menu_html .="</span>";
                        $menu_html .="<span class='menu-title'>".$menu['MODULES_NAME']."</span>";
                        $menu_html .="</a>";
                        $menu_html .="</div>";
                    }
                }
            }

            return $menu_html;
        }

        public static function generate_submenu($parent_id){
            $submenu_html = "";
        
            foreach (self::$resultmenu as $submenu) {
                if ($submenu['MODULES_HEADER_ID'] === $parent_id) {
                    $isActive = ($submenu['PACKAGE'] === self::$segment1 && $submenu['DEF_CONTROLLER'] === self::$segment2);
                    $isshow   = ($submenu['PACKAGE'] === self::$segment1);

                    $classbtn  = $isActive ? "menu-link active" : "menu-link";
                    $classhead = $isshow ? "menu-item menu-accordion show" : "menu-item menu-accordion";
        
                    if ($submenu["PARENT"] === "Y") {
                        $submenu_html .="<div data-kt-menu-trigger='click' class='".$classhead."'>";
                        $submenu_html .="<span class='menu-link'>";
                        $submenu_html .="<span class='menu-icon'>";
                        $submenu_html .="<i class='".$submenu['ICON']." fs-3'></i>";
                        $submenu_html .="</span>";
                        $submenu_html .="<span class='menu-title'>".$submenu['MODULES_NAME']."</span>";
                        $submenu_html .="<span class='menu-arrow'></span>";
                        $submenu_html .="</span>";
                        $submenu_html .="<div class='menu-sub menu-sub-accordion menu-active-bg' style=''>";
                        $submenu_html .="<div data-kt-menu-trigger='click' class='".$classhead."'>";
                        $submenu_html .= self::generate_submenu($submenu['MODULES_ID'], self::$resultmenu);
                        $submenu_html .="</div>";
                        $submenu_html .="</div>";
                        $submenu_html .="</div>";
                    } else {
                        $submenu_html .= "<div class='menu-item'>";
                        if($submenu['PACKAGE'] === "" || $submenu['DEF_CONTROLLER'] === ""){
                            $submenu_html .= "<a class='".$classbtn."' href='#'>";
                        } else {
                            $submenu_html .= "<a class='".$classbtn."' href='".base_url()."index.php/".$submenu['PACKAGE']."/".$submenu['DEF_CONTROLLER']."'>";
                        }
                        $submenu_html .="<span class='menu-icon'>";
                        $submenu_html .="<i class='".$submenu['ICON']." fs-3'></i>";
                        $submenu_html .="</span>";
                        $submenu_html .= "<span class='menu-title'>".$submenu['MODULES_NAME']."</span>";
                        $submenu_html .= "</a>";
                        $submenu_html .= "</div>";
                    }
                }
            }
            return $submenu_html;
        }

        public static function referensi(){
            $referensi = "";
            $itemCount = 0;
        
            foreach (self::$resultreferensi as $ref) {
                if ($itemCount % 5 == 0) {
                    if ($itemCount > 0) { 
                        $referensi .= "</div></div>";
                    }
                    $referensi .= "<div class='col-lg-4 border-left-lg-1'>";
                    $referensi .= "<div class='menu-inline menu-column menu-active-bg'>";
                }
                
                $referensi .= "<div class='menu-item'>";
                    $referensi .="<a href='".$ref['LINK']."' class='menu-link' target='_blank' title='".$ref['NOTE']."' data-bs-toggle='tooltip' data-bs-trigger='hover' data-bs-dismiss='click' data-bs-placement='right'>";
                        $referensi .="<span class='menu-icon'><i class='bi bi-box-arrow-up-right fs-3'></i></span>";
                        $referensi .="<span class='menu-title text-truncate'>".$ref['REFERENSI']."</span>";
                    $referensi .= "</a>";
                $referensi .= "</div>";
        
                $itemCount++; 
            }
        
            if ($itemCount > 0) {
                $referensi .= "</div></div>";
            }
        
            $data["referensi"] = !empty($referensi) ? $referensi : "";
        
            self::$app->load->vars($data);
        }
        
    }
?>
