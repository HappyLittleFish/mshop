<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends Controller {
	public $goodsModel;
	public function __construct(){
		parent::__construct();
		$this->goodsModel = D('Goods');
	}


    public function index(){
       echo "welcome to china";
	}
	public function goodsadd(){
		if(IS_POST){
		if(!$this->goodsModel->create($_POST)){
			echo $this->goodsModel->getError();
			exit();
		}
		echo $this->goodsModel->add()?'1':'0';	
		}
        $this->display();
	}
	public function goodslist(){
		$this->display();
	}
}