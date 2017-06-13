<?php
namespace Wx\Api;
use Wechat\Wechat;

class WxApi{

	public static $token = 'lthboIvK1zs1NPJBt0JnS2ka1Ozohho0';

	public function __construct(){
	}

	/**
	 * 微信验证URL方法
	 * @return boolean 是否登录
	 */
    public function valid(){
    	$options = [
			'token'=>self::$token,
			// 'debug'=>1
		];
		$weObj = new Wechat($options);
		$weObj->valid();
    }

}