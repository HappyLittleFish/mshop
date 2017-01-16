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

		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize = 3145728 ;// 设置附件上传大小
		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath = './Uploads/'; // 设置附件上传根目录
		$upload->savePath = ''; // 设置附件上传（子）目录
		// 上传文件
		$info = $upload->upload();
		if(!$info) {// 上传错误提示错误信息
		$this->error($upload->getError());
		}else{// 上传成功
		$img_path1 = './Uploads/'.$info['goods_img']['savepath'];
		$img_path2 = $info['goods_img']['savename'];
		

		$image = new \Think\Image();
		$image->open($img_path1.$img_path2);
		// 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
		$img_xiao = "./Uploads/thumb/".$img_path2;
		$image->thumb(150, 150)->save($img_xiao);
		$this->goodsModel->thumb_img = $img_xiao;
		$this->goodsModel->goods_img = $img_path1.$img_path2;

		}
		

		echo $this->goodsModel->add()?'1':'0';	
		}
        $this->display();
	}
	public function goodslist(){
		// $goodslist = $this->goodsModel->select();

		$p = I('p')?I('p'):1;
		// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
		$list = $this->goodsModel->order('goods_id')->page($p.',4')->select();
		$this->assign('goodslist',$list);// 赋值数据集
		$count = $this->goodsModel->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,4);// 实例化分页类 传入总记录数和每页显示的记录数
		$show = $Page->show();// 分页显示输出
		var_dump($show);
		$this->assign('page',$show);// 赋值分页输出
		$this->display(); // 输出模板

		// $this->assign('goodslist',$goodslist);
		// $this->display();
	}
	public function del(){
		$this->goodsModel->delete(I('get.goods_id'));
		$this->redirect('admin/goods/goodslist');
	}
}