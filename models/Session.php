<?php

namespace CoderSet\Models;

use Phalcon\Mvc\Model;

class Session extends Model
{
		
	public $id;
	public $restaurant_id;
	public $restaurant_branch_id;
	public $restaurant_branch_table_id;
	public $status;
	public $time_start;
	public $time_end;


	public function getSource()
	{
		return "session";
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