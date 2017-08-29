<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
        </title>
        <!-- <link rel="stylesheet" type="text/css" href="/shop/Public/a/xiaoye.css" />
        <script type="text/javascript" src="/shop/Public/daye.js"></script> -->

        <script type="text/javascript" src="/shop/Public/daye.js"></script>
    </head>

    <body>
        <!-- <h1>
            <?php echo ($ff?'卡三等奖':'00000'); ?>
            <br>
            <?php if($ff == 5): echo ($ff); ?>
                <?php else: ?> <?php echo ($ff); ?>000<?php endif; ?>
        </h1> -->
        <?php if(is_array($ff)): foreach($ff as $key=>$v): echo ($v["title"]); ?><br><?php endforeach; endif; ?>
    </body>
</html>