<?php
namespace Common\Controller;
use Common\Controller\BaseController;
class AdminBaseController extends BaseController {
    
    public static $service = [];

    public function _initialize(){
        parent::_initialize();
        $not_need_login=[
               'dz/admin/index/login',
               'dz/admin/index/register',
            ];

        // 转小写以兼容url大小写不统一的问题
        $action=strtolower(trim(__ACTION__,'/'));
        if (!in_array($action, $not_need_login)) {

            // 检测是否登录
            if (!check_login()) {
                if (IS_AJAX) {
                    ajax_return('','您需要登录！',1);
                }else{
                    $this->error('您需要登录！' ,'/dz/index.php?m=admin&c=index&a=login');
                }
            }

            // $auth=new \Think\Auth();
            
            // $result=$auth->check($action,$_SESSION['user']['id']);
            // if(!$result){
            //     $this->error('您没有权限访问',U('admin/index/welcome'));
            // }

        }
        
    }

    public function getService( $name = '' ){
        if( empty($name) ) return false;
        $name = ucfirst(strtolower($name));
        if( !isset($this->service[$name]) || empty($this->service[$name]) ){
            self::$service[$name] = D( $name , 'Service' );
        }
        return self::$service[$name];
    }

}