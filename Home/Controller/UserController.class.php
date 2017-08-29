<?php
namespace Home\Controller;
use Think\Controller;

class UserController extends Controller{
    public function add(){

        $a = 123;
        $this->assign('a',$a);
        $this->display();
    }

    public function ff(){
        $get = I('get.ids');
        $gets = I('post.id');
        echo $get.$gets;exit;
        $a = new \Home\Model\XxxModel();
        //过程化风格
        // $d = $a->add(['name'=>'叶嫂','age'=>102,'xb'=>'金星']);
        // 面向对象
        $a->name = 'yesao';
        $a->age = '22';
        $a->xb = '兽';
        $a->add();
    }


    public function cha(){
        $xxxModel = D('Xxx');
        var_dump($xxxModel->field('id,name,age')->where('id<6')->order('id desc')->limit(2,3)->select());
    }

    public function up(){
        $xxxModel = D('Xxx');
        $arr = array('name'=>'suibian');
        $a = $xxxModel->where('id<6')->save($arr);
        echo $a;
    }

    public function de(){
        $xxxModel = D('Xxx');
        // $xxxModel->delete('1');
        $a = $xxxModel->where('id<4')->delete();
        echo $a;
    }

}
