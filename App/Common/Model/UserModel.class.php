<?php
namespace Common\Model;

class UserModel extends BaseModel {

    protected $tableName = 'auth_admin';

    public function registerAdmin( $param ){
    	$data = [
    		'name'=>$param['name'],
    		'pwd'=>$param['pwd'],
    		'salt'=>$param['salt'],
    		// 'email'=>$param['email'],
    		// 'phone'=>$param['phone'],
    		'create_time'=>time(),
    	];

    	$bool = $this->add($data);
    	return $bool;
    }
}