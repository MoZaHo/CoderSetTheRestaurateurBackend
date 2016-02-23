<?php

namespace CoderSet\Models;

use Phalcon\Mvc\Model;

class Menu extends Model
{
		
	public $id;
	public $restaurant_branch_id;
	public $item;


	public function getSource()
	{
		return "menu";
	}
	
	public function initialize() {
	
		$this->hasMany(
			 'id',
			 '\CoderSet\Models\MenuUnit',
			 'menu_id',
				 array(
				 'alias' => 'MenuUnit',
				 ));
		
	}
			
}