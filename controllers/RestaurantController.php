<?php

/**********************************************************************************************************************
 * MENU CONTROLLER
 *
 *********************************************************************************************************************/

namespace CoderSet\Controllers;

use Phalcon\Mvc\Controller;

class RestaurantController extends ControllerBase
{
	
	public function getAction() {

		$obj = json_decode($this->request->getRawBody());
		
		$data = array();
		
		if (!isset($obj->restaurant_id)) {
			$restaurants = \CoderSet\Models\Restaurant::find();
		} else {
			$restaurants = \CoderSet\Models\Restaurant::findById($obj->restaurant_id);
		}
		
		
		foreach ($restaurants as $r) {
			$res = array('id' => 0 , 'name' => $r->name , 'orders' => 0 , 'users' => 0);
			
			$res['id'] = $r->id;
			
			//Get all active orders
			$orders = \CoderSet\Models\Session::find('restaurant_id = ' . $r->id . ' AND status = 1');
			$res['orders'] = count($orders);
			
			foreach ($orders as $o) {
			
				//Get all the users for these active orders
				$users = \CoderSet\Models\SessionUser::find('session_id = ' . $o->id . ' AND status = 1');
				
				$res['users'] += count($users);
				
			}
			
			$data[] = $res;
		}
		
		$result = array(
				'status' => true,
				'data' => $data
		);
		 
		$this->response->setContent(json_encode($result));
		
	}
	
}