<?php
class UsersChat extends AppModel {
	public $useTable = 'users_chats';
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		),
		'Chat' => array(
			'className' => 'Chat',
			'foreignKey' => 'chat_id'
		)
	);
}