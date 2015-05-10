<?php
/**
 * Created by PhpStorm.
 * User: NimitzDEV
 * Date: 2015/5/9 0009
 * Time: 13:11
 */
include 'pq.php';
/*GET PARAMS*/
$site_url = $_GET['target'];
$path = str_replace('id->','#',$_GET['path']) ;
$replacer = $_GET['replacer'];
$cat = $_GET['cat'];
$title = $_GET['title'];
$rm = str_replace('id->','#',$_GET['rm']);
$rc = str_replace('id->','#',$_GET['rc']);
/*参数判断*/
if($site_url == '' || $path == '' || $cat == '') die('参数不完整');
if($title == '') $title = '无标题';
$html = phpQuery::newDocumentFile($site_url);
/*数组*/
$path_array = explode('|||',$path);
$cat_array = explode('|||',$cat);
/*文档处理*/
/*RUN REPLACER*/
if($replacer != ''){
    $replacer_array = explode('|||',$replacer);
    for($i = 0;$i < count($replacer_array);$i++) {
        $replacer_data = explode('||',$replacer_array[$i]);
        $html = str_replace($replacer_data[0],$replacer_data[1],$html);
    }
}
/*RUN REMOVER*/
if($rm != ''){
    $rm_array = explode('|||',$rm);
    for($i = 0;$i < count($rm_array);$i++){
        $html -> find($rm_array[$i]) -> remove();
    }
}
/*RUN CLASS-REMOVER*/
if($rc != ''){
    $rc_array = explode('|||',$rc);
    for($i = 0;$i < count($rc_array);$i++){
        $rc_data = explode('||',$rc_array[$i]);
        $html -> find($rc_data[0]) -> removeClass($rc_data[1]);
    }
}
?>

<!doctype html>
<!--OBLINE TRANSCODERER POWERED BY NIMITZDEV （NIMITZDEV.ORG）-->
<!--CURRENT VERSION 0.2.1 (2015-05-10)-->
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title ?></title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="assets/css/amazeui.min.css">
    <link rel="stylesheet" href="assets/css/app.css">
</head>
<body>
<!-- Header -->
<header data-am-widget="header" class="am-header am-header-default">
    <h1 class="am-header-title" style="margin: 0 0 0 0;">
        <a><?php echo $title ?></a>
    </h1>
</header>
<!--LIST-->
<div data-am-widget="list_news" class="am-list-news am-list-news-default">
    <?php
        for($i = 0;$i < count($path_array);$i++) {
            /*OUT PUT HEADER*/
            echo '<div class="am-list-news-hd am-cf"><a><h2>';echo $cat_array[$i];echo '</h2></a></div>';
            /*OUT PUT DATA*/
            echo '<div class="am-list-news-bd">';
            echo $html -> find($path_array[$i]) -> html();
            echo '</div>';
        }
    ?>
</div>
</body>
