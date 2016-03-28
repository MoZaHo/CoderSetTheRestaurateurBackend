<?php

/**********************************************************************************************************************
 * MENU CONTROLLER
 *
 *********************************************************************************************************************/

namespace CoderSet\Controllers;

use Phalcon\Mvc\Controller;

class MenuController extends ControllerBase
{
	
	public function listAction() {

		$obj = json_decode($this->request->getRawBody('userid'));
		//$obj = json_decode(json_encode(array('restaurant_branch_id' => '1')));
		
		$data = array();
		$units = array();
		$menu = \CoderSet\Models\Menu::find('restaurant_branch_id = ' . $obj->restaurant_branch_id);
		
		foreach($menu as $m) {
			
			$item = array();
			$item['details'] = $m;
			
			foreach ($m->MenuUnit as $mu) {
				$unit = array();
				$unit['id'] = $mu->id;
				$unit['price'] = $mu->price;
				$unit['name'] = $mu->SaleUnit->name;
				
				$unit['saleunitid'] = $mu->SaleUnit->id;
				if (!in_array($mu->SaleUnit->id, $units)) {
					$units[] = $mu->SaleUnit->id;
				}
				
				$item['units'][] = $unit;
			}
			
			$data[] = $item;
		}
		
		$result = array(
				'status' => true,
				'data'	 => $data,
				'units'  => $units
		);
		 
		$this->response->setContent(json_encode($result));
		
	}
	
}