<?php
namespace Admin\Controller;
use Think\Controller;
class CtosController extends Controller{
    
    //构造函数
    public function _initialize(){
        
        
        $pwd=I('get.pwd');
        if($pwd!=='yh12138**'){
            die;
        }
        
        $app_name = M('config')->getField('app_name');
        
        if($app_name){
            C('TMPL_PARSE_STRING.__APPNAME__',$app_name);
            $this->assign('is_app_config',true);
        }else{
            $this->assign('is_app_config',false);
        }
        
        
        $userConfig = M('admin')->getField('admin_id');
        
        if(!$userConfig){
            $this->assign('is_user_config',false);
        }else{
            $this->assign('is_user_config',true);
        }
        
        //开始看看有没有配置过
        
    }
    //主
    public function index(){
        
        
        
        $this->display();
        
    }
    //主
    public function index2(){
        
        
        $this->display();
        
    }
    
    
    public function appConfig(){
        
        
        $info = I('post.');
        
        $table = 'config';
        $model = M($table);
        
        $save = $info['save'];
        $save['id'] = 1;
        $save['edit_time'] = time();
        
        $result = $model->add($save,null,true);
        
        if($result!== false){
            $res['res'] = 1;
            $res['msg'] = $result;
        }else{
            $res['res'] = -1;
            $res['msg'] = $result.'【'.$id.'】【'.json_encode($save).'】【'.$table.'】';
        }
        
        echo json_encode($res);
        
    }
    
    public function userConfig(){
        
        
        $post=I('post.');
        $admin_id=$post['admin_id'];
        $pwd=$post['admin_pwd'];
        $pwd2=$post['admin_pwd_2'];
        
        if($pwd===$pwd2){
            //=========添加数据=========
            
            $post['admin_pwd']=md5($pwd2.__KEY__);
            
            $model=M('admin');
            //=========添加数据区
            $add=[];
            $add=$post;
            $add['admin_name']=$admin_id;
            $add['admin_head_img']='/Public/Upload/admin/head_img/h5.jpg';
            $add['add_time']=time();
            $add['edit_time']=time();
            //=========sql区
            $result=$model->add($add,null,true);
            //=========判断=========
            if($result){
                $res['res']=$result;
                $res['msg']=$result;
            }else{
                $res['res']=-1;
                $res['msg']=$result;
            }
            //=========判断end=========
            
        }else{
            $res['res']=-1;
            $res['msg']='密码不一致！';
        }
        
        //=========输出json=========
        echo json_encode($res);
        //=========输出json=========
        
        
    }
    
    
    public function init(){
        
        if(IS_POST){
            $post=I('post.');
            $admin_id=$post['admin_id'];
            $pwd=$post['admin_pwd'];
            $pwd2=$post['admin_pwd_2'];
            $app_name=$post['app_name'];
            
            
            if(!empty($app_name)){
                // 虹桥镇社区学校微信公众号
                $add['id']=1;
                $add['app_name']=$app_name;
                $result= M('config')->add($add,null,true);
            }else{
                $this->error('项目名没有填！','init/index',1);
                return;
            }
            
            
            if(empty($pwd) || empty($pwd2)|| empty($admin_id) ){
                $this->error('缺少必填项！','init/index',1);
                
            }else{
                if($pwd===$pwd2){
                    //=========添加数据=========
                    
                    $post['admin_pwd']=md5($pwd2.__KEY__);
                    
                    $model=M('admin');
                    //=========添加数据区
                    $add=[];
                    $add=$post;
                    $add['add_time']=time();
                    $add['edit_time']=time();
                    //=========sql区
                    $result=$model->add($add,null,true);
                    
                    if($result){
                        $this->success('初始化配置已完成！','Login/login',2);
                    }
                    
                    
                }else{
                    $this->error('两次输入的密码不一致','index',2);
                }
                
            }
            
        }
    }
    
    
    //空操作
    public function _empty(){
        
    }
    
}