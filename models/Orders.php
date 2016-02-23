<?php

namespace CoderSet\Models;

use Phalcon\Mvc\Model;

class Orders extends Model
{
		
	public $id;
	public $session_id;
	public $menu_unit_id;
	public $user_id;
	public $amount;
	public $price;


	public function getSource()
	{
		return "orders";
	}
			
	public function initialize() {
	
		/*$this->hasMany(
				'id',
				'\CoderSet\Models\OpsSupplierReview',
				'supplier_id',
				array(
						'alias' => 'Reviews',
				));*/
		
		$this->belongsTo(
				'session_id',
				'\CoderSet\Models\Session',
				'id',
				array(
						'alias' => 'Session',
				));
		
		$this->belongsTo(
				'menu_unit_id',
				'\CoderSet\Models\MenuUnit',
				'id',
				array(
						'alias' => 'MenuUnit',
				));
	
		$this->belongsTo(
				'user_id',
				'\CoderSet\Models\User',
				'id',
				array(
						'alias' => 'User',
				));
		
	}
	
	
}