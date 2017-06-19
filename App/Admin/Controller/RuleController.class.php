<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;

class RuleController extends AdminBaseController{

    public function ruleindex(){
    	if( IS_AJAX ){
    		$ruleObj = $this->getService('rule');
    		$rule = $ruleObj->ruleindex($param);
    		unset($ruleObj);
    		echo json_encode($rule);
    		exit;
    	}else{
    		$this->display();
    	}
    }

    public function editrule(){
    	if( IS_AJAX ){
			$id = I( 'id' );
			$pid = I( 'pid' );
			$rule_name = I( 'rule_name' );
			$rule = trim(I( 'rule' ));
			
			$param = [
				'id'=>$id,
				'pid'=>$pid,
				'rule_name'=>$rule_name,
				'rule'=>$rule,
			];
			$ruleObj = $this->getService('rule');
			$ret = $ruleObj->editrule( $param );
			unset($ruleObj);

			echo json_encode( $ret );
			exit;
		}else{
			echo json_encode( tp_return(-1 , 'bad request') );
			exit;
		}
    }

    public function delrule(){
    	if( IS_AJAX ){
			$id = I( 'id' );
			
			$param = [
				'id'=>$id,
			];
			$ruleObj = $this->getService('rule');
			$ret = $ruleObj->delrule( $param );
			unset($ruleObj);

			echo json_encode( $ret );
			exit;
		}else{
			echo json_encode( tp_return(-1 , 'bad request') );
			exit;
		}
    }

}