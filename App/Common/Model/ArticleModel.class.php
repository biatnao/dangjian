<?php
namespace Common\Model;

class ArticleModel extends BaseModel{

    public function collist( $param = [] ){
        $col = M('ArticleColumn')->order('create_time')->select();
        return $col;
    }

    public function getcol( $id ){
        $col = M('ArticleColumn')->find($id);
        return $col;
    }

    public function addcol( $param = [] ){
    	$data = [
            'name'=>$param['name'],
            'type'=>$param['type'],
        ];
    	$bool = M('ArticleColumn')->add($data);
        return $bool;
    }

    public function editcol( $id = '' , $param = [] ){
    	$data = [
            'name'=>$param['name'],
            'type'=>$param['type'],
        ];
    	$bool = M('ArticleColumn')->where(['id' => $id])->save($data);
        return $bool;
    }

    public function delcol( $param ){
        $bool = M('ArticleColumn')->delete($param['id']);
        return $bool;
    }

    public function artlist( $param = [] ){
        $art = $this->alias('a')
        ->field('a.*,b.name as colname')
        ->join(" LEFT JOIN ".C('DB_PREFIX')."article_column b ON (a.column_id =b.id)")
        ->where($param)
        ->order('a.update_time desc,a.create_time desc')
        ->select();
        return $art;
    }

    public function addart( $param ){
        $data = [
            'title'=>$param['title'],
            'author_id'=>$_SESSION['user']['id'],
            'column_id'=>$param['column_id'],
            'intro'=>substr($param['content_text'], 0 , 100 ),
            'cover'=>$param['cover'],
            'question_id'=>$param['question_id'],
            'content'=>$content,
            'create_time'=>time(),
        ];

        $art = $this->add($data);
        if( $art ){
        	$content = ['article_id'=>$art , 'content'=>$param['content']];
        	$bool = M('ArticleContent')->add($content);
        }
        return $art;
    }

    public function editart( $id = '' , $param = [] ){
        $data = [
            'title'=>$param['title'],
            'column_id'=>$param['column_id'],
            'intro'=>substr($param['content_text'], 0 , 100 ),
            'cover'=>$param['cover'],
            'question_id'=>$param['question_id'],
            'content'=>$content,
            'update_time'=>time(),
        ];

    	$bool = $this->where(['id' => $id])->save($data);

    	$content = ['content'=>$param['content']];
    	$bool = M('ArticleContent')->where(['article_id' => $id])->save($content);

        return $bool;
    }

    public function delart( $param ){
        $bool = $this->delete($param['id']);
        $bool = M('ArticleContent')->where(['article_id'=>$param['id']])->delete();
        $bool = M('ArticleComment')->where(['article_id'=>$param['id']])->delete();
        $bool = M('ArticlePraise')->where(['article_id'=>$param['id']])->delete();
        $bool = $this->delete($param['id']);
        return $bool;
    }

    public function getart( $param ){
        $art = $this->find($param['id']);
        $content = M('ArticleContent')->where(['article_id'=>$param['id']])->find();
        if( !empty($art) ){
            $art['content'] = htmlspecialchars_decode($content['content']);
        }else{
        	$art = null;
        }
        return $art;
    }

    public function getpraise( $param ){
        $praise = M('ArticlePraise a')
        ->join(" LEFT JOIN ".C('DB_PREFIX')."user b ON (a.user_id = b.id)")
        ->where(['a.article_id'=>$param['id']])
        ->order('a.create_time')
        ->select('b.name');
        return $praise;
    }

    public function getcomment( $param ){
        $comment = M('ArticleComment a')
        ->field('b.name,b.avatar,a.content,a.create_time')
        ->join(" LEFT JOIN ".C('DB_PREFIX')."user b ON (a.user_id = b.id)")
        ->where(['a.article_id'=>$param['id']])
        ->order('a.create_time')
        ->select();
        return $comment;
    }

    public function praise( $param ){
        $praise = M('ArticlePraise')->where($param)->getField('id');
        if( $praise ){
        	$bool = M('ArticlePraise')->delete($param);
        }else{
        	$bool = M('ArticlePraise')->add($param);
        }
        return $bool;
    }

    public function bannerlist( $param = [] ){
        $banner = M('banner')->order('sort,id')->select();
        return $banner;
    }

    public function addbanner( $param ){
        $data = [
            'imgurl'=>$param['imgurl'],
            'linkurl'=>$param['linkurl'],
        ];

        $banner = M('banner')->add($data);
        return $banner;
    }

    public function editbanner( $id = '' , $param = [] ){
        $data = [
            'imgurl'=>$param['imgurl'],
            'linkurl'=>$param['linkurl'],
        ];

        $bool = M('banner')->where(['id' => $id])->save($data);
        return $bool;
    }

    public function deletebanner( $param ){
        $bool = M('banner')->delete($param['id']);
        return $bool;
    }

    public function getbanner( $param ){
        $banner = M('banner')->find($param['id']);
        return $banner;
    }
}