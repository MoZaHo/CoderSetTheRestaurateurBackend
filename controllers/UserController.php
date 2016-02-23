<?php

/**********************************************************************************************************************
 * SERVICE CONTROLLER
 *
 * This file is the controller for all actions performed on the service table
 *********************************************************************************************************************/

namespace CoderSet\Controllers;

use Phalcon\Mvc\Controller;

class UserController extends ControllerBase
{
	
	public function loginAction() {

		$obj = json_decode($this->request->getRawBody());
		
		$user = \CoderSet\Models\User::findFirst("email = '".$obj->loginemail."'");
		
		$data = array();
		$data['rows'] = count($user);
		
		if (count($user) > 0) {
			$data['user'] = $user;
		}
		
		$result = array(
				'status' => true,
				'data' => $data
		);
		 
		$this->response->setContent(json_encode($result));
		
	}
	
}