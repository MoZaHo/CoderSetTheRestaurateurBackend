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

		$obj = json_decode($this->request->getRawBody('userid'));
		
		$data = array();
		
		$session = \CoderSet\Models\SessionUser::find('session_id = 1');
		
		$data['user'] = array();
		
		$iGrandTotalAmount = 0;
		$iGrandTotalItems = 0;
		
		foreach ($session as $s) {
			
			$user_details = array();
			
			//error_log(json_encode($s));
			
			$user_details['id'] = $s->user_id;
			$user_details['name'] = $s->User->name . ' ' . $s->User->surname;
			$user_details['image'] = $s->User->image;
			
			$iItems = 0;
			$iTotal = 0;
			
			$order = \CoderSet\Models\Orders::find('session_id = 1 AND user_id = ' . $s->user_id .' AND paid = 0');
			foreach ($order as $o) {
				$iItems += $o->amount;
				$iTotal += $o->amount * $o->price;
			}
			
			$iGrandTotalItems += $iItems;
			$iGrandTotalAmount += $iTotal;

			$user_details['items'] = $iItems;
			$user_details['amount'] = $iTotal;
			
			$data['user'][] = $user_details;
			
		}
		
		$data['total'] = $iGrandTotalAmount;
		$data['items'] = $iGrandTotalItems;
		$data['tip'] = $iGrandTotalAmount * 0.10;
		$data['totalPlusTip'] = $data['total'] + $data['tip']; 
		
		$result = array(
				'status' => true,
				'data' => $data
		);
		 
		$this->response->setContent(json_encode($result));
		
	}
	
}