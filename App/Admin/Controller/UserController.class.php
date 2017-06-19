<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;

class UserController extends AdminBaseController{

    public function userlist(){
    	$status = I( 'status' );

    	$param = [
    	'status'=>$status,
    	];

		$userObj = $this->getService('user');
		$user = $userObj->userlist($param);
		unset($userObj);

		$this->assign('user',$user['list']);
		$this->display();
		// echo json_encode( $ret );
		// exit;
    }

    public function checkuser(){
    	if( IS_AJAX ){
			$user_id = I( 'user_id' );
			$status = I( 'status' );
			
			$param = [
				'user_id'=>$user_id,
				'status'=>$status,
			];
			$userObj = $this->getService('user');
			$ret = $userObj->checkuser( $param );
			unset($userObj);

			echo json_encode( $ret );
			exit;
		}else{
			echo json_encode( tp_return(-1 , 'bad request') );
			exit;
		}
    }

    public function adminlist(){
		$userObj = $this->getService('user');
		$ret = $userObj->adminlist( $param );
		unset($userObj);
		$this->assign('list' , $ret['list']);
		$this->display();
    }

    public function editadmin(){
		$id = I('id');
		$userObj = $this->getService('user');
    	if( IS_AJAX ){
			$name = I('name');
			$pwd = I('pwd');
			$email = I('email');
			$phone = I('phone');
			$group = I('group');
			
			$param = [
				'id'=>$id,
				'username'=>$name,
				'pwd'=>$pwd,
				'email'=>$email,
				'phone'=>$phone,
				'group'=>$group,
			];
			$ret = $userObj->editadmin( $param );
			unset($indexObj);

			echo json_encode( $ret );
			exit;
		}else{
			$param= [
			'id'=>$id
			];
			$ret = $userObj->getAdmin($param);
			$this->assign('admin',$ret['list']);
			$this->display();
		}
    }

    public function deleteadmin(){
		if( IS_AJAX ){
			$id = I( 'id' );
			
			$param = [
				'id'=>$id,
			];
			$userObj = $this->getService('user');
			$ret = $userObj->deleteadmin( $param );
			unset($userObj);

			echo json_encode( $ret );
			exit;
		}else{
			echo json_encode( tp_return(-1 , 'bad request') );
			exit;
		}
    }

    public function delart(){
    	if( IS_AJAX ){
			$id = I( 'id' , 0 );
			
			if( empty($id) ){
				return tp_return( -2 , '请选择文章');
			}
			$userObj = $this->getService('user');
			$param = [
				'id'=>$id,
			];
			$ret = $userObj->delart( $param );
			unset($userObj);

			echo json_encode( $ret );
			exit;
		}else{
			return tp_return( -1 , '错误请求');
		}
    }



}