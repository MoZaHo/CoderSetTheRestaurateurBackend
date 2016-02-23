<?php

/**********************************************************************************************************************
 * SERVICE CONTROLLER
 *
 * This file is the controller for all actions performed on the service table
 *********************************************************************************************************************/

namespace CoderSet\Controllers;

use Phalcon\Mvc\Controller;

class SessionController extends ControllerBase
{
	
public function listAction() {

		$obj = json_decode($this->request->getRawBody('userid'));
		
		$data = array();
		$data['rows'] = 0;
		
		$result = array(
				'status' => true,
				'data' => $data
		);
			
		$this->response->setContent(json_encode($result));
		
	}
	
	public function checkinAction() {
	
		$obj = json_decode($this->request->getRawBody());
		
		$data = array();
		$data['rows'] = 0;
		
		if ($obj->restaurant <= 0 || $obj->branch <= 0 || $obj->table <= 0) {
			
			$result = array(
					'status' => true,
					'data' => $data
			);
				
			$this->response->setContent(json_encode($result));
			
			return;
		}
		
		//Lets first get the Session
		$query = $this->modelsManager->createBuilder();
		$query->addFrom('\CoderSet\Models\Session','s');
		$query->leftJoin('\CoderSet\Models\SessionUser','s.id = su.session_id','su');
		$query->columns('s.id,su.is_parent');
		
		$query->where('s.restaurant_id = '.$obj->restaurant.' AND s.restaurant_branch_id = '.$obj->branch.' AND s.restaurant_branch_table_id = '.$obj->table.' AND s.status = 1');
		$result = $query->getQuery()->execute();
		
		if (count($result) == 0) {
			//We'll need to create the session now
			$session = new \CoderSet\Models\Session();
			$session->restaurant_id = 1;
			$session->restaurant_branch_id = 1;
			$session->restaurant_branch_table_id = 1;
			$session->status = 1;
			$session->time_start = date("Y-m-d H:i:s");
			$session->time_end = '0000-00-00 00:00:00';
			$session->save();
			
			$data['session_id'] = $session->id;
		} else {
			foreach ($result as $r) {
				$data['session_id'] = $r->id;
			}
			
		}
		
		//Now lets see if anyone already has this session
		//We'll find everyone incase we need to request to join table
		$su = \CoderSet\Models\SessionUser::find('session_id = ' . $data['session_id']);
		$iAmInTheList = false;
		$iPeopleAtTheTable = 0;
		$my_session_user = null;
		foreach ($su as $s) {
			$iPeopleAtTheTable++;
			if ($s->user_id == $obj->user_id) {
				$iAmInTheList = true;
				$my_session_user = $s;
			}
		}
		
		if (!$iAmInTheList) {
			//I'm joining this table now, so request permission to join
			$su = new \CoderSet\Models\SessionUser();
			$su->session_id = $data['session_id'];
			$su->user_id = $obj->user_id;
			if ($iPeopleAtTheTable > 0) {
				$su->is_parent = 0;
				$su->status = 0;
				$my_session_status = 0;
			} else {
				$su->is_parent = 1;
				$su->status = 1;
				$my_session_status = 1;
			}
			$su->save();
			
		} else {
			//I'm part of the list, so lets get the status and check if i've been accepted already, else send another request to join
			//TODO
			$my_session_status = $my_session_user->status;
			if ($my_session_user->status == 0) {
				error_log("Fucked man - ACCEPT ME BITCHES!!!");
			}
		}
		
		$data['my_session_status'] = $my_session_status;
		
		$result = array(
				'status' => true,
				'data' => $data
		);
			
		$this->response->setContent(json_encode($result));
	
	}
	
	public function userupdateAction() {
		$obj = json_decode($this->request->getRawBody());
		
		$data = array();
		$data['rows'] = 0;
		
		//Lets first get the Session
		$query = $this->modelsManager->createBuilder();
		$query->addFrom('\CoderSet\Models\Session','s');
		$query->leftJoin('\CoderSet\Models\SessionUser','s.id = su.session_id','su');
		$query->columns('s.id,su.is_parent');
		
		$query->where('s.restaurant_id = '.$obj->restaurant.' AND s.restaurant_branch_id = '.$obj->branch.' AND s.restaurant_branch_table_id = '.$obj->table.' AND s.status = 1');
		$result = $query->getQuery()->execute();
		
		if (count($result) == 0) {
			//We'll need to create the session now
			$session = new \CoderSet\Models\Session();
			$session->restaurant_id = 1;
			$session->restaurant_branch_id = 1;
			$session->restaurant_branch_table_id = 1;
			$session->status = 1;
			$session->time_start = date("Y-m-d H:i:s");
			$session->time_end = '0000-00-00 00:00:00';
			$session->save();
			
			$data['session_id'] = $session->id;
		} else {
			foreach ($result as $r) {
				$data['session_id'] = $r->id;
			}
			
		}
		
		//Now lets see if anyone already has this session
		//We'll find everyone incase we need to request to join table
		$su = \CoderSet\Models\SessionUser::findFirst('session_id = ' . $data['session_id'] . ' AND user_id = 1 AND status = 0' );
		$su->status = 1;
		$su->save();
		
		$result = array(
				'status' => true,
				'data' => $data
		);
			
		$this->response->setContent(json_encode($result));
	
		
	}
	
}