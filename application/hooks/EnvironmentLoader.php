<?php

    class EnvironmentLoader {
        protected static $appInstance;
        public static $environmentSettings;

        public static function loadEnvironment() {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            self::$appInstance = get_instance();
            self::$appInstance->load->model("Modelroot");
            
            $orgId = isset($_SESSION['orgid']) ? $_SESSION['orgid'] : '378a0728-a914-43a5-ae90-186d8a052ff2';
            self::$environmentSettings = self::$appInstance->Modelroot->environment($orgId);

            if (!empty(self::$environmentSettings)) {
                foreach (self::$environmentSettings as $setting) {
                    if (!defined($setting['ENVIRONMENT_NAME'])) {
                        if (getenv('SERVER') === "DEV") {
                            define($setting['ENVIRONMENT_NAME'], $setting['DEV']);
                        } else {
                            define($setting['ENVIRONMENT_NAME'], $setting['PROD']);
                        }
                    }
                }
            } else {
                log_message('error', 'No environment settings found for the specified parameters.');
            }
        }
    }

?>
