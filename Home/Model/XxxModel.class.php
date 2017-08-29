<?php
namespace Home\Model;
use Think\Model;

class XxxModel extends Model{
    public function papa(){
            $arr = array('name'=>'123','age'=>'123455','xb'=>'女');
            $a = $this->add($arr);
            return $a;
    }
}
