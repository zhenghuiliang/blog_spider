<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Crypt\Driver\Think;
use Think\Verify;
class ErrorController extends Controller{
    public function tips(){
        
        $url = I('get.url');//跳转的url
        $url = base64_decode($url);//解析url;
        $state = I('get.state');//操作的状态，是否成功；
        $errorInfo = I('get.errorinfo');//错误信息；
        
        $this->assign('url',$url);
        $this->assign('state',$state);
        $this->assign('errorinfo',$errorInfo);
        $this->display();
    }
}