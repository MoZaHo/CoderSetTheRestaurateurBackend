<?php

use Phalcon\Mvc\Model;

class Restaurant extends Model
{
		
	public $id;
	public $name;
	public $description;


	public function getSource()
	{
		return "restaurant";
	}
			
}