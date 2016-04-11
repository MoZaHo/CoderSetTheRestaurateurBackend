<?php

/**********************************************************************************************************************
 * ROUTES
 *
 * This file registers all the routes available in the application
 *********************************************************************************************************************/

$router = new Phalcon\Mvc\Router(false);

$router->notFound(array(
    'controller' => 'index',
    'action' => 'route404'
));

$router->add('/', array(
    'controller' => 'index',
    'action' => 'index'
));

require_once 'routes_area.php';
require_once 'routes_branch.php';
require_once 'routes_menu.php';
require_once 'routes_orders.php';
require_once 'routes_payment.php';
require_once 'routes_restaurant.php';
require_once 'routes_session.php';
require_once 'routes_staff.php';
require_once 'routes_table.php';
require_once 'routes_user.php';

return $router;