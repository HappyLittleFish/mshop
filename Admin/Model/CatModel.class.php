<?php 
namespace Admin\Model;
use Think\Model;
class CatModel extends Model {
	public function gettree(){
		return $this->select();
	}
	 
}

 ?>