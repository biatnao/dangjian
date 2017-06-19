<?php
namespace Common\Model;

class UserModel extends BaseModel {

    protected $tableName = 'user';

    public function adminlist(){
        $admin = M('AuthGroupAccess a')
        ->field('b.id,b.name,group_concat(c.title) AS groupname')
        ->join(" LEFT JOIN ".C('DB_PREFIX')."auth_admin b ON (a.uid=b.id)")
        ->join(" LEFT JOIN ".C('DB_PREFIX')."auth_group c ON (a.group_id=c.id)")
        ->group('a.uid')
        ->select();
        return $admin;
    }

    public function getAdmin( $param ){
        return M('AuthAdmin')->where($param)->find();
    }

    public function registerAdmin( $param ){
    	$data = [
    		'name'=>$param['name'],
    		'pwd'=>$param['pwd'],
    		'salt'=>$param['salt'],
    		'email'=>$param['email'],
    		'phone'=>$param['phone'],
    		'create_time'=>time(),
    	];
        $admin_id = M('AuthAdmin')->add($data);
        if( $admin_id !== false ){
            $mapdata = [
            'uid'=>$admin_id,
            'group_id'=>$param['group']
            ];
            $map_id = M('AuthGroupAccess')->add( $mapdata );
        }
        
    	return $admin_id;
    }

    public function updateAdmin( $map , $data ){
        $bool = M('AuthAdmin')->where($map)->save( $data );
        if( $bool!==false ){
            $bool = M('AuthGroupAccess')->where(['uid'=>$map['id']])->save( ['group_id'=>$data['group']] );
        }
        return $bool;
    }

    public function deleteadmin( $param ){
        $bool = M('AuthGroupAccess')->where(['uid'=>$param['id']])->delete( );
        if( $bool!==false ){
            $bool = M('AuthAdmin')->where(['id'=>$param['id']])->delete();
        }
        return $bool;
    }


    



}