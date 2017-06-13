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

    public function register( $param=[] ){
        $name = $param['username'];
        $pwd = $param['pwd'];

        $salt=base64_encode(mcrypt_create_iv(32,MCRYPT_DEV_RANDOM));
        $pwd=sha1($pwd.$salt); 

        $userObj = $this->getModel('user');
        $bool = $userObj->registerAdmin(compact('name','pwd','salt'));
        unset($userObj);

        if($bool){
            return tp_return( 0 , 'ok' , $bool );
        }else{
            return tp_return( -1 , 'error' , M()->getDbError() );
        }
        
    }


}