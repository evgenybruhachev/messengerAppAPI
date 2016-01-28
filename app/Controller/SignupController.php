<?php
class SignupController extends AppController {

	public $uses = ['Signup','User','SessionInstance'];
	public $helpers = array('Html', 'Form');
	public $components = array('RequestHandler');

	public function index(){
	}

	public function add(){
		/*
		$data = array(
			'User' => array('nickname' => "generatedUser"),
			'Session' => array()
		);
		$this->Signup->create();
		$this->Signup->saveAssociated($data, array('deep' => true));
		$sessionId = $this->Signup->id;
		$this->set(array('sessionId' => $sessionId,
			'_serialize' => array('sessionId')
		));
		*/
		$data = array('nickname' => 'generatedUser');
		$this->User->create();
		$user = $this->User->save($data);

		$this->SessionInstance->create();
		$session = $this->SessionInstance->save();

		$data = array('users_id' => $this->User->id,
			'session_instances_id' => $this->SessionInstance->id);
		$this->Signup->create();
		$signup = $this->Signup->save($data);

		$this->set(array('signup' => $signup,
			'_serialize' => array('signup')
		));
	}
}