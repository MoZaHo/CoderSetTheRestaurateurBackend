<?php

use Phalcon\Mvc\Model;

class RestaurantBranchTable extends Model
{
		
	public $id;
	public $restaurant_branch_id;


	public function getSource()
	{
		return "restaurant_branch_table";
	}
			
}