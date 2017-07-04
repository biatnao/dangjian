<?php
namespace Common\Controller;

class HomeBaseController extends BaseController {
    public function _initialize(){
    	parent::_initialize();
    	$appid = 'wxb50f43adbb92f1c7';
    	$secret = 'd3dd76c8451bf23633ca589dd0a481c3';
    	$this->user_id = $_SESSION['user_id'];
    	if( empty($this->user_id) ){
    		if( !empty($_GET['code']) ){
    			$code = $_GET['code'];
    			$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$secret}&code={$code}&grant_type=authorization_code";
    			$res = ihttp_get($url);
    			$usr_arr = json_decode($res,true);
    			$auth_access_token = $usr_arr['access_token'];
    			$expires_in = $usr_arr['expires_in'];
    			$openid = $usr_arr['openid'];
    			$update = [
    			'auth_access_token'=>$auth_access_token,
    			'expires_time'=>time()+$expires_in,
    			];
    			M('wx_config')->where(['id'=>1])->save($update);
    			$user = M('user')->where(['openid'=>$openid])->find();
    			$_SESSION['user_id'] = $user['id'];
    			$this->user_id = $_SESSION['user_id'];
    		}else{
	    		$wxconfig = M('wx_config')->where(['id'=>1])->find();
		    	$redirect_uri = "http://".$_SERVER['HTTP_HOST']."/dz/index.php?m=home&c=index&a=index";
		    	// dump($redirect_uri);exit;
		    	$redirect_uri = urlencode($redirect_uri);
	    		$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_base&state=1#wechat_redirect";
	    		header('Location:'.$url);
    		}
    		
    	}else{
    		$user = M('user')->where(['id'=>$this->user_id])->find();
    	}
    	if(empty($user)){
			$this->error('请先关注');
		}else{
			$url_final = C('SITE_FINAL');
			// if($user['status'] == 0){
			// 	//申请界面
			// }elseif($user['status'] == 2){
			// 	//正在申请界面
			// }elseif($user['status'] == 3){
			// 	//申请界面,提示申请失败
			// }else{
			// 	//提醒关注
			// }
			//if($user['status'] != 1){
				//if(__ACTION__!=$url_final.'/Home/Index/apply'){
					//redirect($url_final."/index.php?m=home&c=index&a=apply&status={$user['status']}");
				//}
			//}
			
		}
		
    }
}