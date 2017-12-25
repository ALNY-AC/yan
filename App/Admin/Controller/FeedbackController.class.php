<?php
/**
* +----------------------------------------------------------------------
* 创建日期：2017年12月23日15:50:06
* 最新修改时间：2017年12月23日15:50:06
* +----------------------------------------------------------------------
* https：//github.com/ALNY-AC
* +----------------------------------------------------------------------
* 微信：AJS0314
* +----------------------------------------------------------------------
* QQ:1173197065
* +----------------------------------------------------------------------
* #####意见反馈控制器#####
* @author 代码狮
*
*/
namespace Admin\Controller;
use Think\Controller;
class FeedbackController extends CommonController{
    
    
    public function showList(){
        
        $this->display();
    }
    
    public function show(){
        
        
        
        $feedback_id=I('get.feedback_id');
        
        $model=M('feedback');
        $where=[];
        $where['feedback_id']=$feedback_id;
        $feedback=$model->where($where)->find();
        $feedback['add_time']=date('Y-m-d H:i:s',$feedback['add_time']);
        $this->assign('feedback',$feedback);
        
        
        
        $this->display();
    }
    
    
}