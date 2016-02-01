<?php
class Message extends AppModel {
	public $useTable = 'messages';
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		),
		'Chat' => array(
			'ClassName' => 'Chat',
			'foreignKey' => 'chat_id'
		)
	);
}