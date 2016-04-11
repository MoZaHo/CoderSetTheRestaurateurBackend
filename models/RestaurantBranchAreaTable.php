<?php

namespace CoderSet\Models;

use Phalcon\Mvc\Model;

class RestaurantBranchAreaTable extends Model
{
		
	public $id;
	public $restaurant_branch_area_id;
	public $hash;
	public $display_name;


	public function getSource()
	{
		return "restaurant_branch_area_table";
	}
	
	public function initialize() {
	
		$this->belongsTo(
				'restaurant_branch_area_id',
				'\CoderSet\Models\RestaurantBranchArea',
				'id',
				array(
						'alias' => 'RestaurantBranchArea',
				));
	
	}
			
}