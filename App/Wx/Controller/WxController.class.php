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
        Log::init([
            'type'  =>  'File',
            'path'  =>  RUNTIME_PATH.'Logs/Wx/'
        ]);
        Log::write('开始调用','event');
    	// $echostr = self::$api->valid();
        // Log::write($echostr,'user');
        // return $echostr;
        $postStr = file_get_contents("php://input");
        Log::write($postStr,'event');
        if (!empty($postStr)) {
            $receive = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            // $str=json_encode($receive);
            $receice_arr = get_object_vars($receive);
            if($receice_arr['MsgType'] == 'event'){
                $openid = $receice_arr['FromUserName'];
                Log::write($openid,'openid');
                if($receice_arr['Event'] == 'subscribe'){
                    $user = M('user')->where(['openid'=>$openid])->find();
                    Log::write(json_encode($user),'user');
                    if(!empty($user)){
                        M('user')->where(['id'=>$user['id']])->save(['status'=>0]);
                        $user_id = $user['id'];
                    }else{
                        $data = [
                        'openid'=>$openid,
                        'create_time'=>time()
                        ];
                        $user_id = M('user')->add($data);
                    }
                    $token = $this->gettoken();
                    $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$token}&openid={$openid}&lang=zh_CN";
                    $res = ihttp_get($url);
                    $arr = json_decode($res , true);
                    $nickname = $arr['nickname'];
                    $avatar = $arr['headimgurl'];
                    $update = compact('nickname','avatar');
                    M('user')->where(['id'=>$user_id])->save($update);
                }elseif($receice_arr['Event'] == 'unsubscribe'){
                    M('user')->where(['openid'=>$openid])->save(['status'=>3]);
                }
            }else{

            }
            // foreach ($receice_arr as $key => $value) {
            // Log::write($key.":".$value,'data');
            // }
        }else{
            Log::write('获取数据为空','event');
        }
    }

    public function gettoken(){
        Log::init([
            'type'  =>  'File',
            'path'  =>  RUNTIME_PATH.'Logs/Wx/'
        ]);
        $wxconfig = M('wx_config')->where(['id'=>1])->find();
        Log::write(json_encode($wxconfig),'config');
        if(time()>=$wxconfig['token_time']||empty($wxconfig['token'])){
            // $appid = 'wx3130f97927daaff9';
            // $secret = 'effd3292b0d059802e727091dfa38636';
            $appid = 'wxb50f43adbb92f1c7';//ceshi
           $secret = 'd3dd76c8451bf23633ca589dd0a481c3';//ceshi
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";
            $res = ihttp_get($url);
            Log::write($res,'config');
            $arr = json_decode($res,true);
            $token = $arr['access_token'];
            $token_time = time()+$arr['expires_in'];
            $update = [
                'token'=>$token,
                'token_time'=>$token_time,
            ];
            Log::write(json_encode($update),'config');
            M('wx_config')->where(['id'=>1])->save($update);
            Log::write(M()->getlastsql(),'config');
        }else{
            $token = $wxconfig['token'];
        }
        return $token;
    }

    public function setmenu(){
        $token = $this->gettoken();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$token}";
        $menu_url = 'http://weilitui.com/dz/index.php?m=home&c=index&a=index&column_id=';
        $is_close = "http://weilitui.com/dz/index.php?m=home&c=close&a=index";
        $apply = "http://weilitui.com/dz/index.php?m=home&c=index&a=apply";
        $menu = array (
          'button' => 
          array (
            0 => 
            array (
              'name' => urlencode('热点关注'),
              'sub_button' =>[
                  [
                'type' => 'view',
                'name' => urlencode('要闻动态'),
                'url' => $menu_url.'4',
                ],
                [
                'type' => 'view',
                'name' => urlencode('深度解读'),
                'url' => $menu_url.'6',
                ],
                [
                'type' => 'view',
                'name' => urlencode('一分钟党课'),
                'url' => $menu_url.'7',
                ],
                [
                'type' => 'view',
                'name' => urlencode('应知应会'),
                'url' => $menu_url.'8',
                ],
                [
                'type' => 'view',
                'name' => urlencode('两学一做'),
                'url' => $menu_url.'5',
                ],
              ],
            ),
            1 => 
            array (
              'name' => urlencode('组织生活'),
              'sub_button' =>[
                [
                'type' => 'view',
                'name' => urlencode('学习计划'),
                'url' => $menu_url.'3',
                ],
                [
                'type' => 'view',
                'name' => urlencode('理论中心组学习'),
                'url' => $menu_url.'2',
                ],
                [
                'type' => 'view',
                'name' => urlencode('支部组织生活'),
                'url' => $menu_url.'1',
                ],
                [
                'type' => 'view',
                'name' => urlencode('专题党课'),
                'url' => $menu_url.'13',
                ],
                [
                'type' => 'view',
                'name' => urlencode('党风廉政'),
                'url' => $menu_url.'14',
                ],
              ],
            ),
            2=>
            array (
              'name' => urlencode('党员之家'),
              'sub_button' =>[
              [
              'type' => 'view',
              'name' => urlencode('党员身份'),
              'url' => 'http://weilitui.com/dz/index.php?m=home&c=index&a=apply',
              ],
              [
              'type' => 'view',
              'name' => urlencode('党费计算器'),
              'url' => $is_close,
              ],
              [
              'type' => 'view',
              'name' => urlencode('微投票'),
              'url' => $is_close,
              ],
              [
              'type' => 'view',
              'name' => urlencode('活动报名/签到'),
              'url' => $is_close,
              ],
              [
              'type' => 'view',
              'name' => urlencode('在线学习'),
              'url' => $is_close,
              ],
                // [
                // 'type' => 'view',
                // 'name' => urlencode('会员注册'),
                // 'url' => 'http://weilitui.com/dz/index.php?m=home&c=index&a=apply',
                // ],
              ],
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

    public function getindustry(){
        $token = $this->gettoken();
        $api_url = "https://api.weixin.qq.com/cgi-bin/template/get_industry?access_token={$token}";
         Log::init([
            'type'  =>  'File',
            'path'  =>  RUNTIME_PATH.'Logs/Wx/'
        ]);
        $res = ihttp_get($api_url);
        Log::write($res,'getindustry');
        $arr = json_decode($res , true);
    }

    public function setindustry(){
        $token = $this->gettoken();
        $api_url = "https://api.weixin.qq.com/cgi-bin/template/api_set_industry?access_token={$token}";
        $data = [
            "industry_id1"=>21,
            "industry_id2"=>18
        ];
         Log::init([
            'type'  =>  'File',
            'path'  =>  RUNTIME_PATH.'Logs/Wx/'
        ]);
        $res = ihttp_post($api_url,json_encode($data));
        Log::write($res,'getindustry');
        $arr = json_decode($res , true);
    }

    public function gettemplate(){
        $token = $this->gettoken();
        $api_url="https://api.weixin.qq.com/cgi-bin/template/api_add_template?access_token={$token}";
        $data = [
            "template_id_short"=>21,
        ];
         Log::init([
            'type'  =>  'File',
            'path'  =>  RUNTIME_PATH.'Logs/Wx/'
        ]);
        $res = ihttp_post($api_url,json_encode($data));
        Log::write($res,'gettemplate');
        $arr = json_decode($res , true);
    }

    public function getallprivatetemplate( ) {
        $token = $this->gettoken();
        $url = 'https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token={$token}';
         Log::init([
            'type'  =>  'File',
            'path'  =>  RUNTIME_PATH.'Logs/Wx/'
        ]);
        $res = $this->ihttp_get($url);
         Log::write($res,'getallprivatetemplate');
        $arr = json_decode($res , true);
    }
    
    public function sendMsg( $touser ){
        $token = $this->gettoken();
        $myopenid = 'ozV69s73dWyDUN2PhsOnrTur34oQ';
        $template_arr = C('FWH_API.TEMPLATE_ARR');
        $arr = array("touser"=>$myopenid,
           "template_id"=>$template_arr[0],     //报修模板
           "url"=>"http://www.baidu.com",            
           "data"=>array(
                "first"=>array(
                "value"=>"维修派单",
                "color"=>"#173177"
                ),
                "keyword1"=>array(
                "value"=>"2015-4-7",
                "color"=>"#173177"
                ),
                "keyword2"=>array(
                "value"=>"谭勇",
                "color"=>"#173177"
                ),
                "remark"=>array(
                "value"=>"请尽快维修",
                "color"=>"#173177"
                )
           )
                   
           );
        $url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token={$token}';
        $res = $this->handleApi($url,$data);
        return $res;
    }

}