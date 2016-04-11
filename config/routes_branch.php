<?php

$router->add('branch/get[/]?{session_id:[0-9]*}', array(
		'controller' => 'branch',
		'action' => 'get'
));

$router->add('branch/set', array(
		'controller' => 'branch',
		'action' => 'set'
));
