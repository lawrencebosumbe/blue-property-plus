<?php
	include('config/path.php');
	include('config/config.php');
	
	// Auto loader
	function load_libs($class) {
		require_once(LIBS . $class .".php");
	}
	
	spl_autoload_register('load_libs');

	$app = new Bootstrap();
	
	