<?php
class MessagesController extends AppController{

	public $uses = array('Message','UsersChat');
	public $helpers = array('Html', 'Form');

	public function index(){
		$queryParams = $this->request->query;
		if (!isset($queryParams['session'])) {
			throw new BadRequestException("The session id isn't passed");
		}
		$sessionInfo = $this->UsersChat->findById($queryParams['session']);
		if (!$sessionInfo) {
			throw new BadRequestException("The session with id ".$queryParams['session']." doesn't exist");
		}

		$conditions = array();
		$conditions['Message.chat_id'] = $sessionInfo['Chat']['id'];

		$oldestMessageId = $this->request->query('oldest_message_id');
		if ( $oldestMessageId ){
			$oldestMessage = $this->Message->findById((int)$oldestMessageId);
			if (!$oldestMessage) {
				throw new BadRequestException("The message with oldest_message_id = ".$oldestMessageId." doesn't exist");
			}
			$conditions['Message.updated_at <'] = $oldestMessage['Message']['updated_at'];
		}
		$newestMessageId = $this->request->query('newest_message_id');
		if ( $newestMessageId ){
			$newestMessage = $this->Message->findById((int)$newestMessageId);
			if (!$newestMessage) {
				throw new BadRequestException("The message with newest_message_id = ".$newestMessageId." doesn't exist");
			}
			$conditions['Message.updated_at >'] = $newestMessage['Message']['updated_at'];
		}

		$pagingSizeString = $this->request->query('paging_size');
		if ( !$pagingSizeString ){
			$pagingSize = 20;
		}else{
			$pagingSize = (int)$pagingSizeString;
		}

		$messageList = $this->Message->find('all', array(
			'conditions' => $conditions,
			'fields' => array('User.id','User.nickname','User.avatar_image',
				'Message.id','Message.text','Message.image_url','Message.updated_at'),
			'order' => array('Message.updated_at desc'),
			'limit' => $pagingSize
		));
		$this->set(array('messages' => $messageList,
			'_serialize' => array('messages')
		));
	}

	public function message(){
		if ($this->request->is('post')){
			$sessionId = $this->request->data['session'];
			$messageData = $this->request->data['message'];
			$session = $this->UsersChat->findById($sessionId);
			$data = array(
				'Message' => array('text' => $messageData['text']),
				'User' => array('id' => $session['User']['id']),
				'Chat' => array('id' => $session['Chat']['id'])
			);
			$this->Message->saveAssociated($data);
			$this->set('_serialize', null);
		}
	}

}