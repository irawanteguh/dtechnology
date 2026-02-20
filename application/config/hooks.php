<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    $hook['post_controller_constructor'] = array(
        'class'    => 'EnvironmentLoader',
        'function' => 'loadenvironment',
        'filename' => 'EnvironmentLoader.php',
        'filepath' => 'hooks',
        'params'   => array()
    );

?>