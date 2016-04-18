<?php

/**********************************************************************************************************************
 * MENU CONTROLLER
 *
 *********************************************************************************************************************/

namespace CoderSet\Controllers;

use Phalcon\Mvc\Controller;

class MenuController extends ControllerBase
{
	
	public function addAction() {
		$obj = json_decode($this->request->getRawBody());
		//$obj = (object) array("name" => "TestMenuAdd" , "restaurant_id" => "1");
		
		$m = $obj->menu;
		
		$data = array();
		
		$menu = new \CoderSet\Models\Menu();
		$menu->restaurant_id = $obj->restaurant_id;
		$menu->name = $m->name;
		$menu->save();
		
		$result = array(
				'status' => true,
				'data'	 => $data
		);
			
		$this->response->setContent(json_encode($result));
	}
	
	public function getAction() {
		$obj = json_decode($this->request->getRawBody());
		//$obj = (object) array("restaurant_id" => "1" , "menu_id" => 0, "include_menuitems" => false , "include_picture" => false);
		
		$data = array();
		
		if ($obj->menu_id <= 0) {
			$fullmenus = \CoderSet\Models\Menu::find('restaurant_id = '  . $obj->restaurant_id);
		} else {
			$fullmenus = \CoderSet\Models\Menu::find('restaurant_id = '  . $obj->restaurant_id . ' AND id = ' . $obj->menu_id);
		}
		
		foreach($fullmenus as $fm) {
			
			$menu = array();
			$menu['name'] = $fm->name;
			$menu['id'] = $fm->id;
			$menu['sections'] = array();
		
			//Lets first get the menu sections for this menu
			$MenuSections = \CoderSet\Models\MenuSection::find('menu_id = ' . $fm->id);
			
			foreach ($MenuSections as $ms) {
				$menus = array();
	
				$menus['id'] = $ms->id;
				$menus['name'] = $ms->name;
				$menus['listorder'] = $ms->listorder;
				$menus['items'] = array();
				
				if ($obj->include_menuitems) {
				
					foreach($ms->MenuItem as $mi) {
						$menuitem = array();
						
						$menuitem['item'] = $mi->item;
						$menuitem['description'] = $mi->description;
						
						if ($obj->include_picture) {
							$menuitem['image'] = $mi->image;
						}
						
						$menuitem['units'] = array();
						
						foreach($mi->MenuUnit as $mu) {
							
							$menuunits = array();
							
							$menuunits['sale_unit_id'] = $mu->SaleUnit->id;
							$menuunits['sale_unit_name'] = $mu->SaleUnit->name;
							$menuunits['sale_unit_price'] = $mu->price;
							
							$menuitem['units'][] = $menuunits;
							
						}
						
						$menus['items'][] = $menuitem;
						
					}
				}

				$menu['sections'][] = $menus;
			
			}
			
			$data[] = $menu;
			
		}
		
		
		$result = array(
				'status' => true,
				'data'	 => $data
		);
			
		$this->response->setContent(json_encode($result));
	}
	
	public function addsectionAction() {
		error_log("FOktog");
		$obj = json_decode($this->request->getRawBody());
		
		$data = array();
		
		$menusection = new \CoderSet\Models\MenuSection();

		$menusection->menu_id = $obj->selectedmenu->id;
		$menusection->name = $obj->menu_section->name;
		$menusection->listorder = 1;
		
		error_log(json_encode($menusection));
		
		$menusection->save();
		
		$result = array(
				'status' => true,
				'data'	 => $data
		);
			
		$this->response->setContent(json_encode($result));
	}
	
	public function editsectionAction() {
		
	}
	
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