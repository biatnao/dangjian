<?php
namespace Common\Controller;
use Common\Controller\BaseController;
class AdminBaseController extends BaseController {

    public function _initialize(){
        parent::_initialize();
        $not_need_login=[
                'admin/index/login',
                'admin/index/register',
            ];

        // 转小写以兼容url大小写不统一的问题
        $action=strtolower(trim(__ACTION__,'/'));

        if (!in_array($action, $not_need_login)) {

            // 检测是否登录
            if (!check_login()) {
                if (IS_AJAX) {
                    ajax_return('','您需要登录！',1);
                }else{
                    $this->error('您需要登录！');
                }
            }

            // $auth=new \Think\Auth();
            
            // $result=$auth->check($action,$_SESSION['user']['id']);
            // if(!$result){
            //     $this->error('您没有权限访问',U('admin/index/welcome'));
            // }

        }
        
    }

}