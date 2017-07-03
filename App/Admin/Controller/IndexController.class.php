<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
use Wechat\Wechat;

class IndexController extends AdminBaseController {

	public static $service = [];

	public function getService( $name = '' ){
		if( empty($name) ) return false;
		$name = ucfirst(strtolower($name));
		if( !isset($this->service[$name]) || empty($this->service[$name]) ){
			self::$service[$name] = D( $name , 'Service' );
		}
		return self::$service[$name];
	}

    public function login(){
		if( IS_AJAX ){
			$username 	= I('username');
			$pwd 		= I('pwd');

			$indexObj = $this->getService('index');
			$param = [
				'username'=>$username,
				'pwd'=>$pwd,
			];
			$ret = $indexObj->login( $param );
			unset($indexObj);

			echo json_encode( $ret );
			exit;
		}else{
			$this->display();
		}
    }

    public function loginout(){
		$_SESSION['user']['id'] = 0;
		$_SESSION['user']['name'] = '';
		$this->success( '登出成功' , C('SITE_FINAL').'/index.php?m=admin&c=index&a=login' );
    }

    public function index(){
		$this->display();
    }

    public function welcome(){
    	$this->display();
    }

}