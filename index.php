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
$rm = $_GET['rm'];
$rc = $_GET['rc'];
/*参数判断*/
if($site_url == '' || $path == '' || $cat == '') die('参数不完整');
if($title == '') $title = '无标题';
$html = phpQuery::newDocumentFile($site_url);
/*数组*/
$div_path = explode('|||',$path);
$div_cat = explode('|||',$cat);
/*文档处理*/
/*RUN REPLACER*/
if($replacer != ''){
    $div_replacer = explode('|||',$replacer);
    for($i = 0;$i < count($div_replacer);$i++) {
        $div_div_replacedata = explode('||',$div_replacer[$i]);
        $html = str_replace($div_div_replacedata[0],$div_div_replacedata[1],$html);
    }
}
/*RUN REMOVER*/
if($rm != ''){
    $div_rm = explode('|||',$rm);
    for($i = 0;$i < count($div_rm);$i++){
        $html -> find($div_rm[$i]) -> remove();
    }
}
/*RUN CLASS-REMOVER*/
if($rc != ''){
    $div_rc = explode('|||',$rc);
    for($i = 0;$i < count($div_rc);$i++){
        $div_div_rc = explode('||',$div_rc[$i]);
        $html -> find($div_div_rc[0]) -> removeClass($div_div_rc[1]);
    }
}
?>

<!doctype html>
<!--OBLINE TRANSCODERER POWERED BY NIMITZDEV （NIMITZDEV.ORG）-->
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
        for($i = 0;$i < count($div_path);$i++) {
            /*OUT PUT HEADER*/
            echo '<div class="am-list-news-hd am-cf"><a><h2>';echo $div_cat[$i];echo '</h2></a></div>';
            /*OUT PUT DATA*/
            echo '<div class="am-list-news-bd">';
            echo $html -> find($div_path[$i]) -> html();
            echo '</div>';
        }
    ?>
</div>
</body>
