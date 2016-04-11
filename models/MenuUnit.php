<?php

namespace CoderSet\Models;

use Phalcon\Mvc\Model;

class MenuUnit extends Model
{
		
	public $id;
	public $menu_item_id;
	public $sale_unit;
	public $price;


	public function getSource()
	{
		return "menu_unit";
	}
	
	public function initialize() {
	
		$this->belongsTo(
				'menu_item_id',
				'\CoderSet\Models\MenuItem',
				'id',
				array(
						'alias' => 'MenuItem',
				));
		
		$this->belongsTo(
				'sale_unit',
				'\CoderSet\Models\SaleUnit',
				'id',
				array(
						'alias' => 'SaleUnit',
				));
		
	}
			
}