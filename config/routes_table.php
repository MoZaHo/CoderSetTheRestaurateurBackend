<?php

$router->add('table/get[/]?{session_id:[0-9]*}', array(
		'controller' => 'table',
		'action' => 'get'
));

$router->add('table/set[/]?{session_id:[0-9]*}', array(
		'controller' => 'table',
		'action' => 'set'
));

$router->add('table/add[/]?{session_id:[0-9]*}', array(
		'controller' => 'table',
		'action' => 'add'
));

$router->add('table/del[/]?{session_id:[0-9]*}', array(
		'controller' => 'table',
		'action' => 'del'
));
