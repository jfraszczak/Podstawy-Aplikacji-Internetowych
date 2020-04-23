<?php
App::uses('AppModel', 'Model');
/**
 * Employee Model
 *
 */
class Employee extends AppModel {
 	var $name = 'Employee';
        var $validate = array('nazwisko' => array('rule' => 'notBlank'),
			      'etat' => array('rule' => 'notBlank'),
			       'placa_pod' => array('rule' => 'inRange',
						    'message' => 'Placa musi sie zawierac pomiedzy 0 a 2000zl'));

	public function inRange($check) {

        	$value = array_values($check);
        	$value = $value[0];
		return ($value >= 0 and $value <= 2000);
	}
}
