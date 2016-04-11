<?php

namespace CoderSet\Models;

use Phalcon\Mvc\Model;

class Staff extends Model
{
		
	public $id;
	public $name;
	public $surname;
	public $id_number;
	public $email;
	public $telephone;
	public $status;
	public $restaurant_id;


	public function getSource()
	{
		return "staff";
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