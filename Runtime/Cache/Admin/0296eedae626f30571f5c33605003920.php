<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="renderer" content="webkit">
<title></title>
<link rel="stylesheet" href="/Public/admin/css/pintuer.css">
<link rel="stylesheet" href="/Public/admin/css/admin.css">
<script src="/Public/admin/js/jquery.js"></script>
<script src="/Public/admin/js/pintuer.js"></script>
</head>
<body>
<div class="panel admin-panel">
  <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong></div>
  <div class="padding border-bottom">
    <button type="button" class="button border-yellow" onclick="window.location.href='#add'"><span class="icon-plus-square-o"></span> 添加分类</button>
  </div>
  <table class="table table-hover text-center">
    <tr>
      <th width="5%">ID</th>
      <th width="15%">分类名称</th>
      <th width="10%">操作</th>
    </tr>
    <?php if(is_array($catelist)): foreach($catelist as $key=>$cateinfo): ?><tr>
      <td><?php echo ($cateinfo[id]); ?></td>
      <td><?php echo ($cateinfo[mname]); ?></td>
      <td><div class="button-group"> <a class="button border-main" href="<?php echo U('Admin/cate/cateedit',array('id'=>$cateinfo[id]));?>"><span class="icon-edit"></span> 修改</a> <a class="button border-red" href="javascript:void(0)" onclick="return del(<?php echo ($cateinfo[id]); ?>)"><span class="icon-trash-o"></span> 删除</a> </div></td>
    </tr><?php endforeach; endif; ?>
  </table>
</div>
<div class="panel admin-panel margin-top">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>添加内容</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="<?php echo U('Admin/cate/catelist');?>">
      <div class="form-group">
        <div class="label">
          <label>批量添加：</label>
        </div>
        <div class="field">
          <textarea type="text" class="input w50" name="tits" style="height:150px;" placeholder="多个分类标题请转行"></textarea>
          <div class="tips">多个分类标题请转行</div>
          <div class="tips"><span id="error"></span></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body>
<script>
function del(cid){
	if(confirm("您确定要删除吗?")){
		var parm = {
			type:'get',
			data:{id:cid},
			success:function(msg){
				if('success'==msg){
					//删除节点
					$("td:contains("+cid+")").parent().remove();
				}else{
					alert('删除失败');
				}
			}
		};
		$.ajax("<?php echo U('Admin/cate/del');?>",parm);
	} 
}
$('textarea').blur(function(){
	//用val()获取值更靠谱，$('textarea').html()获取不到输入的值
	if(''==$('textarea').val()){
		$('#error').html("<font color='red'>添加信息不能为空</font>");
	}else{
		$('#error').html('');
	}
});
</script>
</html>