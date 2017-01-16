<?php 
namespace Admin\Model;
use Think\Model;
class GoodsModel extends Model {
	public $insertFields = 'goods_name,goods_sn,shop_price';

	 public $_validate = array(
	 	//array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]),
	 	array('goods_sn','3,8','货号错了','1','length','3'),
	 	);

	 public $_auto = array(
	 	//array(完成字段1,完成规则,[完成条件,附加规则]),
	 	array('add_time','time','3','function'),
	 	);

}

