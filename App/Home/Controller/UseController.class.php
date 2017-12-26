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
        
        
        
        
        // $code=I('code');
        
        // $appid='wxf7a00ad5cbe5f514';
        // $secret='3d036697d1e220c8536fb2db312980fe';
        // $url= "https://api.weixin.qq.com/sns/jscode2session?appid=$appid&secret=$secret&js_code=$code&grant_type=authorization_code";
        
        
        $userTocken=    baseAuth();
        
        $openid=$userTocken['openid'];
        
        $userInfo=I('userInfo');
        
        if(gettype($userInfo)=='string'){
            $userInfo = htmlspecialchars_decode($userInfo);
            $userInfo = json_decode($userInfo,true);
        }
        
        $user_head=$userInfo['avatarUrl'];
        $user_name=$userInfo['nickName'];
        
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
        
        $user=$model->where($where)->select();
        
        //=========判断=========
        if($user){
            $res['res']=count($user);
            $res['msg']=$user;
        }else{
            $res['res']=-1;
            $res['msg']=$user;
        }
        //=========判断end=========
        //=========输出json=========
        echo json_encode($res);
        //=========输出json=========
        
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
        
        $result = $model->field('paper_title,paper_id,paper_info,paper_head,add_time')->where($where)->select();
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
        $super_id=I('super_id');
        
        $model=M('paper');
        $where=[];
        
        if($paper_id){
            $where['paper_id']=$paper_id;
        }else{
            $where['super_id']=$super_id;
        }
        
        $paper=$model->where($where)->find();
        $paper['add_time']=date('Y-m-d H:i:s', $paper['add_time']);
        
        $this->assign('paper',$paper);
        $this->display();
        
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
    
    
    
    /**
    * 统一上传接口
    * 上传单个文件
    */
    
    public function upFile(){
        
        if (IS_POST) {
            
            $file = $_FILES['file'];
            
            if (!$file['error']) {
                //定义配置
                
                $cfg = [];
                //默认是管理上传路径
                //如果传了路径就使用传来的路径
                if(empty(I('post.src'))){
                    //默认路径
                    $cfg['rootPath']=WORKING_PATH . __UPLOAD__ADMIN__;
                }else{
                    //传来的路径
                    
                    $cfg['rootPath']=WORKING_PATH .'/Public/Upload/wx/' ;
                    //创建目录
                    set_mkdir(WORKING_PATH .'/Public/Upload/wx/');
                    // $cfg['autoSub']=false;
                    // $cfg['hash']=false;
                    // $cfg['saveName']='';
                }
                
                if(!empty(I('post.del_src'))){
                    if(I('post.del_src')!==''){
                        
                        if(I('post.del_src')!=='/'){
                            //删除
                            $src=WORKING_PATH.'/'.I('post.del_src');
                            $state=delFile($src);
                        }
                        
                    }
                }
                
                $cfg['exts']=array('jpg', 'gif', 'png', 'jpeg');//设置附件上传类型
                
                //实例化上传类
                $upload = new \Think\Upload($cfg);
                //开始上传
                $info = $upload -> uploadOne($file);
                //判断是否上传成功
                if ($info) {
                    //图片地址
                    
                    $img_url = UPLOAD_ROOT_PATH . 'wx/' . $info['savepath'] . $info['savename'];
                    
                    $result['code'] = 0;
                    $result['msg'] = '成功';
                    $result['data'] = array();
                    $result['data']['src'] = $img_url;
                    
                } else {
                    $result['code'] = 'error';
                    $result['msg'] = '失败，上传错误';
                    $result['cfg'] = $cfg;
                }
                
            } else {
                $result['code'] = 'error';
                $result['msg'] = '失败，文件错误';
                $result['info'] = $file;
            }
            echo json_encode($result);
        } else {
            $url = U('Index/index');
            echo "<script>top.location.href='$url'</script>";
        }
    }
    
    //设置用户字段
    function saveUser(){
        
        if(IS_POST){
            
            
            //=========保存数据=========
            $model=M('user');
            //=========条件区
            $where=[];
            $where['openid']=I('openid');
            //=========保存数据区
            $save=I('save');
            $save['edit_time']=time();
            //=========sql区
            $result=$model->where($where)->save($save);
            //=========保存数据end=========
            //=========判断=========
            if($result!==false){
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
    
    //搜索
    public function queryPaper(){
        
        $key=I('key');
        
        $model=M('paper');
        $where=[];
        $where['paper_title'] =getLinkQuery($key);
        
        
        $paper=$model->field('paper_title,paper_id,paper_info,paper_head,add_time')->where($where)->select();
        
        //=========判断=========
        if($paper){
            $res['res']=count($paper);
            $res['msg']=$paper;
        }else{
            $res['res']=-1;
            $res['msg']=$paper;
        }
        //=========判断end=========
        
        //=========输出json=========
        echo json_encode($res);
        //=========输出json=========
        
    }
    
    //获得首页推荐的文章
    public function getPaperUp(){
        
        $model=M('paper');
        $result=$model->field('paper_title,paper_id,paper_info,paper_head,add_time')->order('add_time desc')->select();
        $arr=[];
        
        for ($i=0; $i < count($result); $i++) {
            
            if($i %3==0 && $i!==0){
                $_arr=[];
                $_arr[2]=$result[$i];
                $_arr[1]=$result[$i-1];
                $_arr[0]=$result[$i-2];
                $_arr= toTime( $_arr,'Y-m-d');
                $arr[]=$_arr;
            }
            
        }
        
        
        //=========判断=========
        if($arr){
            $res['res']=count($arr);
            $res['msg']=$arr;
        }else{
            $res['res']=-1;
            $res['msg']=$arr;
        }
        //=========判断end=========
        
        //=========输出json=========
        echo json_encode($res);
        //=========输出json=========`
        
    }
    
    public function myCode(){
        
        $openid = I('openid');
        
        $url = U("Use/link","openid=$openid",null,true);
        
        $this->assign('url',$url);
        $this->assign('openid',$openid);
        
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
}