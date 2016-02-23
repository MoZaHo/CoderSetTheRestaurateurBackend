<?php

namespace CoderSet\Models;

use Phalcon\Mvc\Model;

class User extends Model
{
		
	public $id;
	public $name;
	public $surname;
	public $email;
	public $mobile;
	public $status;


	public function getSource()
	{
		return "user";
	}
			
}