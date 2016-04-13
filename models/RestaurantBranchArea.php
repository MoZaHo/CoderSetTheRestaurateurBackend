<?php

namespace CoderSet\Models;

use Phalcon\Mvc\Model;

class RestaurantBranchArea extends Model
{
		
	public $id;
	public $restaurant_branch_id;
	public $name;
	public $status;
	
	public function getSource()
	{
		return "restaurant_branch_area";
	}
	
	public function initialize() {
	
		$this->belongsTo(
				'restaurant_branch_id',
				'\CoderSet\Models\RestaurantBranch',
				'id',
				array(
						'alias' => 'RestaurantBranch',
				));
		
		$this->hasMany('id',
				'\CoderSet\Models\RestaurantBranchAreaTable',
				'restaurant_branch_area_id',
				array(
						'alias' => 'RestaurantBranchAreaTable'
				));
	
	}
			
}