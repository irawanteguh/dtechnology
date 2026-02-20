<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	$active_group = 'mutiasari';
	$query_builder = TRUE;

	$db['mutiasari'] = array(
		'dsn'          => '',
		'hostname'     => '192.168.200.105',
		'username'     => 'joker',
		'password'     => 'midlane',
		'database'     => 'sikms',
		'dbdriver'     => 'mysqli',
		'dbprefix'     => '',
		'pconnect'     => FALSE,
		'db_debug'     => (ENVIRONMENT !== 'production'),
		'cache_on'     => FALSE,
		'cachedir'     => '',
		'char_set'     => 'utf8',
		'dbcollat'     => 'utf8_general_ci',
		'swap_pre'     => '',
		'encrypt'      => FALSE,
		'compress'     => FALSE,
		'stricton'     => FALSE,
		'failover'     => array(),
		'save_queries' => TRUE
	);

	$db['ibnu'] = array(
		'dsn'          => '',
		'hostname'     => '100.100.103.5',
		'port'         => '3307',
		'username'     => 'root',
		'password'     => 'haspro',
		'database'     => 'haspro_tilaka',
		'dbdriver'     => 'mysqli',
		'dbprefix'     => '',
		'pconnect'     => FALSE,
		'db_debug'     => (ENVIRONMENT !== 'production'),
		'cache_on'     => FALSE,
		'cachedir'     => '',
		'char_set'     => 'utf8',
		'dbcollat'     => 'utf8_general_ci',
		'swap_pre'     => '',
		'encrypt'      => FALSE,
		'compress'     => FALSE,
		'stricton'     => FALSE,
		'failover'     => array(),
		'save_queries' => TRUE
	);
?>
