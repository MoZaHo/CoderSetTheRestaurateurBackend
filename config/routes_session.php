<?php

$router->add('session/list[/]?{userid:[0-9]*}', array(
		'controller' => 'session',
		'action' => 'list'
));

$router->add('session/checkin', array(
		'controller' => 'session',
		'action' => 'checkin'
));

$router->add('session/userupdate', array(
		'controller' => 'session',
		'action' => 'userupdate'
));

$router->add('session/getactivesessions', array(
		'controller' => 'session',
		'action' => 'getactivesessions'
));

