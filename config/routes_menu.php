<?php

$router->add('menu/list[/]?{restaurant_branch_id:[0-9]*}', array(
		'controller' => 'menu',
		'action' => 'list'
));

$router->add('menu/get[/]?{restaurant_branch_id:[0-9]*}', array(
		'controller' => 'menu',
		'action' => 'get'
));

$router->add('menu/add', array(
		'controller' => 'menu',
		'action' => 'add'
));

$router->add('menusection/add', array(
		'controller' => 'menu',
		'action' => 'addsection'
));

$router->add('menusection/edit', array(
		'controller' => 'menu',
		'action' => 'editsection'
));

