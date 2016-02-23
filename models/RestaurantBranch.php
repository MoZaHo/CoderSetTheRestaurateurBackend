<?php

namespace CoderSet\Models;

use Phalcon\Mvc\Model;

class RestaurantBranch extends Model
{
		
	public $id;
	public $restaurant_id;
	public $name;
	public $description;
	public $locationx;
	public $locationy;


	public function getSource()
	{
		return "restaurant_branch";
	}
	
	public function initialize() {
	
		$this->belongsTo(
				'restaurant_id',
				'\CoderSet\Models\Restaurant',
				'id',
				array(
						'alias' => 'Restaurant',
				));
		
	}
			
}