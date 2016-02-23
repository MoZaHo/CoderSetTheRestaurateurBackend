<?php

/**********************************************************************************************************************
 * CONFIGURATION
 *
 * This file provides all the configuration settings needed throughout the application
 *********************************************************************************************************************/

return new \Phalcon\Config(array(
    'database' => array(
        'adapter' => 'Mysql',
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => 'M0rn300S',
        'dbname' => 'coderset_the_restauranteur',
    ),
    'application' => array(
        'controllersDir' => APP_DIR . '/controllers/',
        'modelsDir' => APP_DIR . '/models/',
    	'libraryDir' => APP_DIR . '/library/',
        'baseUri' => '/',
    ),
));