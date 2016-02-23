<?php

/**********************************************************************************************************************
 * INDEX CONTROLLER
 *
 * This file is the controller for all actions performed on the index (root)
 *********************************************************************************************************************/

namespace CoderSet\Controllers;

use Phalcon\Mvc\Controller;

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        $this->response->setContent(json_encode(array('success' => true, 'version' => APP_VERSION)));
    }
    
    public function route404Action()
    {
        $this->response->setStatusCode(404, "Not Found")->sendHeaders();
    }
    
}