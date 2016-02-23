<?php

/**********************************************************************************************************************
 * LOADER
 *
 * This file is responsible for autoloading custom classes as well as 3rd party composer classes
 *********************************************************************************************************************/

$loader = new \Phalcon\Loader();

// We're a registering a set of directories taken from the configuration file
$loader->registerNamespaces(array(
    'CoderSet\Models' => $config->application->modelsDir,
    'CoderSet\Controllers' => $config->application->controllersDir,
	'CoderSet' => $config->application->libraryDir
));

$loader->register();

// Use composer autoloader to load vendor classes
require_once __DIR__ . '/../vendor/autoload.php';