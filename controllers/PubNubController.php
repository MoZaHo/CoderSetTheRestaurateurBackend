<?php

/**********************************************************************************************************************
 * SERVICE CONTROLLER
 *
 * This file is the controller for all actions performed on the service table
 *********************************************************************************************************************/

namespace CoderSet\Controllers;

use Phalcon\Mvc\Controller;
use Pubnub\Pubnub;

class PubNubController extends ControllerBase
{

	public static function SendMessage($channel , $from_user , $to_user_id , $action , $actionid , $message) {
		
		$pubnub = new Pubnub('pub-c-e2cbdb4d-2f09-48e0-a3d2-b4fb18be7552', 'sub-c-f24903dc-e1e8-11e5-b07b-02ee2ddab7fe', 'sec-c-NDc4NWI2MzEtMTQ1Yi00MGMzLWE4ZTUtNWMwNDkwZTFmYWQ4');
		
		/*$pubnub->subscribe('theeasymenu_1.1.1', function ($envelope) {
		 error_log(json_encode($envelope['message']));
		});*/
		
		$pubnubmessage = array(
				'from_user' => $from_user,
				'to_user_id' => $to_user_id,
				'action' => $action,
				'actionid' => $actionid,
				'message' => $message
		);
		
		error_log("Sending..." . $channel . " to " . json_encode($pubnubmessage));
		
		$publish_result = $pubnub->publish($channel,json_encode($pubnubmessage));
	}

	
}
