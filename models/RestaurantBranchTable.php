<?php

namespace CoderSet\Models;

use Phalcon\Mvc\Model;

class RestaurantBranchTable extends Model
{
		
	public $id;
	public $restaurant_branch_id;


	public function getSource()
	{
		return "restaurant_branch_table";
	}
	
	public function initialize() {
	
		$this->belongsTo(
				'restaurant_branch_id',
				'\CoderSet\Models\RestaurantBranch',
				'id',
				array(
						'alias' => 'RestaurantBranch',
				));
	
	}
			
}