<?php
namespace Admin\Controller;
use Think\Controller;
class MessageController extends Controller {
    //显示留言
    public function message(){
        $Message = D('Message');
        $messList = $Message->select();
        $this->assign('messlist',$messList);
        $this->display();
    }
    
    //留言删除
    public function messageDel(){
        $id = I('get.id');
        $Mess = D('Message');
        if($Mess->delete($id)){
            echo 'success';
        }else{
            echo 'error';
        }
    }
}
