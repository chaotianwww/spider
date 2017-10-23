<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/9/25
 * Time: 12:32
 */
include_once "curl.php";
set_time_limit(-1);

$open =[
    "shuangniao2",
    "wuxiaoge060",
    "kqqkjy",
    "esdlph",
    "sugouchuangfu",
    "wangbaoheng0755",
    "nvrengd",
    "Night_WithU",
    "v249035068",
    "liyunianhua",
    "ddz_233",
    "txfm001",
    "fortunetime",
    "lydtt666",
    "ellechina",
    "gedaye7",
    "ruan9ruan",
    "sishu04"
];

run();


function run()
{
    require_once 'vendor/autoload.php';
    DB::$user = 'root';
    DB::$password = '';
    DB::$dbName = 'mini';

    global $open;
    foreach($open  as $val){
        $biz = getOpenBIZ($val);

        if(!$biz){
            wlog($val."---no biz<br/>");
            continue;
        }
        wlog($val.'---'.$biz."<br/>");
        sleep(2);
    }
    echo 'over';

}

function wlog($txt)
{
    file_put_contents("TMP.html", $txt,FILE_APPEND);
}

function getCookie($num)
{
    $sogou_cookie = [
          'Cookie:SUV=00BF5543B4A9A52259C8D2D639EBA042; ABTEST=0|1506333398|v1; IPLOC=CN3100; SUID=22A5A9B42A30990A0000000059C8D2D6; SUID=22A5A9B43921940A0000000059C8D8CB; weixinIndexVisited=1; pgv_pvi=9547116544; ld=Hkllllllll2BhC$2lllllVXGBc6lllllH3uOwkllll9lllll4llll5@@@@@@@@@@; SNUID=C7404C51E5E0BECEC6F07085E65F01C5; JSESSIONID=aaa_aiNIebrXQ7umOba8v; sct=109'
    ];
    return $sogou_cookie[$num];
}
$time = 0;
function getOpenBIZ($open)
{
    $search = $open;

    $num = rand(0,4);
    $cookie = getCookie(0);
    $header = [
        $cookie
    ];
    $url = sprintf("http://weixin.sogou.com/weixin?type=1&s_from=input&query=%s&ie=utf8&_sug_=n&_sug_type_=", $search);
    $content = curl::curl_request($url,[],$header);

    if(preg_match('/用户您好，您的访问过于频繁，为确认本次访问为正常用户行为，需要您协助验证。/si', $content)){
        echo $cookie,"<br/>";
        echo '用户您好，您的访问过于频繁，为确认本次访问为正常用户行为，需要您协助验证';
        getOpenBIZ($open);
        global $time;
        if($time++ == 6){
            die();
        }
    }
    if(preg_match('/暂无与“<em>'.$search.'<\/em>”相关的官方认证订阅号。/si', $content)){
        echo '暂无','<br/>';
        return '';
    }

    $content = preg_replace('/.*(<!-- a -->.*?<label name="em_weixinhao">' . $search . '<\/label>.*?<!-- z -->).*/si', "\${1}", $content);
    $content = preg_replace('/.*微信扫一扫关注.*?<img.*?src="(.*?)".*?>.*?<img.*?src="(.*?)".*?最近文章.*?<a.*?href="(.*?)".*/si', "\${1}:;\${2}:;\${3}", $content);

   if(!$content){
       return '';
   }
    $content = explode(':;', $content);

    array_walk($content, function (&$val) {
        $val = preg_replace('/amp;/i', '', $val);
    });
    $biz = "";
    if (isset($content[2])) {

        $article_content = curl::curl_request($content[2]);

        $article_content = str_replace(" ", "", $article_content);
        $article_content = str_replace("\r\n", "", $article_content);

        $preg_biz = '#varbiz="(.*)"\|\|"(.*)";#iU';
        preg_match($preg_biz, $article_content, $match_biz);
        $biz = isset($match_biz[1]) && !empty($match_biz[1]) ? $match_biz[1]:isset($match_biz[2])?$match_biz[2]:'';
    }
    return $biz;
}

