<?php

class Post_Comment extends Controller {

	public function __construct() {
		parent::__construct();	
	}
	
	public function post_comment() {	
		$this->view->render('post_comment/index');
	}	

}