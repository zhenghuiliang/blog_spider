<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Crypt\Driver\Think;
use Think\Verify;
class AdminController extends Controller{
    public function login(){
        if(IS_POST){
            $name = I('post.name');
            $password = md5(I('post.password'));
            $lasttime = time();
            $code = I('post.code');
            $admin = D('Admin');
            
            $Verify = new \Think\Verify();
            //验证验证码是否正确
            if(!$Verify->check($code)){
                //参数为地址类型会被浏览器过滤，此时对数据进行编码
                $url = base64_encode(U('Admin/admin/login'));
                $info =  array('url'=>$url,'state'=>'0','errorinfo'=>'验证码错误');//操作结果信息
                $this->redirect('Admin/error/tips',$info);
            }
            if(!$admin->where("name='$name' and password='$password'")->select()){
                $url = base64_encode(U('Admin/admin/login'));
                $info = array('url'=>$url,'state'=>'0','errorinfo'=>'用户名或则密码错误');
                $this->redirect('Admin/error/tips',$info);
            }
            //得到上次登入时间
            $lasttime = $admin->lasttime;
            //更新登入时间
            $data['lasttime'] = time();
            //将姓名存入session
            session('name',$name);
            $admin->where("name='$name'")->save($data);
            $this->redirect('Admin/index/index',array('lasttime'=>$lasttime));
        }
        $this->display();
    }
    //密码修改
    public function pass(){
        if(IS_POST){
            $data = I('post.');
            $name = session('name');
            $password = md5($data['mpass']);
            $Admin = D('Admin');
            if(!$Admin->where("name='$name' and password='$password'")->select()){
                //操作结果信息
                $info = errorInfo(U('Admin/admin/pass'), '1','密码错误');
                $this->redirect('Admin/Error/tips',$info);
                
            }
            //需要更改的数值
            $data1['password'] = md5($data['newpass']); 
            if(!$Admin->where("name='$name'")->save($data1)){
                $info = errorInfo(U('Admin/'), 0, '操作失败');
                $this->redirect('Admin/Error/tips',$info);    
            }
            $info = errorInfo(U('Admin/admin/login'), '1');
            $this->redirect('Admin/Error/tips',$info);
        }
        
        $this->display();
    }
    
    public function loginOut(){
        session(null);
        $this->redirect('Admin/admin/login');
    }
    //生成验证码
    public function verify(){
        $ver = new \Think\Verify();
        $ver->fotSize = 25;
        $ver->imageW = 0; 
        $ver->imageH = 0;
        $ver->length = 4;
        $ver->entry();
    }
}