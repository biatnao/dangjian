<?php
namespace Home\Controller;
use Common\Controller\HomeBaseController;

class IndexController extends HomeBaseController {

	public function _initialize(){
		parent::_initialize();
	}

    public function index(){
        $column_id = I('column_id');
        $page = I('page' , 1);

        $column = M('article_column')->where(['id'=>$column_id])->find();
        // $column = M('article_column')->select();

        $where['column_id'] = $column_id;

        $banner = D('banner')->select();

    	$art = D('article')
        ->where($where)
        ->order('create_time desc,id desc')
        ->limit(0,7)
        ->select();
        $this->assign('banner',$banner);
        $this->assign('column_id',$column_id);
        $this->assign('column_name',$column['name']);
    	$this->assign('art',$art);
        $this->display();
    }

    public function getartlist(){
        $column_id = I('column_id');
        $page = I('page' , 1);

        $where['column_id'] = $column_id;
        
        $pageSize = 7;
        $limit = ($page-1)*$pageSize.','.$pageSize;

        $artlist = M('article')
        ->where($where)
        ->order('create_time desc,id desc')
        ->limit($limit)
        ->select();
        // echo M()->getlastsql();
        $this->assign('list',$artlist);
        if( IS_AJAX ){
            $this->display('index/articlelist-item');
        }else{
            $this->display();
        }

    }

    public function getarticle(){
        $id = I('id');
        $user_id = $this->user_id;

        $art = M('article a')
        ->field("a.id,a.title,u.name,a.good_count,a.create_time,c.content")
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

        $isgood = M('article_praise')
        ->where(['user_id'=>$user_id,'article_id'=>$id])
        ->getField('id');

        $this->assign('art',$art);
        $this->assign('comment',$comment);
        $this->assign('isgood',$isgood);
        $this->display();
    }

    public function apply(){
        $status = I('status');
        if( IS_AJAX ){
            $name = I('name');
            $idcard = I('idcard');
            $user_id = $this->user_id;

            $udpate = [
            'name'=>$name,
            'idcard'=>$idcard,
            'status'=>2
            ];
            M('user')->where(['id'=>$user_id])->save($udpate);
            echo json_encode(['code'=>0,'msg'=>'申请成功']);
            exit;
        }else{
            $this->assign('status',$status);
            $this->display();
        }
    }

    public function praise(){
        $id = I('id');
        $where = [
        'article_id'=>$id,
        'user_id'=>$this->user_id,
        ];
        $praise = M('article_praise')->where($where)->find();
        if(!empty($praise)){
            echo json_encode(['code'=>-1,'msg'=>'您已经点过赞了']);
            exit;
        }
        $bool = M('article_praise')->add($where);
        $bool = M('article')->where("id={$id}")->setInc('good_count');
        echo json_encode(['code'=>0,'msg'=>'ok']);
        exit;
    }

    public function addcomment(){
        $id = I('id');
        if(IS_AJAX){
            $content = I('content');
            $data = [
            'article_id'=>$id,
            'user_id'=>$this->user_id,
            'content'=>$content,
            'create_time'=>time(),
            ];
            $bool = M('article_comment')->add($data);
            if( $bool !== false ){
                M('article')->where("id={$id}")->setInc('comment_count');
            }
            echo json_encode(['code'=>0,'msg'=>'ok']);
            exit;
        }else{
            $this->assign('id',$id);
            $this->display();
        }
    }

}