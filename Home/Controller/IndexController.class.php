<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$catModel = D('Admin/Cat');
    	$this->assign('cattree',$catModel->gettree());

    	$goodsModel = D('Admin/Goods');
    	$hot = $goodsModel->field('goods_id,goods_name,shop_price,goods_img,market_price')->where('is_hot = 1')->order('goods_id desc')->limit('0,4')->select();
    	$this->assign('hot',$hot);
    	



        $this->display();
    }
}