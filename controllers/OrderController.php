<?php

/**********************************************************************************************************************
 * MENU CONTROLLER
 *
 *********************************************************************************************************************/

namespace CoderSet\Controllers;

use Phalcon\Mvc\Controller;

class OrderController extends ControllerBase
{
	
	public function getAction() {

		$obj = json_decode($this->request->getRawBody('userid'));
		
		$data = array();
		
		$session = \CoderSet\Models\Session::findFirst('id = 1');
		
		$query = $this->modelsManager->createBuilder();
    	$query->columns('SUM(o.amount) as AmntSum , o.price, o.menu_unit_id');
    	$query->addFrom('\CoderSet\Models\Orders','o');

    	$query->where('o.session_id = 1 AND o.user_id = ' . $obj->user_id);
    	$query->groupBy('o.menu_unit_id');
		$result = $query->getQuery()->execute();
		
		$data['waitron'] 	= 'Your mom';
		$data['started'] 	= $session->time_start;
		$data['incoice'] 	= 'n/a';
		$data['covers'] 	= '2';
		$data['details'] 	= array();
		$data['totals'] 	= array();
		
		$iItems = 0;
		$iTotal = 0;
		
		foreach($result as $r) {
			
			$item = array();
			$item['price'] = $r->price;
			$item['amount'] = $r->AmntSum;
			
			$mu = \CoderSet\Models\MenuUnit::findFirst('id = ' . $r->menu_unit_id);
			$mu->Menu;
			$mu->SaleUnit;
			
			$item['menuitem'] = $mu;  
			
			$data['details'][] = $item;
			
			$iItems += $r->AmntSum;
			$iTotal += $r->AmntSum * $r->price;

		}
		
		$data['totals']['items'] = $iItems;
		$data['totals']['amount'] = $iTotal;
		
		
		$result = array(
				'status' => true,
				'data' => $data
		);
		 
		$this->response->setContent(json_encode($result));
		
	}
	
	public function addAction() {
		$obj = json_decode($this->request->getRawBody());
		
		$data = array();
		$item = json_decode($obj->item);
		
		foreach ($item->unitcount as $k => $v) {
			
			$menu_unit = \CoderSet\Models\MenuUnit::findFirst($k);
			
			$order = new \CoderSet\Models\Orders();
			$order->session_id = 1;
			$order->menu_unit_id = $k;
			$order->user_id = $obj->user_id;
			$order->amount = $v;
			$order->price = $menu_unit->price;
			
			$order->save();
		}
		
		$result = array(
				'status' => true,
				'data' => $data
		);
			
		$this->response->setContent(json_encode($result));
	}
	
}