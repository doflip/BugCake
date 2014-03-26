<?php
class Issue extends BugCakeAppModel {
    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty',
            'message' => 'Title should not be empty.'
        ),
        'body' => array(
            'rule' => 'notEmpty',
            'message' => 'Please provide more details into the body of your issue.'
        ),
        'tags' => array(
        	'rule' => '/(\w+\,\s){0,}/',
        	'message' => 'Tags should be separated with commas and a blank space.'
        )
    );
}
?>