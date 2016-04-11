<?php

namespace CoderSet\Models;

use Phalcon\Mvc\Model;

class LinkRestaurantBranchStaff extends Model
{
		
	public $id;
	public $restaurant_branch_id;
	public $staff_id;
	
	
	public function getSource()
	{
		return "link_restaurant_branch_staff";
	}
	
	public function initialize() {
	
		$this->belongsTo(
				'restaurant_branch_id',
				'\CoderSet\Models\RestaurantBranch',
				'id',
				array(
						'alias' => 'RestaurantBranch',
				));
	
		$this->belongsTo(
				'staff_id',
				'\CoderSet\Models\Staff',
				'id',
				array(
						'alias' => 'Staff',
				));
	
	}
			
}