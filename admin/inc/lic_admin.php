<?php
header ( "Content-type:text/html;charset=utf-8" );
require("data.php");
include("function.php");
define('SYSTEM_NAME','AliSpider');
define('SITE_NAME','阿里蜘蛛池');

$config=config_list();
//系统首次使用,更新授权
if(empty($config['enddate'])&&$config['ver']&&$config['ver_date']) {
    //	授权验证,交给登录页
    $post_data['act'] = "shouquan";
    if ($request = request_post($post_data)) {
        if($request==='5pyq5o6I5p2D'){//未授权
            $sql="update config set enddate='".base64_encode(time())."',link=0 limit 1";
            $mysqli->query($sql);
            echo SITE_NAME."警告:此域名未授权,<a href='http://www.alizhizhuchi.top' target='_blank'>立即购买</a>";exit;
        }
        $result = json_decode($request);
        $sql = "update config set title='" . $result->title . "',vip='" . base64_encode($result->vip) . "',domain='" . base64_encode($result->domain) . "',templates='" . base64_encode($result->templates) . "',enddate='" . base64_encode($result->enddate) . "',date='" . base64_encode(mt_rand(strtotime(date('Y-m-d', strtotime("+1 day"))), strtotime(date('Y-m-d', strtotime("+2 day"))))) . "',link=0 limit 1";
        $mysqli->query($sql);
        $config=config_list();
    } else {
        echo "连接不到授权服务器,请检查网络";
        exit;
    }
}
if(empty($config['title'])||empty($config['enddate'])||empty($config['vip'])||empty($config['ver'])){
    echo SITE_NAME."警告:数据损坏,请联系客服人员,加群201356527";exit;
}
if($_SERVER['HTTP_HOST']!=$config['title']||time()>$config['enddate']){//如果过期
    echo "您未授权或已过期,请购买授权。<a href='http://www.alizhizhuchi.top' target='_blank'>立即购买</a>";exit;
}
?>