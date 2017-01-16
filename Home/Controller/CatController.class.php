<?php
namespace Home\Controller;
use Think\Controller;
class CatController extends Controller {
    public function cat(){
      $goodsModel = D('Admin/goods');

      $count = $goodsModel->field('goods_id,goods_name,shop_price,goods_img,market_price')->where('cat_id='.I('cat_id'))->count();
            $Page = new \Think\Page($count,4);
      $show = $Page->show();// 分页显示输出
      $goodsList = $goodsModel->field('goods_id,goods_name,shop_price,goods_img,market_price')->where('cat_id='.I('cat_id'))->limit($Page->firstRow.','.$Page->listRows)->select();
      $this->assign('count',$count);
      $this->assign('page',$show);// 赋值分页输出
      $this->assign('goodsList',$goodsList);
      $this->display();

    }
}