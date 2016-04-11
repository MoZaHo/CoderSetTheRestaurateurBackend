<?php

$router->add('restaurant/get[/]?{session_id:[0-9]*}', array(
		'controller' => 'restaurant',
		'action' => 'get'
));
