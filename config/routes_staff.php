<?php

$router->add('staff/get[/]?{userid:[0-9]*}', array(
		'controller' => 'staff',
		'action' => 'get'
));

$router->add('staff/set[/]?{userid:[0-9]*}', array(
		'controller' => 'staff',
		'action' => 'set'
));
