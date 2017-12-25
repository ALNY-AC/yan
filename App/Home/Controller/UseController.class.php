<?php
/**
* +----------------------------------------------------------------------
* 创建日期：2017年12月23日16:56:46
* 最新修改时间：2017年12月23日16:56:46
* +----------------------------------------------------------------------
* https：//github.com/ALNY-AC
* +----------------------------------------------------------------------
* 微信：AJS0314
* +----------------------------------------------------------------------
* QQ:1173197065
* +----------------------------------------------------------------------
* #####通用控制器(权限限制版）#####
* @author 代码狮
*
*/
namespace Home\Controller;
use Think\Controller;
class UseController extends CommonController{
    
    
    
    public function login(){
        
        $openid=I('openid');
        $user_head=I('user_head');
        $user_name=I('user_name');
        
        $model=M('user');
        $where=[];
        $where['openid']=$openid;
        $user=$model->where($where)->find();
        
        
        if($user===null){
            //没有用户
            
            //=========添加数据区
            $add=[];
            $add['user_id']=$openid;
            $add['openid']=$openid;
            $add['user_head']=$user_head;
            $add['user_name']=$user_name;
            $add['add_time']=time();
            $add['edit_time']=time();
            //=========sql区
            $user=$model->add($add);
            
        }
        
        //=========判断=========
        if($user){
            $res['res']=1;
            $res['msg']=$user;
        }else{
            $res['res']=-1;
            $res['msg']=$user;
        }
        //=========判断end=========
        
        
    }
    
    
    //通用取
    public function get(){
        
        $debug=I('debug');
        
        //获得表名
        $table=I('table');
        $where=I('where')?I('where'):[];
        if(gettype($where)=='string'){
            $where = htmlspecialchars_decode($where);
            $where = json_decode($where,true);
        }
        
        
        if(empty($table))die;
        
        //权限处理
        //禁止访问的表
        $arr = array(
        'admin',
        // 'user',
        'config',
        'feedback',
        'follow',
        );
        
        if(in_array($table,$arr)){
            //当访问的表出现在禁止访问的表中：
            echo -1;
            exit;
        }
        
        $table = strtolower($table);
        $model=M($table);
        $result=$model->where($where)->order('add_time desc')->select();
        
        //时间转换
        $result=toTime($result,'Y-m-d');
        
        
        //=========判断=========
        if($result){
            $res['res']=count($result);
            $res['msg']=$result;
        }else{
            $res['res']=-1;
            $res['msg']=$result;
        }
        //=========判断end=========
        
        
        if($debug=='true'){
            dump($res);
        }else{
            echo json_encode($res);
        }
        
    }
    
    //获得文章
    public function getPaper(){
        
        $debug=I('debug');
        
        $super_id=I('super_id');
        $paper_type=I('paper_type');
        
        $model=M('paper');
        
        $where=[];
        
        if($super_id){
            
            $where['super_id']=$super_id;
            $url= U('showPaper','paper_id='.$result[0]['paper_id'],null,true);
            
        }
        if($paper_type){
            $where['paper_type']=$paper_type;
        }
        
        $result = $model->where($where)->select();
        //时间转换
        $result=toTime($result,'Y-m-d');
        
        
        
        //=========判断=========
        if($result){
            $res['res']=count($result);
            $res['msg']=$result;
        }else{
            $res['res']=-1;
            $res['msg']=$result;
        }
        //=========判断end=========
        
        
        if($debug=='true'){
            dump($res);
            $url= U('showPaper','paper_id='.$result[0]['paper_id'],null,true);
            echo "<a style='color:#eee;' target='_blank' href='$url'>点击查看文章</a>";
        }else{
            echo json_encode($res);
        }
        
    }
    //显示文章
    public function showPaper(){
        $paper_id=I('paper_id');
        
        $model=M('paper');
        $where=[];
        $where['paper_id']=$paper_id;
        $paper=$model->where($where)->find();
        
        $this->assign('paper',$paper);
        
        
        $this->display();
        
    }
    
    //关注某人（成为谁谁谁的下线）
    public function link(){
        
        $openid=I('openid');//这个是想关注的用户的id
        $openid_m=I('openid_m');//这个是自己的id
        
        //=========添加数据=========
        $model=M('link');
        //=========添加数据区
        $add=[];
        $add['follow_id']=md5('follow'.__KEY__.rand());//id
        $add['openid']=$openid;//想要关注用户的id
        $add['openid_m']=$openid_m;//自己的id
        $add['add_time']=time();
        $add['edit_time']=time();
        //=========sql区
        $result=$model->add($add);
        //=========判断=========
        if($result){
            $res['res']=1;
        }else{
            $res['res']=-1;
            $res['msg']=$result;
        }
        //=========判断end=========
        
        //=========输出json=========
        echo json_encode($res);
        //=========输出json=========
        
    }
    
    //获得自己的粉丝列表（下线列表）
    public function linkList(){
        
        //获得自己的粉丝列表
        $openid=I('openid');
        $model=M('link');
        $where=[];
        $where['openid']=$openid;
        $link=$model->where($where)->order('add_time desc')->select();
        
        //=========判断=========
        if($link){
            $res['res']=count($link);
            $res['msg']=$link;
        }else{
            $res['res']=-1;
            $res['msg']=$link;
        }
        //=========判断end=========
        
        
        //=========输出json=========
        echo json_encode($res);
        //=========输出json=========
        
    }
    
}