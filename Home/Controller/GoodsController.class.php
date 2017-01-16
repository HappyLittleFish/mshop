<?php
namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller {
    public function goods(){
    	$goodsinfo = D('Admin/goods')->find(I('goods_id'));
    	$this->assign('mbx',$this->mbx($goodsinfo['cat_id']));
    	$this->assign('goodsinfo',$goodsinfo);
        $this->display();
    }
    public function mbx($cat_id){
    	$catModel = D('Admin/cat');
    	$arr = array();
    	while($cat_id>0){
    		foreach ($catModel->select() as $k => $v) {
    			if ($cat_id == $v[cat_id]) {
    				$arr[] = $v;
    				$cat_id = $v['parent_id'];
    				break;
    			}
    		}
    	}
    	return array_reverse($arr);
    }

}