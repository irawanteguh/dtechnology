<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    $autoload['packages']  = array(APPPATH.'third_party/MX/');
    $autoload['libraries'] = array('database','session','template','tilaka','tilakaplus','mekari','satusehat','inacbg','Gatewaywhatsapp');
    $autoload['drivers']   = array();
    $autoload['helper']    = array('url','file','rootsystem','curl','authorization','jwt');
    $autoload['config']    = array();
    $autoload['language']  = array();
    $autoload['model']     = array();
    $autoload['time_zone'] = date_default_timezone_set('Asia/Jakarta');
?>