<?php
namespace Admin\Service;

class BaseService {

    public static $modelArrayStatic = [];

    public static function getModel( $name = '' ){
        if( empty($name) ) return false;
        $name = ucfirst(strtolower($name));
        if( !isset(self::$modelArrayStatic[$name]) ){
            self::$modelArrayStatic[$name] = D( $name );
        }
        return self::$modelArrayStatic[$name];
    }

}