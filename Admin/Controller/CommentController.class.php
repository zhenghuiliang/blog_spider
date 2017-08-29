<?php
namespace Admin\Controller;
use Think\Controller;
class CommentController extends Controller {
    //评论显示
    public function comment(){
        $Comment = D('Comment');
        $commentList = $Comment->select();
        $this->assign('commentlist',$commentList);
        $this->display();
    }
    
    //评论删除
    public function commentDel(){
        $id = I('get.id');
        $Com = D('Comment');
        if($Com->delete($id)){
            echo 'success';
        }else{
            echo 'error';
        }
    }
}
