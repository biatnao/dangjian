<?php
namespace Admin\Service;
use Common\Service\BaseService;

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

    public function userlist( $param=[] ){
        $where = [];
        if( !empty($param['name']) ){
            $where['name|nickname'] = ['like','%'.$param['name'].'%'];
        }
        if( !empty($param['status']) ||  $param['status'] === '0' ){
            $where['status'] = $param['status'];
        }
        $userObj = $this->getModel('user');
        $admin = $userObj->userlist( $where );
        unset($userObj);
        return tp_return( 0 , 'ok' , $admin );
    }

    public function checkuser( $param=[] ){
        $user_id = $param['user_id'];
        $status = $param['status'];
        if( empty($user_id) ){
            return tp_return( -1 , '请选择用户' );
        }
        $map = [
            'id'=>$user_id,
        ];
        $data = [
            'status'=>$status,
        ];
        $userObj = $this->getModel('user');
        $ret = $userObj->updateUser( $map , $data );
        unset($userObj);

        return tp_return( 0 , 'ok' , $ret );
    }

    public function getuser( $param=[] ){
        $user_id = $param['id'];
        if( empty($user_id) ){
            return tp_return( -1 , '请选择用户' );
        }
        $where = [
            'id'=>$user_id,
        ];
        $userObj = $this->getModel('user');
        $user = $userObj->getuser( $where );
        unset($userObj , $user['pwd'] );

        return tp_return( 0 , 'ok' , $user );
    }

}