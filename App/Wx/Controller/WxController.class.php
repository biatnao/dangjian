<?php
namespace Wx\Controller;
use Common\Controller\BaseController;
use Wx\Api\WxApi;

class WxController extends BaseController {

    public static $api = null;

    public function _initialize(){
        parent::_initialize();
        self::$api = new WxApi();
    }

    /**
     * 微信验证URL方法
     * @return boolean 是否登录
     */
    public function valid(){
    	self::$api->valid();
    }

}