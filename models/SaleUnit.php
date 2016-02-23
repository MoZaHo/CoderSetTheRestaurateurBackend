<?php

namespace CoderSet\Models;

use Phalcon\Mvc\Model;

class SaleUnit extends Model
{
		
	public $id;
	public $name;


	public function getSource()
	{
		return "sale_unit";
	}
			
}