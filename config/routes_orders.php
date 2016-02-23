<?php

$router->add('order/get[/]?{session_id:[0-9]*}', array(
		'controller' => 'order',
		'action' => 'get'
));


$router->add('order/add', array(
		'controller' => 'order',
		'action' => 'add'
));
