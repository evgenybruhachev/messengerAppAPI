<?php
class SignupController extends AppController {

	public $uses = array('UsersChat','Chat','User');
	public $helpers = array('Html', 'Form');
	public $components = array('RequestHandler');

	public function index(){
		debug($this->UsersChat);
	}

	public function add(){
		/*
		$data = array('nickname' => 'generatedUser');
		$this->User->create();
		$user = $this->User->save($data);

		$data = array();
		$this->Chat->create();
		$chat = $this->Chat->save($data);

		$data = array('user_id' => $this->User->id,
			'chat_id' => $this->Chat->id);
		$this->UsersChat->create();
		$userschat = $this->UsersChat->save($data);

		$sessionId = $this->UsersChat->id;
		$this->set(array('sessionId' => $sessionId,
			'_serialize' => array('sessionId')
		));
		*/
		
		$data = array(
			'User' => array('nickname' => 'generatedUser'),
			'Chat' => array('title' => 'Generated chat')
		);
		$this->UsersChat->saveAssociated($data);
		$sessionId = $this->UsersChat->id;
		$this->set(array('sessionId' => $sessionId,
			'_serialize' => array('sessionId')
		));
		
		/*
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
		*/
	}
}