<?php

/**********************************************************************************************************************
 * MENU CONTROLLER
 *
 *********************************************************************************************************************/

namespace CoderSet\Controllers;

use Phalcon\Mvc\Controller;

class BranchController extends ControllerBase
{
	
	public function getAction() {
		error_log("[Controller][Branch/Get]");

		$obj = json_decode($this->request->getRawBody());
		
		$data = array();
		
		if (!isset($obj->restaurant_branch_id)) {
			$branches = \CoderSet\Models\RestaurantBranch::find('restaurant_id = ' . $obj->restaurant_id);
		} else {
			$branches = \CoderSet\Models\RestaurantBranch::find('restaurant_id = ' . $obj->restaurant_id . ' AND id = ' . $obj->restaurant_branch_id);
		}
		
		foreach ($branches as $b) {
			$branch = array('id' => 0 , 'name' => '' , 'description' => '' , 'orders' => 0 , 'users' => 0);
			
			$branch['id'] = $b->id;
			$branch['name'] = $b->name;
			$branch['locationx'] = $b->locationx;
			$branch['locationy'] = $b->locationy;
			$branch['status'] = $b->status;
			
			
			//Get all active orders
			$orders = \CoderSet\Models\Session::find('restaurant_id = ' . $obj->restaurant_id . ' AND restaurant_branch_id = ' . $b->id . ' AND status = 1');
			$branch['orders'] = count($orders);
				
			foreach ($orders as $o) {
					
				//Get all the users for these active orders
				$users = \CoderSet\Models\SessionUser::find('session_id = ' . $o->id . ' AND status = 1');
			
				$branch['users'] += count($users);
			
			}
			
			$data[] = $branch;
		}
		
		$result = array(
				'status' => true,
				'data' => $data
		);
		 
		$this->response->setContent(json_encode($result));
		
	}
	
	public function setAction() {
		error_log("[Controller][Branch/Set]");
		
		$obj = json_decode($this->request->getRawBody());
		
		$b = json_decode($obj->branch);
		
		$data = array();
		
		$branch = \CoderSet\Models\RestaurantBranch::findFirstById($b->id);
		
		if ($branch) {
			//$branch = $b;
			$branch->status = $b->status;
			$branch->locationx = $b->locationx;
			$branch->locationy = $b->locationy;
			$branch->save();
		}
		
		
		
		$result = array(
				'status' => true,
				'data' => $data
		);
			
		$this->response->setContent(json_encode($result));
	}
	
}