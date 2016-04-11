<?php

namespace CoderSet\Models;

use Phalcon\Mvc\Model;

class LinkMenuRestaurantBranch extends Model
{
		
	public $id;
	public $menu_id;
	public $restaurant_branch_id;
	
	
	public function getSource()
	{
		return "menu";
	}
	
	public function initialize() {
	
		$this->belongsTo(
				'restaurant_branch_id',
				'\CoderSet\Models\RestaurantBranch',
				'id',
				array(
						'alias' => 'Restaurant',
				));
	
		$this->belongsTo(
				'menu_id',
				'\CoderSet\Models\Menu',
				'id',
				array(
						'alias' => 'Menu',
				));
	
	}
			
}