<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
use Wechat\Wechat;

class IndexController extends AdminBaseController {

    public function index(){
		$options = array(
			'token'=>'tokenaccesskey' //填写你设定的key
		);
		$weObj = new Wechat($options);
		dump($weObj);
		$weObj->valid();
		$type = $weObj->getRev()->getRevType();
		switch($type) {
			case Wechat::MSGTYPE_TEXT:
				$weObj->text("hello, I'm wechat")->reply();
				exit;
			break;
			case Wechat::MSGTYPE_EVENT:
			break;
			case Wechat::MSGTYPE_IMAGE:
			default:
			$weObj->text("help info")->reply();
		}
        echo 111;
    }

}