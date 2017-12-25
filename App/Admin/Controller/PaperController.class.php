<?php
/**
* +----------------------------------------------------------------------
* 创建日期：2017年12月23日12:04:45
* 最新修改时间：2017年12月23日12:04:45
* +----------------------------------------------------------------------
* https：//github.com/ALNY-AC
* +----------------------------------------------------------------------
* 微信：AJS0314
* +----------------------------------------------------------------------
* QQ:1173197065
* +----------------------------------------------------------------------
* #####文章控制器#####
* @author 代码狮
*
*/
namespace Admin\Controller;
use Think\Controller;
class PaperController extends CommonController{
    
    //编辑
    public function edit(){
        
        
        
        $type =   I('get.type');
        $super_id=   I('get.super_id');
        
        $paper_id=   I('get.paper_id');
        
        
        
        $paper_model=M('paper');
        $paper=null;
        $where=[];
        
        if(!empty($super_id)){
            //有，通过父id查找
            //模型
            $where['super_id']=$super_id;
            $paper=$paper_model->where($where)->find();
            //模型end
        }
        
        if(!empty($paper_id)){
            //有，通过本id查找
            //模型
            $where['paper_id']=$paper_id;
            $paper=$paper_model->where($where)->find();
            //模型end
        }
        
        
        if($paper===null){
            //没有数据，创建一个
            
            //=========添加数据=========
            //=========添加数据区
            $add=[];
            $add['paper_id']=md5('paper'.time().__KEY__.rand());
            $add['super_id']=$super_id;
            $add['paper_title']='【请修改标题】';
            $add['paper_type']=$type;
            $add['add_time']=time();
            $add['edit_time']=time();
            //=========sql区
            $result=$paper_model->add($add);
            
            
            //创建完毕
            if($result){
                
                //完成后跳转
                $url=U('','paper_id='. $add['paper_id']);
                echo "<script>top.location.href='$url'</script>";
                
                return;
                // $where=[];
                // $where['paper_id']= $add['paper_id'];
                // $paper=$paper_model->where($where)->find();
                
            }
            
        }
        
        
        $this->assign('paper',$paper);
        $this->display();
        
    }
    
    public function show(){
        $paper_id=   I('get.paper_id');
        
        $paper_model=M('paper');
        $where=[];
        $where['paper_id']=$paper_id;
        $paper=$paper_model->where($where)->find();
        
        $paper['add_time']=date('Y-m-d H:i:s',$paper['add_time']);
        $paper['eidt_time']=date('Y-m-d H:i:s',$paper['eidt_time']);
        
        
        $this->assign('paper',$paper);
        $this->display();
    }
    
    
}