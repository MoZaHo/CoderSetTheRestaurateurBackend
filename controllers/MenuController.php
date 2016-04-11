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

		$obj = json_decode($this->request->getRawBody());
		
		$data = array();
		$units = array();
		
		$menu = \CoderSet\Models\Menu::find('restaurant_id = ' . $obj->restaurant_id);
		
		foreach($menu as $m) {
			
			//Check if the branch was supplied, else show ALL menus
			
			$item = array(
				"menu" => array(),
				"details" => array()
			);
			
			$item['menu'] = $m;
		
			foreach($m->MenuItem as $mi) {
			
				$mitem = array();
				$mitem['details'] = $mi;
				
				foreach ($mi->MenuUnit as $mu) {
					$unit = array();
					$unit['id'] = $mu->id;
					$unit['price'] = $mu->price;
					$unit['name'] = $mu->SaleUnit->name;
					
					$unit['saleunitid'] = $mu->SaleUnit->id;
					if (!in_array($mu->SaleUnit->id, $units)) {
						$units[] = $mu->SaleUnit->id;
					}
					
					$mitem['units'][] = $unit;
				}
				
				$item['details'][] = $mitem;
				
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