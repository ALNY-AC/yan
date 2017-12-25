<?php
/**
* +----------------------------------------------------------------------
* 创建日期：2017年12月19日14:06:16
* 最新修改时间：2017年12月19日14:06:16
* +----------------------------------------------------------------------
* https：//github.com/ALNY-AC
* +----------------------------------------------------------------------
* 微信：AJS0314
* +----------------------------------------------------------------------
* QQ:1173197065
* +----------------------------------------------------------------------
* #####配置其他信息控制器#####
* @author 代码狮
*
*/
namespace Admin\Controller;
use Think\Controller;
class SettingsController extends CommonController{
    
    //主
    public function index(){
        
        
        $model=M('setting');
        $app_setting=$model->where('setting_name = "app_setting"')->find();
        
        
        $app_setting=json_decode($app_setting['setting'],true);
        if(!empty($app_setting)){
            
            $call_me_bottom= $app_setting['call_me_bottom'];
            $call_me_rows=  $app_setting['call_me_rows'];
            $phone=$app_setting['phone'];
            $weixin=$app_setting['weixin'];
            $qq=$app_setting['qq'];
            
            
            $this->assign('call_me_bottom',$call_me_bottom);
            $this->assign('call_me_rows',$call_me_rows);
            $this->assign('phone',$phone);
            $this->assign('qq',$qq);
            $this->assign('weixin',$weixin);
        }
        
        
        $this->display();
    }
    
    public function save(){
        
        
        $post=I('post.save');
        
        $model=M('setting');
        $add=[];
        $setting=[];
        $setting['call_me_bottom']=$post['call_me_bottom'];
        $setting['call_me_rows']=$post['call_me_rows'];
        $setting['phone']=$post['phone'];
        $setting['weixin']=$post['weixin'];
        $setting['qq']=$post['qq'];
        
        $add['setting_name']='app_setting';
        $add['setting']=json_encode($setting);
        
        $result=  $model->add($add,null,true);
        $res=[];
        
        //=========判断=========
        if($result){
            $res['res']=1;
            $res['msg']=$result;
        }else{
            $res['res']=-1;
            $res['msg']=$result;
        }
        //=========判断end=========
        
        //=========输出json=========
        echo json_encode($res);
        //=========输出json=========
        
    }
    
}