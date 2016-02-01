<?php
class SignupController extends AppController {

	public $uses = array('UsersChat','Chat','User');
	public $helpers = array('Html', 'Form');
	public $components = array('RequestHandler');

	public function index(){
		debug($this->UsersChat);
	}

	public function add(){
		$data = array(
			'User' => array('nickname' => 'generatedUser'),
			'Chat' => array('title' => 'Generated chat')
		);
		$this->UsersChat->saveAssociated($data);
		$sessionId = $this->UsersChat->id;
		$this->set(array('sessionId' => $sessionId,
			'_serialize' => array('sessionId')
		));
	}
}