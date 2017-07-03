<?php
namespace Admin\Service;
use Common\Service\BaseService;

class RuleService extends BaseService{

    public function ruleindex( $param=[] ){

        $ruleObj = $this->getModel('rule');
        $rule_init = $ruleObj->getrule();
        $rule = $ruleObj->getTreeData( $rule_init , 'level','id','title');
        $rule = $this->removekey($rule);
        unset($ruleObj);

        return tp_return( 0 , 'ok' , $rule );
    }

    public function removekey( $arr ){
        $newarr = [];
        foreach ($arr as $key => $value) {
            $current = $value;
            $current['tags'][] = $value['name'];
            if(!empty($arr[$key]['nodes'])){
                $current['nodes'] = $this->removekey($arr[$key]['nodes']);
            }else{
                unset($current['nodes']);
            }
            $newarr[] = $current;
        }
        return $newarr;
    }

    public function editrule( $param=[] ){
        $data = [
        'title' => $param['rule_name'],
        'name' => $param['rule']
        ];

        $ruleObj = $this->getModel('rule');
        if( $param['id']==="" ){
            $data['pid'] = $param['pid'];
            $bool = $ruleObj->addrule( $data );
        }else{
            $map['id'] = $param['id'];
            $bool = $ruleObj->editrule( $map , $data );
        }
        unset($ruleObj);

        return tp_return( 0 , '操作成功' , $bool );
    }

    public function delrule( $param=[] ){
        $map = [
        'id' => $param['id'],
        ];

        $ruleObj = $this->getModel('rule');
        $child = $ruleObj->childrule( $map );
        if( $child!=0 ){
            unset($ruleObj);
            return tp_return( -2 , '请先删除子权限' , $child );
        }
        $bool = $ruleObj->deleterule( $map );
        unset($ruleObj);

        return tp_return( 0 , '操作成功' , $bool );
    }


}