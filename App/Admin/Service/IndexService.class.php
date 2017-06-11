<?php
namespace Admin\Service;
class IndexService {
    private $modelArrayStatic = [];

    public static function getModel( $name = 'Index' ){
        if( !isset(self::$modelArrayStatic[$name]) ){
            self::$modelArrayStatic[$name] = D( $name );
        }
        return self::$modelArrayStatic[$name];
    }

    public function getIndexMenu(){
        $menuArray = array(
            array( 
                menuid => 1,
                imgUrl1 => '../file/xwzx.png',name1=>'新闻中心','url1'=>'news/',
                imgUrl2 => '../file/wjgl.png',name2=>'玩家攻略'
            ),
            array(
                menuid => 2,
                imgUrl1 => '../file/zhcz.png',name1=>'账号充值',
                imgUrl2 => '../file/yxwp.png',name2=>'英雄物品'
            ),
            array(
                menuid => 3,
                imgUrl1 => '../file/zjxq.png',name1=>'战绩详情',
                imgUrl2 => '../file/fuli.png',name2=>'福利领取'
            )
        );
        return tp_return( 0 , 'ok' , $menuArray );
    }

    public function getIndexNews(){
        $newsArray = array(
            array('id'=>1,'imgUrl'=>'','text'=>'晒群雄上上签，领取虎符啦'),
            array('id'=>2,'imgUrl'=>'','text'=>'网吧活动升级在即，网鱼、杰拉、阿里邀您一起打起凡'),
            array('id'=>3,'imgUrl'=>'','text'=>'周末双倍武勋，祭出你最强的英雄吧'),
            array('id'=>4,'imgUrl'=>'','text'=>'周末双倍武勋，祭出你最强的英雄吧')
        );
        return tp_return( 0 , 'ok' , $newsArray );
    }


}