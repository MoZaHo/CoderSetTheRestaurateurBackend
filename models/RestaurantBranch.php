<?php

use Phalcon\Mvc\Model;

class RestaurantBranch extends Model
{
		
	public $id;
	public $restaurant_id;
	public $name;
	public $description;
	public $location-x;
	public $location-y;


	public function getSource()
	{
		return "restaurant_branch";
	}
			
}