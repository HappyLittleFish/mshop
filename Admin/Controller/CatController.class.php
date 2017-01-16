<?php
namespace Admin\Controller;
use Think\Controller;
class CatController extends Controller {
    public function cateadd(){
    	if (IS_POST) {
    	$catModel = D('Cat');
    	if($catModel->add($_POST)){
    		$this->redirect('admin/cat/catelist');
    	}
    	else{
    		echo "失败";
    	}	
        $this->display();
	}
	public function catelist(){
		$catModel = D("Cat");
		$this->assign("catlist",$catModel->gettree());
		$this->display();
	}
		public function cateedit(){
		if(IS_POST){
			$cat_model = D('cat');
			$cat_id = I('cat_id');
			if($cat_model->where('cat_id='.$cat_id)->save($_POST)){
				$this->redirect('admin/cat/catelist');
			}
		}
		$catModel = D("Cat");
		$this->assign('gettree',$gettree = $catModel->gettree());
		$this->assign('catinfo',$catModel->find(I('cat_id')));
		// $this->assign("catlist",$catModel->select());
		$this->display();
	}
		public function catedel(){
			$cat_id = I('cat_id');
			$catModel = D('cat');
			if ($catModel->delete(I('cat_id'))) {
				$this->redirect('admin/cat/catelist');
			}
			
		}


}