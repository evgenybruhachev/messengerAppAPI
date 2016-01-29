<?php
class UsersChat extends AppModel {
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