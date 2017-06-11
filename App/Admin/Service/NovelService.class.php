<?php
namespace Admin\Service;
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
                            $this->filterNovelFileContentFrow( $dir , $file );
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
        echo $dir."/".$file.'.tmp';
        echo $dir."/".$newfile;
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
                            '\d','\n'
                           );
                $replace = array("1","2");
                $line = str_replace('/(小|说)+/ism',"",$line);
                fputs($fp2,$line);
            }else{
                fputs($fp2,'');
                $i++;
            }
             
        }
        fclose($fp1);
        fclose($fp2);
        //unlink($dir."/".$file);
    }

    public function filterNovelFileContentFcontent( $dir , $file ){
        $old_content = file_get_contents( $dir."/".$file , 'r' );
        $filter_zhongwen = array(
                    '看特色销售就来',
                    '看特色小说就来',
                    '我的小说网',
                    "看小说",
                    "小说网",
                    "精彩小说",
                    "发表于",
                    "这里有你想看却找不到的",
                    "小说"
                   );
        $replace_zhongwen = array("","","","","","","","","");
        $filter_fuhao = array(
                    '+','-'
                   );
        $replace_fuhao = array('','');
        $filter_zimu = array(
                    'w','o','d','e','x','i','a','s','h','u','c','m',
                    'W','B','Z','C','O','.','*'
                   );
        $filter_html = array(
                    '&hellip;','&ldquo;','&rdquo;','&mdash;',
                   );
        $replace_html = array('...','"','"','--');
        $replace = array('','','','','','','','','','','','','','','','','','','','','','','');
        $filterstr = str_replace( "我的小说网" , "" , "《我的小说网》" );
        echo $filterstr;exit;
        $filterstr = str_replace( $filter_fuhao , $replace_fuhao , $filterstr );
        
        file_get_contents ( $dir."/".$file.'.tmp' , $filterstr );
        fclose ( $fp2 );
        unlink($dir."/".$file);
    }


}