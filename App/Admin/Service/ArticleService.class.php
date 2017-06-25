<?php
namespace Admin\Service;

class ArticleService {

    public static $modelArrayStatic = [];

    public static function getModel( $name = '' ){
        if( empty($name) ) return false;
        $name = ucfirst(strtolower($name));
        if( !isset(self::$modelArrayStatic[$name]) ){
            self::$modelArrayStatic[$name] = D( $name );
        }
        return self::$modelArrayStatic[$name];
    }

    public function collist( $param=[] ){
        $artObj = $this->getModel('article');
        $col = $artObj->collist();
        unset($artObj);
        return tp_return( 0 , 'ok' , $col );
    }

    public function getcol( $id ){
        $artObj = $this->getModel('article');
        $col = $artObj->getcol( $id );
        unset($artObj);
        return tp_return( 0 , 'ok' , $col );
    }

    public function editcol( $param=[] ){
        $id = $param['id'];
        $name = $param['name'];
        $type = $param['type'];
        $cover = $param['cover'];

        $artObj = $this->getModel('article');
        $data = [
        'name'=>$name,
        'type'=>$type,
        'cover'=>$cover,
        ];
        if( !empty($id) ){
            $bool = $artObj->editcol( $id , $data );
        }else{
            $bool = $artObj->addcol( $data );
        }
        unset($artObj);

        return tp_return( 0 , '操作成功' , $bool );
        
    }


    public function delcol( $param=[] ){
        $id = $param['id'];

        $artObj = $this->getModel('article');
        $bool = $artObj->delcol(['id'=>$id]);
        unset($artObj);

        return tp_return( 0 , '删除成功' , $bool );
    }


    public function artlist( $param=[] ){
        $col_id = $param['col_id'];
        $title = $param['title'];
        
        $where = [];
        if( !empty($col_id) ){
            $where['a.column_id'] = $col_id;
        }
        if( !empty($title) ){
            $where['a.title'] = ['like','%'.$title.'%'];
        }

        $artObj = $this->getModel('article');
        $art = $artObj->artlist( $where );
        unset($artObj);

        return tp_return( 0 , 'ok' , $art );
    }


    public function editart( $param=[] ){
        $id = $param['id'];
        extract($param);

        $artObj = $this->getModel('article');
        $data = [
        'title'=>$title,
        'column_id'=>$column_id,
        'cover'=>$cover,
        'question_id'=>$question_id,
        'content'=>$content,
        'content_text'=>$content_text,
        ];

        if( !empty($id) ){
            $bool = $artObj->editart( $id , $data );
        }else{
            $bool = $artObj->addart( $data );
        }
        unset($artObj);

        return tp_return( 0 , '操作成功' , $bool );
    }


    public function delart( $param=[] ){
        $id = $param['id'];

        $artObj = $this->getModel('article');
        $bool = $artObj->delart(['id'=>$id]);
        unset($artObj);

        return tp_return( 0 , '删除成功' , $bool );
    }


    public function getart( $param=[] ){
        $id = $param['id'];

        $artObj = $this->getModel('article');
        $art = $artObj->getart(['id'=>$id]);
        unset($artObj);

        return tp_return( 0 , '获取成功' , $art );
    }

    public function getpraise( $param=[] ){
        $id = $param['id'];

        $artObj = $this->getModel('article');
        $praise = $artObj->getpraise(['id'=>$id]);
        unset($artObj);

        return tp_return( 0 , 'ok' , $praise );
    }

    public function getcomment( $param=[] ){
        $id = $param['id'];

        $artObj = $this->getModel('article');
        $comment = $artObj->getcomment(['id'=>$id]);
        unset($artObj);

        return tp_return( 0 , 'ok' , $comment );
    }


    public function praise( $param=[] ){
        $id = $param['id'];
        $user_id = $param['user_id'];

        $data = [
        'article_id'=>$id,
        'user_id'=>$id,
        ];

        $artObj = $this->getModel('article');
        $bool = $artObj->praise($data);
        unset($artObj);

        return tp_return( 0 , 'ok' , $bool );
    }

    public function bannerlist(){
        $artObj = $this->getModel('article');
        $banner = $artObj->bannerlist( );
        unset($artObj);
        return tp_return( 0 , 'ok' , $banner );
    }

    public function editbanner( $param ){
        $id = $param['id'];
        extract($param);
        $artObj = $this->getModel('article');
        $data = [
        'linkurl'=>$linkurl,
        'imgurl'=>$imgurl,
        ];

        if( !empty($id) ){
            $bool = $artObj->editbanner( $id , $data );
        }else{
            $bool = $artObj->addbanner( $data );
        }
        unset($artObj);

        return tp_return( 0 , '操作成功' , $bool );
    }

    public function deletebanner( $param ){
        $id = $param['id'];

        $artObj = $this->getModel('article');
        $bool = $artObj->deletebanner(['id'=>$id]);
        unset($artObj);

        return tp_return( 0 , '删除成功' , $bool );
    }

    public function getbanner( $param=[] ){
        $id = $param['id'];

        $artObj = $this->getModel('article');
        $banner = $artObj->getbanner(['id'=>$id]);
        unset($artObj);

        return tp_return( 0 , 'ok' , $banner );
    }
}