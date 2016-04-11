<?php

/**********************************************************************************************************************
 * MENU CONTROLLER
 *
 *********************************************************************************************************************/

namespace CoderSet\Controllers;

use Phalcon\Mvc\Controller;

class TableController extends ControllerBase
{
	
	public function getAction() {
		error_log("[Controller][Table/Get]");

		$obj = json_decode($this->request->getRawBody('userid'));
		
		$data = array();
		
		$table = \CoderSet\Models\RestaurantBranchAreaTable::find('restaurant_branch_area_id = '.$obj->restaurant_branch_area_id);
		foreach($table as $t) {
			$data[] = $t;
		}
		
		$result = array(
				'status' => true,
				'data' => $data
		);
		 
		$this->response->setContent(json_encode($result));
		
	}
	
	public function delAction() {
		error_log("[Controller][Table/Del]");
		
		$obj = json_decode($this->request->getRawBody());
		
		$update_table = $obj->table;
		$table = \CoderSet\Models\RestaurantBranchAreaTable::findFirst('id = ' . $update_table->id);
		
		if ($table) {
			$table->delete();
		}
		
		$data = array();
		
		$result = array(
				'status' => true,
				'data' => $data
		);
			
		$this->response->setContent(json_encode($result));
	}
	
	public function setAction() {
		error_log("[Controller][Table/Set]");
	
		$obj = json_decode($this->request->getRawBody());
	
		$update_table = $obj->table;
		$table = \CoderSet\Models\RestaurantBranchAreaTable::findFirst('id = ' . $update_table->id);
		
		if ($table) {
			$table->display_name = $update_table->display_name;
			$table->save();
		}
		
	
		$data = array();
	
		$result = array(
				'status' => true,
				'data' => $data
		);
			
		$this->response->setContent(json_encode($result));
	
	}
	
	public function addAction() {
		error_log("[Controller][Table/Add]");
		
		$obj = json_decode($this->request->getRawBody());
		
		error_log(json_encode($obj));
		
		$table = new \CoderSet\Models\RestaurantBranchAreaTable();
		$table->restaurant_branch_area_id = $obj->restaurant_branch_area_id;
		$table->hashed = '';
		
		error_log(json_encode($table));
		
		if ($table->save()) {
			error_log("Saving?");
			$table->hashed = MD5($obj->restaurant_id."-".$obj->restaurant_branch_id."-".$table->id);
			$table->save();
		}
		
		$data = array();
		
		$data[] = $table;
		
		$result = array(
				'status' => true,
				'data' => $data
		);
			
		$this->response->setContent(json_encode($result));
		
	}
	
	
	
}