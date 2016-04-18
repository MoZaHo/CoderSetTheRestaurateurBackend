<?php

namespace CoderSet\Models;

use Phalcon\Mvc\Model;

class MenuItem extends Model
{
		
	public $id;
	public $menu_section_id;
	public $item;
	public $description;
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
				'menu_section_id',
				'\CoderSet\Models\MenuSection',
				'id',
				array(
						'alias' => 'MenuSection',
				));
		
	}
			
}