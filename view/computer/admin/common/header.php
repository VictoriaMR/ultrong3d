<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?? '';?></title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="shortcut icon" href="/favicon.icon">
    <link rel="stylesheet" type="text/css" href="<?php echo staticUrl('computer/common', 'css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo staticUrl('computer/bootstrap', 'css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo staticUrl('computer/datepicker', 'css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo staticUrl('computer/font', 'css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo staticUrl('computer/icon', 'css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo staticUrl('computer/space', 'css');?>">
    <?php foreach (\frame\Html::getCss() as $value) { ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $value;?>">
    <?php }?>
    <script type="text/javascript" src="<?php echo staticUrl('common/jquery.min', 'js');?>"></script>
    <script type="text/javascript" src="<?php echo staticUrl('common/common', 'js');?>"></script>
    <?php foreach (\frame\Html::getJs() as $value) { ?>
    <script type="text/javascript" src="<?php echo $value;?>"></script>
    <?php }?>
</head>
<body>
<script type="text/javascript">
var URI = "<?php echo env('APP_DOMAIN');?>";
</script>