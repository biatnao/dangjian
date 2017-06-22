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

    public function getarticle(){
        $id = I('id');
        $user_id = $_SESSION['user_id'];

        $art = M('article a')
        ->field("a.title,u.name,a.create_time,c.content")
        ->join(" LEFT JOIN ".C('DB_PREFIX')."article_content c ON (a.id=c.article_id)")
        ->join(" LEFT JOIN ".C('DB_PREFIX')."auth_admin u ON (a.author_id=u.id)")
        ->where("a.id={$id}")
        ->find();
        $art['content'] = htmlspecialchars_decode($art['content']);
        $comment = M('article_comment m')
        ->field("m.content,m.create_time,u.name,u.avatar")
        ->join(" LEFT JOIN ".C('DB_PREFIX')."user u ON (m.user_id=u.id)")
        ->where("m.article_id={$id}")
        ->select();

        $isgood = M('aricle_praise')
        ->where(['user_id'=>$user_id,'article_id'=>$id])
        ->getField('id');

        $this->assign('art',$art);
        $this->assign('comment',$comment);
        $this->assign('isgood',$isgood);
        $this->display();
    }


}