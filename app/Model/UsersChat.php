<?php
class UsersChat extends AppModel {
	public $useTable = 'users_chats';
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'fields' => array('id')
		),
		'Chat' => array(
			'className' => 'Chat',
			'foreignKey' => 'chat_id',
			'fields' => array('id')
		)
	);

	public function afterFind($results, $primary = false){
		foreach ($results as $key => $value) {
			if (isset($value['User']['id'])) {
				$results[$key]['User']['id'] = (int)$value['User']['id'];
			}
			if (isset($value['Chat']['id'])) {
				$results[$key]['Chat']['id'] = (int)$value['Chat']['id'];
			}
		}
		return $results;
	}
}