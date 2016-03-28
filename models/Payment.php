<?php

namespace CoderSet\Models;

use Phalcon\Mvc\Model;

class Payment extends Model
{
		
	public $id;
	public $session_id;
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
	
	public function initialize() {
	
		$this->belongsTo(
				'session_id',
				'\CoderSet\Models\Session',
				'id',
				array(
						'alias' => 'Session',
				));
		
		$this->belongsTo(
				'user_id',
				'\CoderSet\Models\User',
				'id',
				array(
						'alias' => 'User',
				));
		
		$this->belongsTo(
				'on_behalf_of_user_id',
				'\CoderSet\Models\User',
				'id',
				array(
						'alias' => 'OnBehalfOf',
				));
	
	}
			
}