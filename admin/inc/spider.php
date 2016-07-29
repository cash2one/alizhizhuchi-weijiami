<?php
class spider
{
    function getHttp($var, $default_var = false)
    {
        static $http;
        if (!isset($http)) {
            $http = array_merge($_GET, $_POST);
        }
        if (isset($http[$var])) {
            return addslashes($http[$var]);
        } else {
            return $default_var;
        }
    }
    function getIp()
    {
        if ($ip = getenv('HTTP_CLIENT_IP')) {
        } elseif ($ip = getenv('HTTP_X_FORWARDED_FOR')) {
        } elseif ($ip = getenv('HTTP_X_FORWARDED')) {
        } elseif ($ip = getenv('HTTP_FORWARDED_FOR')) {
        } elseif ($ip = getenv('HTTP_FORWARDED')) {
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    function writeLog($engine, $agent = '')
    {
        global $mysqli;
//        if (!$engine) {
//            $engine = 'other';
//        }
        $agent = "({$_SERVER['HTTP_ACCEPT_LANGUAGE']})";
        $ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '无来路';
        $ipdz=$this->getIp();
        $time=time();
        $sql="insert into spider (`ssyq`,`fwdz`,`lldz`,`ipdz`,`age`,`rq`,`ipinfo`) values ('$engine','http://{$_SERVER['SERVER_NAME']}{$_SERVER['REQUEST_URI']}','$ref','$ipdz','$agent',$time,'".convertip($ipdz)."')";
        $mysqli->query($sql);
    }
    function record()
    {
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $act=isset($_GET['act'])?$_GET['act']:"";
        $spider=get_naps_bot();
        if($spider&&$act!="liyunpeng"){
            $this->writeLog($spider, $agent);
        }
    }
}
$spider = new spider();
$spider->record();
unset($spider);