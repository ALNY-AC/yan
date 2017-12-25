<?php
/**
* +----------------------------------------------------------------------
* 创建日期：2017年11月28日
* 最新修改时间：2017年11月28日
* +----------------------------------------------------------------------
* https：//github.com/ALNY-AC
* +----------------------------------------------------------------------
* 微信：AJS0314
* +----------------------------------------------------------------------
* QQ:1173197065
* +----------------------------------------------------------------------
* #####测试控制器#####
* @author 代码狮
*
*/
namespace Admin\Controller;
use Think\Controller;
class TestController extends Controller{
    
    public function index(){
        
        $t=strtotime('2017-12-08 16:45:38');
        echo $t;
        die;
        $this->display();
        
    }
    
    
    public function delFile(){
        
        
        
        die;
        $src=WORKING_PATH.'/'.'/Public/Upload//test/2017-12-09/5a2bfaa6188b4.jpg';
        $state=delFile($src);
        
        dump($src);
        dump($state);
        die;
        
        
        
        die;
        
        
        echo '输出地址';
        dump($src);
        
        
        echo '判断开头';
        dump(startwith($src, '/'));
        
        echo '删除过后的';
        $src = ltrim($src,"/"); //
        dump($src);
        
        echo '输出状态';
        dump($state);
        
    }
    
}