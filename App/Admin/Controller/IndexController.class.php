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
			echo json_encode(tp_return( 0 , 'ok' , [$username,$pwd] ));
			exit;
		}else{
			$this->display();
		}
    }

    public function register(){
		if( IS_AJAX ){
			$username = I('username');
			$pwd = I('pwd');
			
			$indexObj = $this->getService('index');

			$param = [
				'username'=>$username,
				'pwd'=>$pwd,
			];

			$ret = $indexObj->register( $param );

			unset($indexObj);
			echo json_encode( $ret );
			exit;
		}else{
			$this->display();
		}
    }

}