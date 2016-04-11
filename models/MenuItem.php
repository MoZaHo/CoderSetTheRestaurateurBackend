<?php

namespace CoderSet\Models;

use Phalcon\Mvc\Model;

class MenuItem extends Model
{
		
	public $id;
	public $menu_id;
	public $item;
	public $image;


	public function getSource()
	{
		return "menu_item";
	}
	
	public function initialize() {
	
		$this->hasMany(
			 'id',
			 '\CoderSet\Models\MenuUnit',
			 'menu_item_id',
				 array(
				 'alias' => 'MenuUnit',
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