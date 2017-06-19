<?php
namespace Admin\Service;

class UserService extends BaseService{

    public function editadmin( $param=[] ){
        $name = $param['username'];
        $pwd = $param['pwd'];
        $phone = $param['phone'];
        $email = $param['email'];
        $group = $param['group'];
        $id = $param['id'];

        $userObj = $this->getModel('user');
        if( !empty($id) ){
            $update_time = time();
            $data = compact('name','salt','phone','email','group','update_time');
            if( !empty($pwd) ){
                list($data['pwd'],$data['salt']) = generatepwd( $pwd );
            }
            $bool = $userObj->updateAdmin( ['id'=>$id] , $data );
            $code = $bool!==false ? 0 : -1;
            $msg = $bool!==false ? '更新成功' : '更新失败';
        }else{
            if( empty($pwd) ){
                return tp_return( -2 , '密码不能为空' );
            }
            $admin = $userObj->getAdmin(['name'=>$name]);
            if( !empty($admin) ){
                $code = -2;
                $msg = '用户名已存在';
            }else{
                list($pwd,$salt) = generatepwd( $pwd );
                $bool = $userObj->registerAdmin(compact('name','pwd','salt','phone','email','group'));
                if( $bool ){
                    $_SESSION['user']['id'] = $bool;
                    $_SESSION['user']['name'] = $name;
                }
                $msg = $bool ? '注册成功' : '注册失败';
                $code = $bool ? 0 : -1;
            }
        }
        unset($userObj);

        $list = $bool!==false ? $bool : M()->getDbError();
        return tp_return( $code , $msg , $list );
        
    }

    public function adminlist( $param=[] ){
        $userObj = $this->getModel('user');
        $admin = $userObj->adminlist();
        unset($userObj);
        return tp_return( 0 , 'ok' , $admin );
    }

    public function deleteadmin( $param=[] ){
        $userObj = $this->getModel('user');
        $bool = $userObj->deleteadmin($param);
        unset($userObj);
        return tp_return( 0 , '删除成功' , $bool );
    }

    public function getAdmin( $param=[] ){
        $id = $param['id'];

        $data = [
        'id'=>$id
        ];
        $userObj = $this->getModel('user');
        $admin = $userObj->getAdmin($data);
        unset($userObj,$admin['pwd']);

        return tp_return( 0 , 'ok' , $admin );
    }


}