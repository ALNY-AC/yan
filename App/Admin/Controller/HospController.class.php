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
* #####医院控制器#####
* @author 代码狮
*
*/
namespace Admin\Controller;
use Think\Controller;
class HospController extends CommonController{
    
    public function showList(){
        $this->display();
    }
    
    public function add(){
        $this->display();
    }
    
    public function edit(){
        
        $hosp_id=I('get.hosp_id');
        
        $model=M('hosp');
        $where=[];
        $where['hosp_id']=$hosp_id;
        $hosp=$model->where($where)->find();
        
        $this->assign('hosp',$hosp);
        
        $this->display();
    }
    
}