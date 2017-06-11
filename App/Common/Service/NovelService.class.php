<?php
namespace Common\Service;
class NovelService {
    private $modelArrayStatic = [];

    public function __construct(){

    }

    public static function getModel( $name = 'Novel' ){
        if( !isset(self::$modelArrayStatic[$name]) ){
            self::$modelArrayStatic[$name] = D( $name );
        }
        return self::$modelArrayStatic[$name];
    }

    public function handlerNovel(){


    }

    public function getNovelFileMenu( $dir = '' ){
        if(is_dir($dir)){
            if ($dh = opendir($dir)){
                while (($file = readdir($dh)) !== false){
                    if((is_dir($dir."/".$file)) && $file!="." && $file!=".."){
                        $this->getNovelFileMenu($dir."/".$file."/");
                    }else{
                        if($file!="." && $file!=".."){
                            $this->filterNovelFileContentFcontent( $dir , $file );
                        }
                    }
                }
                closedir($dh);
            }
        }
    }

    public function handlerNovelFileView( $dir , $file ){
        $this->filterNovelFileContentFrow( $dir , $file );
        $this->filterNovelFileName( $dir , $file );
    }

    public function filterNovelFileName( $dir , $file ){
        $para = array('-[wodexiaoshuo.com]');
        $re = array( '' , '' , '' );
        $newfile = str_replace( $para , $re , $file );
        rename( $dir."/".$file.'.tmp' , $dir."/".$newfile );
    }

    public function filterNovelFileContentFrow( $dir , $file ){
        $fp1=fopen( $dir."/".$file , 'r' );
        $fp2=fopen( $dir."/".$file.'.tmp' , 'w' );
        $i = 0;
        while(!feof($fp1)){
            $line=fgets($fp1);
            if($i>11){
                $find = array(
                            '看特色销售就来我的小说网-wodexiaoshuo.com',
                            '看特色小说就来我的小说网-wodexiaoshuo.com',
                            '&hellip;','&ldquo;','&rdquo;','&mdash;',
                            'w','o','d','e','x','i','a','s','h','u','c','m',
                            'W','B','Z','C','O','.','*','看小说','小说网'
                           );
                $replace = array('','','...','"','"','--','','','','','','','','','','','','','','','','','','','','','');
                $line = str_replace($find,$replace,$line);
                fputs($fp2,$line);
            }else{
                fputs($fp2,'');
                $i++;
            }
             
        }
        fclose($fp1);
        fclose($fp2);
        unlink($dir."/".$file);
    }

    public function filterNovelFileContentFcontent( $dir , $file ){
        $old_content = file_get_contents( $dir."/".$file , 'r' );
        $fp2 = fopen( $dir."/".$file.'.tmp' , 'w' );
        $find = array(
                    '看特色销售就来我的小说网-wodexiaoshuo.com',
                    '看特色小说就来我的小说网-wodexiaoshuo.com',
                    '&hellip;','&ldquo;','&rdquo;','&mdash;',
                    'w','o','d','e','x','i','a','s','h','u','c','m',
                    'W','B','Z','C','O','.','*','看小说','小说网'
                   );
        $replace = array('','','...','"','"','--','','','','','','','','','','','','','','','','','','','','','');
        $filterstr = str_replace( $find , $replace , $old_content );
        fputs ( $fp2 , $filterstr );
        fclose ( $fp2 );
        unlink($dir."/".$file);
    }


}