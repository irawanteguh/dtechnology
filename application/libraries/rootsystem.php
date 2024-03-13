<?php
    class rootsystem {
        protected static $app;
        public static $segment;
        public static $resultmenu;

        public static function system()
        {
            self::init();
            self::checksession();
            self::generate_menu();
        }

        public static function checksession()
        {
            if(!self::$app->session->userdata('loggedin')){
                redirect("auth/error404");
            }
        }

        public static function init(){
            self::$app = &get_instance();
            self::$app->load->model("root/Modelroot");
            self::$segment          = self::$app->uri->segment(2);
            self::$resultmenu       = self::$app->Modelroot->menu();
        }

        public static function generate_menu(){
            $menu_html = "";
            $classbtn  = "";
            $classicon = "";
            $classli   = "";

            $menu_html = "<ul class='nav nav-pills nav-sidebar flex-column nav-child-indent' data-widget='treeview' role='menu' data-accordion='false'>";
            foreach (self::$resultmenu as $menu) {
                if ($menu["MODULES_HEADER_ID"] === '') {

                    $submenuActive = self::checkSubmenuActive($menu['MODULES_ID']);

                    if (self::$segment == $menu['DEF_CONTROLLER'] || $submenuActive) {
                        $classbtn  = "class='nav-link active'";
                        $classicon = "class='nav-icon ".$menu['ICON']." fa-fade'";
                        $classli   = "class='nav-item has-treeview menu-open'";
                    } else {
                        $classbtn  = "class='nav-link'";
                        $classicon = "class='nav-icon ".$menu['ICON']."'";
                        $classli   = "class='nav-item has-treeview'";
                    }

                    $menu_html .= "<li ".$classli.">";
                    if($menu["PARENT"]==="Y"){
                        $menu_html .= "<a href='#' ".$classbtn.">";
                    }else{
                        $menu_html .= "<a href='".base_url()."index.php/".$menu['PACKAGE']."/".$menu['DEF_CONTROLLER']."' ".$classbtn.">";
                    }
                    
                    $menu_html .= "<i ".$classicon."></i> ";
                    $menu_html .= "<p>".$menu['MODULES_NAME'];
                    if ($menu["PARENT"] === "Y") {
                        $menu_html .= "<i class='right fas fa-angle-left'></i>";
                    }
                    $menu_html .= "</p>";
                    $menu_html .= "</a>";
                    if ($menu["PARENT"] === "Y") {
                        $menu_html .= "<ul class='nav nav-treeview'>".self::generate_submenu($menu['MODULES_ID'], self::$resultmenu)."</ul>";
                    }
                    $menu_html .= "</li>";
                }
            }
            $menu_html .= "</ul>";

            if(!empty($menu_html)){
                $data["menu"]=$menu_html;
            }else{
                $data["menu"]="";
            }

            self::$app->load->vars($data);
        }

        public static function generate_submenu($parent_id){
            $submenu_html = "";
            $classbtn     = "";
            $classicon    = "";
            $classli      = "";

            foreach (self::$resultmenu as $submenu) {
                if ($submenu['MODULES_HEADER_ID'] === $parent_id) {

                    $submenuActive = self::checkSubmenuActive($submenu['MODULES_ID']);

                    if (self::$segment == $submenu['DEF_CONTROLLER'] || $submenuActive) {
                        $classbtn  = "class='nav-link active'";
                        $classicon = "class='nav-icon ".$submenu['ICON']." fa-fade'";
                        $classli   = "class='nav-item has-treeview menu-open'";
                    } else {
                        $classbtn  = "class='nav-link'";
                        $classicon = "class='nav-icon ".$submenu['ICON']."'";
                        $classli   = "class='nav-item has-treeview'";
                    }

                    $submenu_html .= "<li ".$classli.">";
                    if($submenu["PARENT"] === "Y"){
                        $submenu_html .= "<a href='#' ".$classbtn.">";
                    }else{
                        if($submenu['DEF_CONTROLLER']!=null){
                            $submenu_html .= "<a href='".base_url()."index.php/".$submenu['PACKAGE']."/".$submenu['DEF_CONTROLLER']."' ".$classbtn.">";
                        }else{
                            $submenu_html .= "<a href='#' ".$classbtn.">";
                        }
                    }

                    $submenu_html .= "<i ".$classicon."></i> ";
                    $submenu_html .= "<p>".$submenu['MODULES_NAME'];
                    if ($submenu["PARENT"] === "Y") {
                        $submenu_html .= "<i class='right fas fa-angle-left'></i>";
                    }
                    $submenu_html .= "</p>";
                    $submenu_html .= "</a>";
                    if ($submenu["PARENT"] === "Y") {
                        $submenu_html .= "<ul class='nav nav-treeview'>".self::generate_submenu($submenu['MODULES_ID'], self::$resultmenu)."</ul>";
                    }
                    $submenu_html .= "</li>";
                }
            }

            return $submenu_html;
        }

        public static function checkSubmenuActive($parent_id){
            foreach (self::$resultmenu as $submenu) {
                if ($submenu['MODULES_HEADER_ID'] === $parent_id) {
                    if ($submenu['DEF_CONTROLLER'] === self::$segment) {
                        return true;
                    }
                    
                    if ($submenu["PARENT"] === "Y") {
                        $submenuActive = self::checkSubmenuActive($submenu['MODULES_ID']);
                        if ($submenuActive) {
                            return true;
                        }
                    }
                }
            }
            
            return false;
        }
    
    }
?>