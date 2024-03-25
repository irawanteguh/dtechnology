<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	$active_group = 'dtech';
	$query_builder = TRUE;

	// $db['default'] = array(
	// 	'dsn'          => '',
	// 	'hostname'     => 'localhost',
	// 	'username'     => 'postgres',
	// 	'password'     => 'Davin25012020',
	// 	'database'     => 'postgres',
	// 	'dbdriver'     => 'postgre',
	// 	'dbprefix'     => '',
	// 	'pconnect'     => FALSE,
	// 	'db_debug'     => (ENVIRONMENT !== 'production'),
	// 	'cache_on'     => FALSE,
	// 	'cachedir'     => '',
	// 	'char_set'     => 'utf8',
	// 	'dbcollat'     => 'utf8_general_ci',
	// 	'swap_pre'     => '',
	// 	'encrypt'      => FALSE,
	// 	'compress'     => FALSE,
	// 	'stricton'     => FALSE,
	// 	'failover'     => array(),
	// 	'save_queries' => TRUE
	// );

	$db['dtech'] = array(
		'dsn'          => '',
		'hostname'     => 'localhost',
		'username'     => 'root',
		'password'     => '',
		'database'     => 'dtech',
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

	$db['sikms'] = array(
		'dsn'          => '',
		'hostname'     => 'localhost',
		'username'     => 'root',
		'password'     => '',
		'database'     => 'mutiasariagustus',
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