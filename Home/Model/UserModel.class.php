<?php 
namespace Home\Model;
use Think\Model;
class UserModel extends Model {
	public $_validate = array(
		array('username','3,9','名字错了','1','length','3'),
		array('email','email','邮箱格式错了','1','','3'),
		array('password','3,18','密码短了','1','length','3'),
		array('repwd','password','两次密码不一样','1','confirm','3'),
		array('username','','用户名已经存在','1','unique','3'),
		);

}

 ?>