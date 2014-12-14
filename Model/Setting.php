<?php

class Setting extends BugCakeAppModel {
	public $validate = array(
		'name' => array(
		    'rule' => 'notEmpty'
		),
		'value' => array(
		    'rule' => 'notEmpty'
		)
	    );
}
 
?>