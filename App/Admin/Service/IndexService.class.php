<?php
namespace Admin\Service;

class IndexService {

    public static $modelArrayStatic = [];

    public static function getModel( $name = '' ){
        if( empty($name) ) return false;
        $name = ucfirst(strtolower($name));
        if( !isset(self::$modelArrayStatic[$name]) ){
            self::$modelArrayStatic[$name] = D( $name );
        }
        return self::$modelArrayStatic[$name];
    }

    public function login( $param=[] ){
        $name = $param['username'];
        $pwd = $param['pwd'];

        $userObj = $this->getModel('user');
        $login = $userObj->getAdmin(['name'=>$name]);
        unset($userObj);

        if( !empty($login) ){
            $pwd=sha1($pwd.$login['salt']); 
            if( $login['pwd'] == $pwd ){
                $_SESSION['user']['id'] = $login['id'];
                $_SESSION['user']['name'] = $login['name'];
                return tp_return( 0 , '登录成功' , $bool );
            }else{
                return tp_return( -2 , '用户名或密码错误' );
            }
        }else{
            return tp_return( -1 , '用户名或密码错误' );
        }
        
    }

    public function register( $param=[] ){
        $name = $param['username'];
        $pwd = $param['pwd'];

        $salt=base64_encode(mcrypt_create_iv(32,MCRYPT_DEV_RANDOM));
        $pwd=sha1($pwd.$salt); 

        $userObj = $this->getModel('user');
        $admin = $userObj->getAdmin(['name'=>$name]);
        if( !empty($admin) ){
            $code = -2;
            $msg = '用户名已存在';
        }else{
            $bool = $userObj->registerAdmin(compact('name','pwd','salt'));
            unset($userObj);
            if( $bool ){
                $_SESSION['user']['id'] = $bool;
                $_SESSION['user']['name'] = $name;
            }
            $code = $bool ? 0 : -1;
            $msg = $bool ? '注册成功' : '注册失败';
            $list = $bool ? $bool : M()->getDbError();
        }
        return tp_return( $code , $msg , $list );
        
    }


}