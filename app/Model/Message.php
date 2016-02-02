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

	public function afterFind($results, $primary = false){
		foreach ($results as $key => $value) {
			if (isset($value['User']['id'])) {
				$results[$key]['User']['id'] = (int)$value['User']['id'];
			}
			if (isset($value['Chat']['id'])) {
				$results[$key]['Chat']['id'] = (int)$value['Chat']['id'];
			}
			if (isset($value['Message']['id'])) {
				$results[$key]['Message']['id'] = (int)$value['Message']['id'];
			}
		}
		return $results;
	}

	public function beforeSave($options = array()) {
		$this->data['Message']['updated_at'] = date('Y-m-d H:i:s');
		return true;
	}
}