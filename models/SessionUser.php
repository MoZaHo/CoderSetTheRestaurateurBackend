<?php

namespace CoderSet\Models;

use Phalcon\Mvc\Model;

class SessionUser extends Model
{
		
	public $id;
	public $session_id;
	public $user_id;
	public $is_parent;
	public $status;


	public function getSource()
	{
		return "session_user";
	}
	
	public function initialize() {
	
		/*$this->hasMany(
		 'id',
		 '\CoderSet\Models\OpsSupplierReview',
		 'supplier_id',
		 array(
		 'alias' => 'Reviews',
		 ));*/
	
		$this->belongsTo(
				'user_id',
				'\CoderSet\Models\User',
				'id',
				array(
						'alias' => 'User',
				));
	
	}
			
}