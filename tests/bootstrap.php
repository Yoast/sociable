<?php

// disable xdebug backtrace
if ( function_exists( 'xdebug_disable' ) ) {
	xdebug_disable();
}

echo 'Welcome to the Sociable test suite' . PHP_EOL;
echo 'Version: 1.0' . PHP_EOL . PHP_EOL;

$GLOBALS['wp_tests_options'] = array(
	'active_plugins' => array( 'sociable/sociable.php' ),
);

if( false !== getenv( 'WP_DEVELOP_DIR' ) ) {
	require getenv( 'WP_DEVELOP_DIR' ) . 'tests/phpunit/includes/bootstrap.php';
} else {
	require '../../../../tests/phpunit/includes/bootstrap.php';
}