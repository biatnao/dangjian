<?php
namespace Home\Controller;
use Common\Controller\HomeBaseController;

class IndexController extends HomeBaseController {

	public function _initialize(){
		parent::_initialize();
	}

    public function index(){
    	$banner = D('banner')->select();
    	$art = D('article')->order('create_time desc,id desc')->select();
    	$this->assign('banner',$banner);
    	$this->assign('art',$art);
        $this->display();
    }
}