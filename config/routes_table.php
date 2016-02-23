<?php

$router->add('table/get[/]?{session_id:[0-9]*}', array(
		'controller' => 'table',
		'action' => 'get'
));
