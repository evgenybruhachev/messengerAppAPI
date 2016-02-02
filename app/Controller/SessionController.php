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
		if (!$data) {
			throw new BadRequestException("The session with id ".$sessionId." doesn't exist");
			
		}
		$userdata = $data['User'];
		$this->set(array('User' => $userdata,
			'_serialize' => array('User')
		));
	}

}