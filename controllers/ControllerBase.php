<?php

/**********************************************************************************************************************
 * BASE CONTROLLER
 *
 * This file serves as the base for all controllers in the application
 *********************************************************************************************************************/

namespace CoderSet\Controllers;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

class ControllerBase extends Controller
{
    /**
     * Execute before the router so we can determine if this is a private controller, and must be authenticated, or a
     * public controller that is open to all.
     *
     * @param Dispatcher $dispatcher
     * @return boolean
     */
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {

        $header = $this->request->getHeader('X-ACCESS-TOKEN');
        if (empty($header)) {
            $header = $this->request->getHeader('X_ACCESS_TOKEN');
        }
        
        $controllerName = $dispatcher->getControllerName();
        $actionName = $dispatcher->getActionName();
        
        
    }
}