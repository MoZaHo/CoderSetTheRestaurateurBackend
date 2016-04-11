<?php

/**********************************************************************************************************************
 * MENU CONTROLLER
 *
 *********************************************************************************************************************/

namespace CoderSet\Controllers;

use Phalcon\Mvc\Controller;

class StaffController extends ControllerBase
{
	
	public function getAction() {
		error_log("[Controller][Staff/Get]");

		$obj = json_decode($this->request->getRawBody());
		
		error_log(json_encode($obj));
		
		$data = array();
		
		$link = \CoderSet\Models\LinkRestaurantBranchStaff::findByRestaurantBranchId($obj->branch);
		
		foreach ($link as $l) {
			$data[] = $l->Staff; 
		}
		
		$result = array(
				'status' => true,
				'data' => $data
		);
		 
		$this->response->setContent(json_encode($result));
		
	}
	
	public function setAction() {
		error_log("[Controller][Staff/Set]");
		
		$bCreateLink = false;
		
		$obj = json_decode($this->request->getRawBody());
		
		error_log(json_encode($obj->staff->id));
		
		if ($obj->staff->id == 0) {
			$bCreateLink = true;
			$staff = new \CoderSet\Models\Staff();
			$staff->id = 0;
			$staff->status = 1;
			$staff->restaurant_id = 1;
		} else {
			$staff = \CoderSet\Models\Staff::findFirstByid($obj->staff->id);
		}
		$staff->id_number = $obj->staff->id_number;
		$staff->name = $obj->staff->name;
		$staff->surname = $obj->staff->surname;
		$staff->email = $obj->staff->email;
		$staff->telephone = $obj->staff->telephone;
		
		if ($staff->save()) {
			error_log("Saved staff!");
			if ($bCreateLink) {
				$link = new \CoderSet\Models\LinkRestaurantBranchStaff();
				$link->staff_id = $staff->id;
				$link->restaurant_branch_id = 1;
				$link->save();
			}
			
			$data = array();
			
			$link = \CoderSet\Models\LinkRestaurantBranchStaff::findByRestaurantBranchId(1);
			
			foreach ($link as $l) {
				$data[] = $l->Staff;
			}
			
			$result = array(
					'status' => true,
					'data' => $data
			);
		} else {
			error_log("Defok?");
		}
			
		$this->response->setContent(json_encode($result));
	}
	
}