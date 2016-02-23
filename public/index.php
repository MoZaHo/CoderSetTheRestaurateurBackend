<?php

/**********************************************************************************************************************
 * INDEX
 *
 * This file acts as the one and only entry point into the application.  Controllers and actions are instantiated
 * from this point to handle a request.
 *********************************************************************************************************************/

error_reporting(E_ALL);

try {
    // Define some useful constants
    define('BASE_DIR', dirname(__DIR__));
    define('APP_DIR', BASE_DIR);
    define('APP_VERSION', '1.1');
  
	// Read the configuration
	$config = include APP_DIR . '/config/config.php';
	
	// Read auto-loader
	include APP_DIR . '/config/loader.php';
    
	// Read services
	include APP_DIR . '/config/services.php';
	
	// Handle the request
	$app = new \Phalcon\Mvc\Application($di);
    $app->useImplicitView(false);
    
    // $app->logger->log('Access');
    
    $app->response->setContentType('application/json', 'UTF-8');
    $app->response->setHeader('Access-Control-Allow-Origin', '*');
    $app->response->setHeader('Access-Control-Allow-Headers', 'X_ACCESS_TOKEN, X-ACCESS-TOKEN, Content-Type');
    
    // if this is an OPTIONS request, just respond
    if ($app->request->getMethod() == 'OPTIONS') {
        $app->response->send();
    } else {
    	echo $app->handle()->getContent();
    }
} catch (Exception $e) {
    $app->response->setContent(json_encode(array('success' => false, 'reason' => 'System error')));
	//echo $e->getMessage();
	//echo nl2br(htmlentities($e->getTraceAsString()));
	error_log("EXCEPTION: " . $e->getMessage());
    $app->response->send();
}
