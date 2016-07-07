<?php
function randKey($len)
{
    $chars = array( "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9" );
    $charsLen = count($chars) - 1;
    shuffle($chars);
    $str = "";
    for ($i=0;$i<$len;$i++)
    {
        $str .= $chars[mt_rand(0, $charsLen)];
    }
    return $str;
}
function randName(){
    $chars = array( "道", "帝", "乙", "王", "董", "卓", "建", "华", "丁", "辛", "邓", "平", "侯", "石", "公", "杜", "海", "陵", "龙", "宗", "北", "秉", "扁", "伯", "通", "戏", "成", "文", "马", "徒", "安", "开", "安", "纯", "密", "顺" );
    $charsLen = count($chars) - 1;
    shuffle($chars);
    $str = "";
    $len=rand(2,4);
    for ($i=0;$i<$len;$i++)
    {
        $str .= $chars[mt_rand(0, $charsLen)];
    }
    return $str;
}
function rdomain( $d )
{
    $provace = array( );
    return str_replace( "*", dechex( date( "s" ).mt_rand( 1111, 9999 ) ).$provace[rarray_rand( $provace )], $d );
}
function rarray_rand( $arr )
{
    return mt_rand( 0, count( $arr ) - 1 );
}
function varray_rand( $arr )
{
    return $arr[rarray_rand($arr)];
}
function get_folder_files($dir)
{
    if(is_dir($dir))
    {
        if ($dh = opendir($dir))
        {
            while (($file = readdir($dh)) !== false)
            {
                if($file!="." && $file!="..")
                {
                    $arr_file[]=$file;
                }
            }
            closedir($dh);
            return $arr_file;
        }
    }
}
function getdomain($url)
{
    $host = strtolower ( $url );
    if (strpos ( $host, '/' ) !== false)
    {
        $parse = @parse_url ( $host );
        $host = $parse ['host'];
    }
    $topleveldomaindb = array ('gov.cn', 'com.cn', 'net.cn', 'org.cn', 'com', 'cn', 'asia', 'edu', 'gov', 'ga', 'net', 'org', 'biz', 'info', 'pw', 'name', 'mobi', 'cc', 'hk' );
    $str = '';
    foreach ( $topleveldomaindb as $v )
    {
        $str .= ($str ? '|' : '') . $v;
    }
    $matchstr = "[^\.]+\.(?:(" . $str . ")|\w{2}|((" . $str . ")\.\w{2}))$";
    if (preg_match ( "/" . $matchstr . "/ies", $host, $matchs ))
    {
        $domain = $matchs ['0'];
    }
    else
    {
        $domain = $host;
    }
    return $domain;
}
function nowtime()
{
    $date=date("Y-m-d.G:i:s");
    return $date;
}
function get_naps_bot()
{
    global $mysqli;
    $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
    $sql="select * from spiderset where ok=1 order by id asc";
    $result=$mysqli->query($sql);
    while($row=$result->fetch_assoc()){
        if (stripos($useragent, $row['age']) !== false){
            return $row['title'];
        }
    }
    return false;
}
function moban($moban){
    global $mysqli;

    $image_list = get_folder_files(DIR . '/pics/');
    $duankou=$_SERVER["SERVER_PORT"];
    $yuming=$_SERVER['HTTP_HOST'];
    $yuming=str_replace(':'.$duankou, '', $yuming);
    $yumi=getdomain ( $yuming );
    $shipin = count(explode('<随机视频>', $moban)) - 1;

    for ($sp=0; $sp<$shipin; $sp++)
    {
        $shipin = $mysqli->query("SELECT title FROM shipin order by rand() limit 1")->fetch_object()->title;
        $moban = preg_replace('/<随机视频>/', trim($shipin), $moban, 1);
    }
    $keyword=$mysqli->query("select title from keywords order by rand() limit 1")->fetch_object()->title;
    $moban = str_replace( "<主关键词>", $keyword, $moban );
    //外推链接
    $result=$mysqli->query("select * from url order by rand() limit 1");
    $row=$result->fetch_assoc();
    $moban = str_replace( "<外推链接>", $row['title'], $moban );
    $mysqli->query("update url set count=count+1 where id=".$row['id']);
    //随机关键词
    $wk = count(explode('<随机关键词>', $moban)) - 1;
    $result=$mysqli->query("select title from keywords order by rand() limit $wk");
    while($row=$result->fetch_assoc()){
        $moban = preg_replace('/<随机关键词>/', trim($row['title']), $moban, 1);
    }
    $wk = count(explode('<句子>', $moban)) - 1;
    $result=$mysqli->query("select title from juzi order by rand() limit $wk");
    while($row=$result->fetch_assoc()){
        $moban = preg_replace('/<句子>/', trim($row['title']), $moban, 1);
    }
    $dk = count(explode('<随机端口>', $moban)) - 1;
    for ($di=0; $di<$dk; $di++)
    {
        $moban = preg_replace('/<随机端口>/', rand(100,20000), $moban, 1);
    }
//    $vi = count( explode( "<随机外链>", $moban ) ) - 1;
//    for ($li=0; $li<$vi; $li++)
//    {
//        $domains=$mysqli->query("select title from domains order by rand() limit 1")->fetch_object()->title;
//        $moban = preg_replace('/<随机外链>/', $domains, $moban, 1);
//    }
    $zf1 = count(explode('<随机字符>', $moban)) - 1;
    for ($ii=0; $ii<$zf1; $ii++)
    {
        $moban = preg_replace('/<随机字符>/', randKey(5), $moban, 1);
    }
    $ri5 = count(explode('<随机数字>', $moban)) - 1;
    for ($i=0; $i<$ri5; $i++)
    {
        $moban = preg_replace('/<随机数字>/', mt_rand(10000, 99999), $moban, 1);
    }
    $moban = str_replace( "<当前域名>", $yuming, $moban );
    $moban = str_replace( "<顶级域名>", $yumi, $moban );
    //$moban = str_replace( "<当前域名1>", $_SERVER['HTTP_HOST'], $moban );
    $tupian5 = count(explode('<随机图片>', $moban)) - 1;
    for ($tui=0; $tui<$tupian5; $tui++)
    {
        $moban = preg_replace('/<随机图片>/', '/pics/' . varray_rand ( $image_list ), $moban, 1);
    }
    $moban = str_replace( "<年>", date( "y" ), $moban );
    $moban = str_replace( "<发布时间>", date( "m-d" ), $moban );
    for($i=1;$i<30;$i++){
        $moban = str_replace( "<发布时间$i>", date( "m-d",strtotime("-$i day")), $moban );
    }

//    $moban = str_replace( "<发布时间2>", date( "m-d",strtotime("-2 day")), $moban );
//    $moban = str_replace( "<发布时间3>", date( "m-d",strtotime("-3 day")), $moban );
//    $moban = str_replace( "<发布时间4>", date( "m-d",strtotime("-4 day")), $moban );
//    $moban = str_replace( "<发布时间5>", date( "m-d",strtotime("-5 day")), $moban );
//    $moban = str_replace( "<发布时间6>", date( "m-d",strtotime("-6 day")), $moban );
//    $moban = str_replace( "<发布时间7>", date( "m-d",strtotime("-7 day")), $moban );
//    $moban = str_replace( "<发布时间8>", date( "m-d",strtotime("-8 day")), $moban );
//    $moban = str_replace( "<发布时间9>", date( "m-d",strtotime("-9 day")), $moban );
//    $moban = str_replace( "<发布时间10>", date( "m-d",strtotime("-10 day")), $moban );
//    $moban = str_replace( "<发布时间11>", date( "m-d",strtotime("-11 day")), $moban );
//    $moban = str_replace( "<发布时间12>", date( "m-d",strtotime("-12 day")), $moban );
//    $moban = str_replace( "<发布时间13>", date( "m-d",strtotime("-13 day")), $moban );
//    $moban = str_replace( "<发布时间14>", date( "m-d",strtotime("-14 day")), $moban );
//    $moban = str_replace( "<发布时间15>", date( "m-d",strtotime("-15 day")), $moban );
//    $moban = str_replace( "<发布时间16>", date( "m-d",strtotime("-16 day")), $moban );
//    $moban = str_replace( "<发布时间17>", date( "m-d",strtotime("-17 day")), $moban );
//    $moban = str_replace( "<发布时间18>", date( "m-d",strtotime("-18 day")), $moban );
//    $moban = str_replace( "<发布时间19>", date( "m-d",strtotime("-19 day")), $moban );
//    $moban = str_replace( "<发布时间20>", date( "m-d",strtotime("-20 day")), $moban );
//    $zf1 = count(explode('<动态随机字符>', $moban)) - 1;
//    for ($ii=0; $ii<$zf1; $ii++)
//    {
//        $moban = preg_replace('/<动态随机字符>/', randKey(5), $moban, 1);
//    }
//    $ri5 = count(explode('<动态随机数字>', $moban)) - 1;
//    for ($i=0; $i<$ri5; $i++)
//    {
//        $moban = preg_replace('/<动态随机数字>/', mt_rand(10000, 99999), $moban, 1);
//    }
    $moban = str_replace( "<当天时间>", date( "Y-m-d" ), $moban );
//    $ci = count(explode('<动态随机关键词>', $moban)) - 1;
//    for ($ii=0; $ii<$ci; $ii++)
//    {
//        $keywords=$mysqli->query("select title from keywords order by rand() limit 1")->fetch_object()->title;
//        $moban = preg_replace('/<动态随机关键词>/', trim($keywords), $moban, 1);
//    }
//    $wk = count(explode('<动态句子>', $moban)) - 1;
//    for ($wi=0; $wi<$wk; $wi++)
//    {
//        $juzi=$mysqli->query("select title from juzi order by rand() limit 1")->fetch_object()->title;
//        $moban = preg_replace('/<动态句子>/', trim($juzi), $moban, 1);
//    }
    $wk = count(explode('<随机泛域名>', $moban)) - 1;
    for ($wi=0; $wi<$wk; $wi++)
    {
        $spider = $mysqli->query("SELECT title FROM domains order by rand() limit 1")->fetch_object()->title;
        $spider ="http://".mt_rand(10000, 99999).".".$spider;
        $moban = preg_replace('/<随机泛域名>/', trim($spider), $moban, 1);
    }
    $wk = count(explode('<随机页面>', $moban)) - 1;
    for ($wi=0; $wi<$wk; $wi++)
    {
        $yemian="/".randKey(5).".html";
        $moban = preg_replace('/<随机页面>/', trim($yemian), $moban, 1);
    }
    $wk = count(explode('<随机人名>', $moban)) - 1;
    for ($wi=0; $wi<$wk; $wi++)
    {
        $moban = preg_replace('/<随机人名>/', randName(), $moban, 1);
    }
    $moban = str_replace( "<站点名称>", SITE_NAME ,$moban);
    return $moban;
}
//后台
function info_add($from,$title){
    global $mysqli;
    $mysqli->query("insert into ".$from." (`title`) values('".$title."')");
    header("Location: info.php?act=".$from);
}
function list_data($from,$page,$type=''){
    global $mysqli;
    $page_size=30;
    $sql="select id from ".$from;
    if($type){
        $sql.=" where type='".$type."'";
    }
    $mysqli->query($sql);
    $total=$mysqli->affected_rows;
    $pagenum=ceil($total/$page_size);
    if($page!="all"&&($page<1||!is_numeric($page)||$page>$pagenum))$page=1;
    $min=($page-1)*$page_size;
    $sql="select * from ".$from;
    if($type){
        $sql.=" where type='".$type."'";
    }
    $sql.=" order by id desc";
    if($page!="all"){
        $sql.=" limit ".$min.",".$page_size;
    }
    $result=$mysqli->query($sql);
    if($mysqli->affected_rows>0){
        while($row = $result->fetch_assoc())
        {
            $data[] = $row;
        }
        return $data;
    }
}
function list_page($from,$page,$type=''){
    global $mysqli;
    $page_size=30;
    $sql="select id from ".$from;
    if($type){
        $sql.=" where type='".$type."'";
    }
    $mysqli->query($sql);
    $total=$mysqli->affected_rows;
    if($total>0){
        $pagenum=ceil($total/$page_size);
        if($page<1||!is_numeric($page)||$page>$pagenum)$page=1;
        $shang=$page>1?$page-1:1;
        $str="<div class=\"pageUp\"><a href=\"?act=".$from."&page=".$shang."&type=".$type."\">上一页</a></div>";
        $str.="<div class=\"pageList clear\"><ul>";
//    for($i=1;$i<=$pagenum;$i++){
//        $on=$i==$page?" class=\"on\"":"";
//        $str.="<li$on><a href='?act=$from&page=$i'>$i</a></li>";
//    }
        $str.="<li class=\"on\">$page</li>";
        $str.="</ul></div>";
        $xia=$page>=$pagenum?$pagenum:$page+1;
        $str.="<div class=\"pageDown\"><a href=\"?act=$from&page=$xia&type=$type\">下一页</a></div>";
        $str.="<div class=\"pageDown\"><a href=\"export.php?act=$from&type=$type\">导出数据</a></div>";
        $str.="<div class=\"pagejump\"><form action='' method='get'><input type='hidden' name='act' value='$from'/><input type='hidden' name='type' value='$type'/>共{$pagenum}页 | 跳转到<input type='text' name='page'/>页</form></div>";
        return $str;
    }
}
function info_save($from,$title,$page,$id){
    global $mysqli;
    $mysqli->query("update ".$from." set title='".$title."' where id=".$id);
    header("Location: info.php?act=".$from."&page=".$page);
}
function info_del($from,$page,$id){
    global $mysqli;
    $mysqli->query("delete from ".$from." where id=".$id);
    header("Location: info.php?act=".$from."&page=".$page);
}
function info_del_all($from){
    global $mysqli;
    $mysqli->query("truncate table ".$from);
    header("Location: info.php?act=".$from);
}
function spider_del_all(){
    global $mysqli;
    $mysqli->query("truncate table spider");
    header("Location: spider.php");
}
function ip_update($page){
    global $mysqli;
    $page_size=10;
    $min=($page-1)*$page_size;
    $sql="select * from spider order by id desc limit ".$min.",".$page_size;
    $result=$mysqli->query($sql);
    if($mysqli->affected_rows>0){
        while($row = $result->fetch_assoc())
        {
            $ch = curl_init();
            $url = 'http://apis.baidu.com/apistore/iplookupservice/iplookup?ip='.$row['ipdz'];
            $header = array(
                'apikey: a7a1a7140e39b034dd70b718da8cd148',
            );
            curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch , CURLOPT_URL , $url);
            $res = curl_exec($ch);
            $api=json_decode($res);
            if($api->errNum==0){
                $ipinfo=$api->retData->country;
                if($api->retData->province!="None"){
                    $ipinfo.=$api->retData->province;
                }
                if($api->retData->city!="None"){
                    $ipinfo.=$api->retData->city;
                }
                if($api->retData->district!="None"){
                    $ipinfo.=$api->retData->district;
                }
                if($api->retData->carrier!="None"){
                    $ipinfo.=$api->retData->carrier;
                }
                $mysqli->query("update spider set ipinfo='".$ipinfo."' where id=".$row['id']);
            }
        }
        return true;
    }
}
//$from:数据表;$num:统计天数;$day:具体某天;$type:搜索引擎;
function data_num($from,$num='',$day='',$type=''){
    global $mysqli;
    $sql="select count(*) as count from ".$from;
    //$sql.=" where DATE_FORMAT(FROM_UNIXTIME(rq),'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d')";
    if($from=='spider'){
        if($num && is_numeric($num)){
            $riqi=time()-$num*24*3600;
            $sql.=" where rq>$riqi";
        }
        if($day){
            $sql.=" where DATE_FORMAT(FROM_UNIXTIME(rq),'%Y-%m-%d') = '".date('Y-m-d',strtotime($day))."'";
        }
        if($type){
            if($day){

            }else{
                $sql.=" where ssyq='".$type."'";
            }
        }
    }
    $num_all=$mysqli->query($sql)->fetch_object()->count;
    return $num_all;
}
function templates_list(){
    global $mysqli;
    $sql="select * from templates order by id asc";
    $result=$mysqli->query($sql);
    while($row=$result->fetch_assoc()){
        $row['thumb']="/templates/".$row['title']."/thumb.jpg";
        if($row['ok']){
            $row['us']="<a class='ok' href='?act=edit&id=".$row['id']."&ok=0'>已启用</a>";
        }else{
            $row['us']="<a href='?act=edit&id=".$row['id']."&ok=1'>未启用</a>";
        }
        $data[]=$row;

    }
    return $data;
}
function spiderset_list(){
    global $mysqli;
    $sql="select * from spiderset order by id asc";
    $result=$mysqli->query($sql);
    while($row=$result->fetch_assoc()){
        $row['thumb']="img/".$row['title']."_thumb.jpg";
        if($row['ok']){
            $row['us']="<a class='ok' href='?act=edit&id=".$row['id']."&ok=0'>已开启</a>";
        }else{
            $row['us']="<a href='?act=edit&id=".$row['id']."&ok=1'>未开启</a>";
        }
        $data[]=$row;
    }
    return $data;
}
function spider_type_list(){
    global $mysqli;
    $sql="select title from spiderset where ok=1 order by id asc";
    $result=$mysqli->query($sql);
    $str="";
    while($row=$result->fetch_assoc()){
        $str.="<a href='spider.php?type=".$row['title']."'>".$row['title']."(".data_num('spider','','',$row['title']).")</a> | ";
    }
    return $str;
}
?>