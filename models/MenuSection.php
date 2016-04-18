<?php

namespace CoderSet\Models;

use Phalcon\Mvc\Model;

class MenuSection extends Model
{
		
	public $id;
	public $menu_id;
	public $name;
	public $listorder;


	public function getSource()
	{
		return "menu_section";
	}
	
	public function initialize() {
	
		$this->belongsTo(
				'menu_id',
				'\CoderSet\Models\Menu',
				'id',
				array(
						'alias' => 'Menu',
				));
		
		$this->hasMany(
				'id',
				'\CoderSet\Models\MenuItem',
				'menu_section_id',
				array(
						'alias' => 'MenuItem',
				));
		
	}
			
}