<?php

namespace CoderSet\Models;

use Phalcon\Mvc\Model;

class MenuUnit extends Model
{
		
	public $id;
	public $menu_id;
	public $sale_unit;
	public $price;


	public function getSource()
	{
		return "menu_unit";
	}
	
	public function initialize() {
	
		$this->belongsTo(
				'menu_id',
				'\CoderSet\Models\Menu',
				'id',
				array(
						'alias' => 'Menu',
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