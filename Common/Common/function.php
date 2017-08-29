<?php
//返回操作处理信息
function errorInfo($url,$state,$error=''){
    $url = base64_encode($url);//url为参数是会被过滤，对一个url参数进行编码
    $info = array('url'=>$url,'state'=>$state,'errorinfo'=>$error);
    return $info;
}