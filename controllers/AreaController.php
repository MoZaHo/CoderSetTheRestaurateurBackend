<?php

/**********************************************************************************************************************
 * MENU CONTROLLER
 *
 *********************************************************************************************************************/

namespace CoderSet\Controllers;

use Phalcon\Mvc\Controller;

class AreaController extends ControllerBase
{

	public function setAction() {
		error_log("[Controller][Area/Set]");

		$obj = json_decode($this->request->getRawBody());

		$area = $obj->area;

		$data = array();

		$area_new = \CoderSet\Models\RestaurantBranchArea::findFirst('id = ' . $area->id);

		if ($area_new) {
			error_log("here : " . json_encode($area));
			$area_new->restaurant_branch_id = $area->restaurant_branch_id;
			$area_new->name = $area->name;
			$area_new->status = 1;
			$area_new->save();
		}

		$result = array(
				'status' => true,
				'data' => $data
		);

		$this->response->setContent(json_encode($result));
	}

	public function delAction() {
		error_log("[Controller][Area/Del]");

		$obj = json_decode($this->request->getRawBody());

		$area = $obj->area;

		$data = array();

		$area_new = \CoderSet\Models\RestaurantBranchArea::findFirst('id = ' . $area->id);

		if ($area_new) {
			$area_new->status = 0;
			$area_new->save();
		}

		$result = array(
				'status' => true,
				'data' => $data
		);

		$this->response->setContent(json_encode($result));
	}

	public function addAction() {
		error_log("[Controller][Area/Add]");

		$obj = json_decode($this->request->getRawBody());

		$data = array();

		$area = new \CoderSet\Models\RestaurantBranchArea();

		$area->restaurant_branch_id = $obj->restaurant_branch_id;
		$area->name = 'new area';
		$area->status = '1';
		$area->save();

		$result = array(
				'status' => true,
				'data' => $data
		);

		$this->response->setContent(json_encode($result));

	}

	public function getAction() {
		error_log("[Controller][Area/Get]");

		//$obj = json_decode($this->request->getRawBody());
		$obj = (object) array("restaurant_branch_id" => "1" , "include_tables" => true);

		$data = array();

		$area = \CoderSet\Models\RestaurantBranchArea::find('restaurant_branch_id = ' . $obj->restaurant_branch_id . ' AND status = \'1\'');

		$tmp_holder = array();

		foreach ($area as $a) {

			$ad = $a->toArray();


			if($obj->include_tables) {
				$ad['restaurantbranchareatable'] = $a->RestaurantBranchAreaTable->toArray();
			}

			$data[] = $ad;

		}

		$result = array(
				'status' => true,
				'data' => $data
		);

		$this->response->setContent(json_encode($result));

	}

}
