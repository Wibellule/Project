<?php

class Postscomment extends Model{
	var $validate = array(
		'name' => array(
			'rule'		=> 'notEmpty',
			'message'	=> "Le nom est incorrect"
		),
		'email' => array(
			'rule' 		=> '[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9][-a-z0-9]*\.)*(?:[a-z0-9][-a-z0-9]{0,62})\.(?:(?:[a-z]{2}\.)?[a-z]{2,4}|museum|travel)',
			'message' 	=> "Merci d'indiquer un mail valide"
		),
		'url' => array(
			'rule'		=> 'notEmpty',
			'message'	=> "Le nom est incorrect"
		),
		'message' => array(
			// 'rule'		=> '([a-z0-9\-]+)',
			'rule'		=> 'notEmpty',
			'message'	=> "Message incorrect"
		)
	);
}