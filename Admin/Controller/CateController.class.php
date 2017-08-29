<?php
namespace Admin\Controller;
use Think\Controller;
class CateController extends Controller{
	public function catelist(){
	    //显示分类
	    $Cate = D('Cate');
 	    $cateList = $Cate->order('id asc')->select();
 	    //添加分类
	    if(IS_POST){
	        //模块字符串
	        $titstr = I('post.tits');
	        //转成数组
	        $titsData = explode("\n", $titstr);
	        //开启事务
	        $Cate->startTrans();
	        var_dump($titsData);
	        foreach ($titsData as $v){
	            $data['mname'] = $v;
	            //判断是否有空字符
	            //bug传过来的字符串，转化为数组后，空字符串室友长度的，证明是有一个空格
	            if($data['mname']){
	               $Cate->rollback();
	               $info = errorInfo(U('Admin/Cate/catelist'), 0,'标题名不能为空字符');
	               $this->redirect('Admin/Error/tips',$info);
	            }
	            if(!$Cate->add($data)){
	                //其中一个添加失败，所有的都添加失败
	                //事务回滚
	                $Cate->rollback();
	                $info = errorInfo(U('Admin/Cate/catelist'), 0,'操作失败');
	                $this->redirect('Admin/Error/tips',$info);
	            }
	        }
	        $Cate->commit();
	        $this->success('添加成功',U('admin/cate/catelist'),2);
	    }
	    $this->assign('catelist',$cateList);
		$this->display();
	}
	
	//修改分类信息
	public function cateedit(){
	    $id = I('get.id');
	    $Cate = D('Cate');
	    $cateInfo = $Cate->find($id);
	    if(IS_POST){
	        //获取修改的类型名
	        $data['mname'] = I('post.mname');
	       if(!$Cate->where('id='.$id)->save($data)){
	           $info = errorInfo(U('Admin/cate/catelist'), 0,'操作失败');
	           $this->redirect('Admin/Error/tips',$info);
	       }
	       $info = errorInfo(U('Admin/cate/catelist'), 1);
	       $this->redirect('Admin/Error/tips',$info);
	    }
	    $this->assign('cateinfo',$cateInfo);
		$this->display();
	}
	
	//删除分类
	public function del(){
	    $id = I('get.id');
	    $Cate = D('Cate');
	    //判断是否删除成功
	    if(!$Cate->delete($id)){
	        echo 'error';
	    }
	    echo 'success';
	}
}
