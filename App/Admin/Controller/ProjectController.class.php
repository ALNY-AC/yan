<?php
/**
* +----------------------------------------------------------------------
* 创建日期：2017年12月22日14:37:24
* 最新修改时间：2017年12月22日14:37:24
* +----------------------------------------------------------------------
* https：//github.com/ALNY-AC
* +----------------------------------------------------------------------
* 微信：AJS0314
* +----------------------------------------------------------------------
* QQ:1173197065
* +----------------------------------------------------------------------
* #####项目控制器#####
* @author 代码狮
*
*/
namespace Admin\Controller;
use Think\Controller;
class ProjectController extends CommonController{
    
    public function showList(){
        
        
        $type=I('get.type');
        $super_id=I("get.".$type."_id");
        
        
        $isTable = M()->query("SHOW TABLES LIKE 'y_$type'");
        if( $isTable ){
            //存在
            $model=M($type);
            $where=[];
            $where[$type.'_id']=$super_id;
            $super=$model->where($where)->find();
            $type_title=$super[$type.'_title'];
            
            
        }else{
            //不存在
            
            $type_title=I('get.type_title');
            $super_id=$type;
            
            
        }
        
        
        $this->assign('type_title',$type_title);
        $this->assign('super_id',$super_id);
        $this->assign('type',$type);
        $this->display();
    }
    
    public function add(){
        
        $type=I('get.type');
        $super_id=I('get.super_id');
        $this->assign('type',$type);
        $this->assign('super_id',$super_id);
        
        $this->display();
    }
    
    public function edit(){
        
        $project_id=I('get.project_id');
        
        $model=M('project');
        $where=[];
        $where['project_id']=$project_id;
        $project=$model->where($where)->find();
        
        $this->assign('project',$project);
        
        $this->display();
    }
    
}