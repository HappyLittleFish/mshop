<?php
namespace Home\Controller;
use Think\Controller;
class OrderController extends Controller {
    public function checkout(){
      $this->display();
    }
    public function done(){
      $this->display();
    }
}