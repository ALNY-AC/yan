<?php
/**
* +----------------------------------------------------------------------
* 创建日期：2017年12月7日
* 最新修改时间：2017年12月7日
* +----------------------------------------------------------------------
* https：//github.com/ALNY-AC
* +----------------------------------------------------------------------
* 微信：AJS0314
* +----------------------------------------------------------------------
* QQ:1173197065
* +----------------------------------------------------------------------
* #####配置控制器#####
* @author 代码狮
*/
namespace Admin\Controller;
use Think\Controller;
class ConfigController extends CommonController{
    
    public function showList(){
        $this->display();
    }
    
    /**
    * 带条件的查询
    */
    public function getList(){
        
        $get = I('get.');
        $table = strtolower($get['table']);
        //创建模型
        $model = M($table);
        
        //定制分页-start
        $page=$get['page'];
        $limit=$get['limit'];
        $page=($page-1)* $limit;
        //定制分页-end
        
        $order=$get['order']?$get['order']:'add_time desc';
        
        if(!empty($get['key'])){
            
            $key=$get['key'];
            
            $where['admin_id'] = array(
            'like',
            "%".$key."%",
            'OR'
            );
            
            $result= $model->limit("$page,$limit")->order($order)->where($where)->select();
            // $res['sql']=$model->_sql();
            $res['count']=$model->where($where)->count();
            
        }else{
            
            $count= $model->count();
            $res['count']=$count;
            $result= $model->limit("$page,$limit")->order($order)->select();
            $res['sql']=$model->_sql();
            
        }
        
        //转换时间戳
        $result=   toTime($result);
        
        foreach ($result as $key => $value) {
            $admin_id=session('admin_id');
            
            if($admin_id!='root'){
                //不是root账户
                
                if($value['admin_id']=='root'){
                    //当有root的时候，删除这个
                    unset($result[$key]);
                }
            }
            
        }
        
        if($result){
            $res['res']= $res['count'];
            $res['code']=1;
            $res['data']= $result;
            $res['msg']= $result;
        }else{
            $res['code']=-1;
            $res['msg']='没有数据！';
        }
        echo json_encode($res);
        
        
        
    }
    public function add(){
        
        $admin_id=I('post.admin_id');
        $admin_pwd=I('post.admin_pwd');
        $admin_pwd =md5($admin_pwd.__KEY__);
        
        //=========添加数据=========
        $model=M('admin');
        //=========添加数据区
        $add=[];
        $add['admin_id']=$admin_id;
        $add['admin_name']=$admin_id;
        $add['admin_head_img']='/Public/Upload/admin/head_img/h5.jpg';
        $add['admin_pwd']=$admin_pwd;
        $add['add_time']=time();
        $add['edit_time']=time();
        //=========sql区
        $result=$model->add($add);
        //=========判断=========
        if($result){
            $res['res']=$result;
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
    
    public function edit(){
        $admin_id=I('post.admin_id');
        $admin_pwd=I('post.admin_pwd');
        $admin_pwd =md5($admin_pwd.__KEY__);
        
        $where=[];
        $where['admin_id']=$admin_id;
        
        //=========添加数据=========
        $model=M('admin');
        //=========添加数据区
        $save=[];
        $save['admin_pwd']=$admin_pwd;
        //=========sql区
        $result=$model->where($where)->save($save);
        //=========判断=========
        if($result){
            $res['res']=$result;
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
    
    
    public function user(){
        $this->display();
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
    
    public function saveName(){
        $post=I('post.');
        $admin_id=$post['admin_id'];
        $admin_name=$post['admin_name'];
        
        //=========保存数据=========
        $model=M('admin');
        //=========条件区
        $where=[];
        $where['admin_id']=$admin_id;
        //=========保存数据区
        $save=[];
        $save['admin_name']=$admin_name;
        $save['edit_time']=time();
        //=========sql区
        $result=$model->where($where)->save($save);
        //=========保存数据end=========
        //=========判断=========
        if($result){
            
            session('admin_name',$admin_name);
            $res['res']=$result;
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
    
    public function saveHeadImg(){
        
        $post=I('post.');
        $admin_id=$post['admin_id'];
        $admin_head_img=$post['admin_head_img'];
        
        //=========保存数据=========
        $model=M('admin');
        //=========条件区
        $where=[];
        $where['admin_id']=$admin_id;
        //=========保存数据区
        $save=[];
        $save['admin_head_img']=$admin_head_img;
        $save['edit_time']=time();
        //=========sql区
        $result=$model->where($where)->save($save);
        //=========保存数据end=========
        //=========判断=========
        if($result){
            
            session('admin_head_img',$admin_head_img);
            $res['res']=$result;
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