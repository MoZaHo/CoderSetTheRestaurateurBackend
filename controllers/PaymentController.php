<?php

/**********************************************************************************************************************
 * SERVICE CONTROLLER
 *
 * This file is the controller for all actions performed on the service table
 *********************************************************************************************************************/

namespace CoderSet\Controllers;

use Phalcon\Mvc\Controller;

class PaymentController extends ControllerBase
{
	
	public function payAction() {

		$obj = json_decode($this->request->getRawBody());
		
		$userid = json_decode($obj->userid);
		$details = json_decode($obj->details);
		$session = json_decode($obj->sessionid);
		
		error_log("USER : " . $userid);
		error_log("DETAILS : " . json_encode($details));
		error_log("DETAILS : " . $session);
		
		//
		
		foreach ($details as $d) {
			
			if ($d->amount > 0) {
			
				$payment = new \CoderSet\Models\Payment();
				
				$payment->session_id = $session;
				$payment->user_id = $d->id;
				$payment->payment_method = 0;
				$payment->payment_amount = $d->amount;
				$payment->gratitude_perc = 0;
				$payment->gratitude_amount = 0;
				
				if ($d->id == $userid) {
					$payment->on_behalf_of_user_id = 0;
				} else {
					$payment->on_behalf_of_user_id = $userid;
				}
				
				//if ($payment->save()) {
				if (true) {
					if ($payment->on_behalf_of_user_id > 0) {
						$uid  = $d->id;
						
						$fromuser = \CoderSet\Models\User::findFirst('id = ' . $userid);
						$fromuser->image = "";

						error_log("Sending payment message to : theeasymenu_1.1.1." . $d->id);
						\CoderSet\Controllers\PubNubController::SendMessage('theeasymenu_1.1.1.' . $d->id , json_encode($fromuser), $d->id, 'order', 1, '');
					} else {
						$uid = $userid;
					}

					$order = \CoderSet\Models\Orders::find('session_id = ' . $session . ' AND user_id = ' . $uid . ' AND paid = 0');
					
					foreach($order as $o) {
						$o->paid = 1;
						$o->save();
					}
					
				}
				
			}
		
		}
		
		$data = array();
		$data['rows'] = 0;
		
		$result = array(
				'status' => true,
				'data' => $data
		);
		 
		$this->response->setContent(json_encode($result));
		
	}
	
}