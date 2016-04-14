<?php

$router->add('area/set[/]?{session_id:[0-9]*}', array(
		'controller' => 'area',
		'action' => 'set'
));

$router->add('area/get[/]?{restaurant_id:[0-9]*}', array(
		'controller' => 'area',
		'action' => 'get'
));

$router->add('area/del[/]?{session_id:[0-9]*}', array(
		'controller' => 'area',
		'action' => 'del'
));

$router->add('area/add[/]?{session_id:[0-9]*}', array(
		'controller' => 'area',
		'action' => 'add'
));
