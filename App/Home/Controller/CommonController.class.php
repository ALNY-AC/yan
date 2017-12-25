<?php
/**
* +----------------------------------------------------------------------
* 创建日期：2017年11月28日
* +----------------------------------------------------------------------
* https：//github.com/ALNY-AC
* +----------------------------------------------------------------------
* 微信：AJS0314
* +----------------------------------------------------------------------
* QQ:1173197065
* +----------------------------------------------------------------------
* #####需要登录权限的继承本控制器#####
* @author 代码狮
*
*/
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    
    
    //ThinkPHP提供的构造方法
    public function _initialize() {
        
        //验证openid
        
        // $app_name = M('config')->getField('app_name');
        // C('TMPL_PARSE_STRING.__APPNAME__',$app_name);
        
        // $model=M('setting');
        // $app_setting=$model->where('setting_name = "app_setting"')->find();
        
        // $app_setting=json_decode($app_setting['setting'],true);
        
        // $result=    $model->where('ip = "'.$add['ip'].'"')->find();
        // if(!$result){
        //     $model->add($add,null,true);
        // }
        $app_name = M('config')->getField('app_name');
        C('TMPL_PARSE_STRING.__APPNAME__',$app_name);
        define('__APPNAME__', $app_name);
    }
    
    //空操作
    public function _empty(){
        $this->error('页面不存在！',U('Index/index'),3);
    }
    
}