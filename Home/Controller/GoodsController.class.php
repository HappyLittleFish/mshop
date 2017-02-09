<?php
namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller {
    public function goods(){
    	$goodsinfo = D('Admin/goods')->find(I('goods_id'));
    	$this->assign('mbx',$this->mbx($goodsinfo['cat_id']));
    	$this->assign('goodsinfo',$goodsinfo);

    	//写入历史记录

    	$this->history($goodsinfo);

        $this->display();
    }

    public function history($g){
    	$history = session('history');
    	if (empty($history)){
    		$history = array();
    	}

    	if(isset($history[$g['goods_id']])){
    	   unset($history[$g['goods_id']]);
    	}

    	$row = array();
    	$row['thumb_img'] = $g['thumb_img'];
    	$row['thumb_name'] = $g['thumb_name'];
    	$row['thumb_price'] = $g['thumb_price'];


    	$history[$g['goods_id']] = $row;
    	if(count($history)>6){
    		$key = key($history);
    		unset($history[$key]);
    		
    	}
    	
    	session('history',array_reverse($history,true));



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