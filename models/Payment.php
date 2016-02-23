<?php

use Phalcon\Mvc\Model;

class Payment extends Model
{
		
	public $id;
	public $session_id;
	public $order_id;
	public $user_id;
	public $payment_method;
	public $payment_amount;
	public $gratitude_perc;
	public $gratitude_amount;
	public $on_behalf_of_user_id;


	public function getSource()
	{
		return "payment";
	}
			
}