<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends Controller {
    public function index(){
       echo "welcome to china";
	}
	public function goodsadd(){
        $this->display();
	}
	public function goodslist(){
		$this->display();
	}
}