<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function login(){
    	if(IS_POST){

    		$username = I('post.username');
    		$password = I('post.password');

    		$Verify = new \Think\Verify();
    		$code = I('post.yzm');
    		if(!$Verify->check($code)){
    			$this->error('验证码错误','',1);
    		}

    		$userModel = D('user');
    		$userinfo = $userModel->where(array('username'=>$username))->find();
    		if(!$userinfo){
    			$this->error('用户名错误','',1);
    		}
    		if($userinfo['password']!==md5($password.$userinfo['salt'])){
    			$this->error('密码错误','',1);
    		}else{
    			cookie('userid',$userinfo['password']);
    			cookie('username',$userinfo['username']);

    			$coo_kie = jm($userinfo['username'].$userinfo['password'].C('COO_KIE'));
    			cookie('key',$coo_kie);
    			$this->success('你好,欢迎登录','/shop',1);
    		}

    	}

    	
      	$this->display();
    }
    public function yzm(){
    	$Verify = new \Think\Verify();
    	$Verify->fontSize = 30;
		$Verify->length = 3;
		$Verify->useNoise = false;
		$Verify->entry();


    }

    public function logout(){
    	cookie('username',null);
    	cookie('userid',null);
    	cookie('key',null);
    	
    	$this->success('','/shop',0);





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
	    		$salt = $this->salt();
	    		$userModel->password = md5($userModel->password.$salt);
	    		$userModel->salt = $salt;
	    		$userModel->add();
	    	}
    	}
   	      	$this->display();
    } 

    public function salt(){
    	$str = "sdseiwr#$%^&(*!@#sdfg34adert";
    	return substr(str_shuffle($str),0,8);
    }       
}