<?php

class SessionController extends AppController{

	public $uses = array('UsersChat');
	public $helpers = array('Html', 'Form');
	public $components = array('RequestHandler');

	public function index(){

	}

	public function add(){
		$sessionId = $this->request->data['session'];
		$data = $this->UsersChat->findById($sessionId);
		$userdata = $data['User'];
		$this->set(array('User' => $userdata,
			'_serialize' => array('User')
		));
	}

}