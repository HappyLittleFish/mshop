<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function login(){
      $this->display();
    }
    public function msg(){
      $this->display();
    }

    public function reg(){
    	if (IS_POST) {
	    	$userModel = D('User');
	    	if (!$userModel->create()) {
	    		echo $userModel->getError();
	    	}else{
	    		$userModel->add();
	    	}
    	}
   	      	$this->display();
    }        
}