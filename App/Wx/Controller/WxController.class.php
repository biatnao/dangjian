<?php
namespace Wx\Controller;
use Common\Controller\BaseController;
use Common\Api\WxApi;
use \think\Log;

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
        $json = json_encode($_POST);
        Log::init([
            'type'  =>  'File',
            'path'  =>  RUNTIME_PATH.'Logs/Wx/event'
        ]);
        Log::write($res,'event');
    }

    public function gettoken(){
        return '_ds6sl1SKNeef1crEJTfTxDRQtyehObQ08MC8AaK9uApR238_MEDrPnbJPch9WL72ED-08CyhMiOM5IEcHmyBT0pQzD4pbUwIL0WkqQGPTkBK7Ea5tXbmqu8p5rPGnnJHPQcAFABJK';
        $appid = 'wxb50f43adbb92f1c7';
        $secret = 'd3dd76c8451bf23633ca589dd0a481c3';
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";
        $res = ihttp_get($url);
        Log::init([
            'type'  =>  'File',
            'path'  =>  RUNTIME_PATH.'Logs/Wx/'
        ]);
        Log::write($res,'gettoken');
        $arr = json_decode($res);

        exit;
    }

    public function setmenu(){
        $token = $this->gettoken();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$token}";
        $menu = array (
          'button' => 
          array (
            0 => 
            array (
              'type' => 'view',
              'name' => urlencode('首页'),
              'url' => 'http://weilitui.com/dz/index.php?m=home&c=index&a=index',
            ),
            1 => 
            array (
              'name' => urlencode('菜单'),
              'sub_button' => 
              array (
                0 => 
                array (
                  'type' => 'view',
                  'name' => urlencode('搜索'),
                  'url' => 'http://www.baidu.com/',
                ),
                1 => 
                array (
                  'type' => 'click',
                  'name' => urlencode('赞一下我们'),
                  'key' => 'V1001_GOOD',
                ),
              ),
            ),
          ),
        );
        $res = ihttp_post($url,urldecode(json_encode($menu)));
        Log::init([
            'type'  =>  'File',
            'path'  =>  RUNTIME_PATH.'Logs/Wx/'
        ]);
        Log::write($res,'setmenu');
        $arr = json_decode($res);

        exit;
    }


    public function getuser(){

    }
}