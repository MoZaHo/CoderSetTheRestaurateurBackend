<?php

$router->add('menu/list[/]?{restaurant_branch_id:[0-9]*}', array(
		'controller' => 'menu',
		'action' => 'list'
));