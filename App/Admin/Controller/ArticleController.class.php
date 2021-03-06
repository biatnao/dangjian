<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;

class ArticleController extends AdminBaseController{

	public static $service = [];

	public function getService( $name = '' ){
		if( empty($name) ) return false;
		$name = ucfirst(strtolower($name));
		if( !isset($this->service[$name]) || empty($this->service[$name]) ){
			self::$service[$name] = D( $name , 'Service' );
		}
		return self::$service[$name];
	}
	
    public function collist(){
    	if( IS_GET ){
    		$type = I('type');
			$artObj = $this->getService('article');
			
			$col = $artObj->collist(['type'=>$type]);
			unset($artObj);

			$this->assign('col',$col['list']);
			$this->display();
			// echo json_encode( $ret );
			// exit;
		}else{
			return tp_return( -1 , '错误请求');
		}
    }

    public function editcol(){
		$id = I( 'id' , 0 );
		$artObj = $this->getService('article');
    	if( IS_POST ){
			$name = I( 'name' );
			$type = I( 'type' );
			$old_cover = I( 'oldcover' , '' );
			$filedata = app_upload_image('article');
			$cover = $filedata[0] ? $filedata[0]:$old_cover;

			$param = [
				'name'=>$name,
				'type'=>$type,
				'cover'=>$cover,
				'id'=>$id,
			];
			$ret = $artObj->editcol( $param );
			unset($artObj);
			$this->success( '编辑成功' ,  C('SITE_FINAL').'/index.php?m=admin&c=article&a=collist' );
		}else{
			if( !empty($id) ){
				$col = $artObj->getcol( $id );
				$this->assign('col',$col["list"]);
			}
			unset($artObj);
			$this->display();
		}
    }

    public function delcol(){
    	if( IS_AJAX ){
			$id = I( 'id' , 0 );
			
			if( empty($id) ){
				return tp_return( -2 , '请选择栏目');
			}
			$artObj = $this->getService('article');
			$param = [
				'id'=>$id,
			];
			$ret = $artObj->delcol( $param );
			unset($artObj);

			echo json_encode( $ret );
			exit;
		}else{
			return tp_return( -1 , '错误请求');
		}
    }

    public function artlist(){
    	if( IS_GET ){
			$col_id = I( 'col_id' );
			
			$param = [
				'col_id'=>$col_id,
			];

			$artObj = $this->getService('article');
			$ret = $artObj->artlist( $param );
			unset($artObj);

			$this->assign('col',$ret["list"]);
			$this->display();
			// echo json_encode( $ret );
			// exit;
		}else{
			return tp_return( -1 , '错误请求');
		}
    }

    public function editart(){
		$id = I( 'id' , 0 );
		$artObj = $this->getService('article');
    	if( IS_POST ){
			$title = I( 'title' );
			$column_id = I( 'column_id' );
			$question_id = I( 'question_id' );
			$content = I( 'content' , '' , 'htmlspecialchars' );
			$content_text = I( 'content_text' );
			$old_cover = I( 'oldcover' , '' );
			$filedata = app_upload_image('article');
			$cover = $filedata[0] ? $filedata[0]:$old_cover;

			$param = [
				'title'=>$title,
				'column_id'=>$column_id,
				'cover'=>$cover,
				'question_id'=>$question_id,
				'content'=>$content,
				'content_text'=>$content_text,
				'id'=>$id,
			];
			$ret = $artObj->editart( $param );
			unset($artObj);
			if( $ret['code'] == 0 ){
				$this->success('操作成功',  C('SITE_FINAL').'/index.php?m=Admin&c=Article&a=artlist');
			}else{
				$this->error('操作失败');
			}
			
		}else{
			if( !empty($id) ){
				$param = [
				'id'=>$id
				];
				$ret = $artObj->getart( $param );
				$this->assign('art',$ret['list']);
			}
			$col = $artObj->collist();
			unset($artObj);

			$this->assign('col',$col['list']);
			$this->display();
		}
    }

    public function delart(){
    	if( IS_AJAX ){
			$id = I( 'id' , 0 );
			
			if( empty($id) ){
				return tp_return( -2 , '请选择文章');
			}
			$artObj = $this->getService('article');
			$param = [
				'id'=>$id,
			];
			$ret = $artObj->delart( $param );
			unset($artObj);

			echo json_encode( $ret );
			exit;
		}else{
			return tp_return( -1 , '错误请求');
		}
    }

    public function bannerlist(){
    	if( IS_GET ){
    		
			$artObj = $this->getService('article');
			$ret = $artObj->bannerlist();
			unset($artObj);

			$this->assign('banner',$ret["list"]);
			$this->display();
		}else{
			return tp_return( -1 , '错误请求');
		}
    }

    public function editbanner(){
		$id = I( 'id' , 0 );
		$artObj = $this->getService('article');
    	if( IS_POST ){
			$linkurl = I( 'linkurl' );
			$filedata = app_upload_image('banner');
			$imgurl = $filedata[0];

			$param = [
				'linkurl'=>$linkurl,
				'imgurl'=>$imgurl,
				'id'=>$id,
			];
			$ret = $artObj->editbanner( $param );
			unset($artObj);
			if( $ret['code'] == 0 ){
				$this->success('操作成功', C('SITE_FINAL').'/index.php?m=Admin&c=Article&a=bannerlist');
			}else{
				$this->error('操作失败');
			}
		}else{
			if( !empty($id) ){
				$param = [
				'id'=>$id
				];
				$ret = $artObj->getbanner( $param );
				unset($artObj);
				$this->assign('banner',$ret['list']);
			}
			$this->display();
		}
    }

    public function deletebanner(){
    	if( IS_AJAX ){
			$id = I( 'id' , 0 );
			
			if( empty($id) ){
				return tp_return( -2 , '请选择轮播图');
			}
			$artObj = $this->getService('article');
			$param = [
				'id'=>$id,
			];
			$ret = $artObj->deletebanner( $param );
			unset($artObj);

			echo json_encode( $ret );
			exit;
		}else{
			return tp_return( -1 , '错误请求');
		}
    }


}