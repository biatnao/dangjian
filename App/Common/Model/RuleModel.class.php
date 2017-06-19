<?php
namespace Common\Model;

class RuleModel extends BaseModel {

    protected $tableName = 'auth_rule';

    public function getrule(){
        $data = $this->field('title as text,id,pid,name,status')->order('id is null,id')->select();
        // echo M()->getlastsql();
        return $data;
    }

    public function addrule( $data ){
    	return $this->addData($data);
    }


    public function editrule( $map , $data ){
    	return $this->saveData($map , $data);
    }

    public function deleterule( $map ){
    	return $this->deleteData( $map );
    }

    public function childrule( $map ){
    	return $this
            ->where(array('pid'=>$map['id']))
            ->count();
    }
}