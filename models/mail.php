<?php
class Mail extends Model{

	var $validate = array(
		'mail' => array(
			'rule' 		=> '[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9][-a-z0-9]*\.)*(?:[a-z0-9][-a-z0-9]{0,62})\.(?:(?:[a-z]{2}\.)?[a-z]{2,4}|museum|travel)',
			'message' 	=> "Merci d'indiquer un mail valide"
		),
		'bac' => array(
			'rule'		=> '([a-z0-9\-]+)',
			// 'rule'		=> '^[0-9]{9}$',
			'message'	=> "Le numéro du bac est incorrect"
		)
	);
}