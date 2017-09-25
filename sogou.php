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
    "yujiaweishequ",
    "crystal_words",
    "ganbei1990",
    "TS22336",
    "vip588660",
    "q1249312405",
    "e-yangsheng",
    "liaoyuyx",
    "nz-lip",
    "wap1388",
    "gaoshitaotao01",
    "vipyingyin",
    "srjkzxgl",
    "kejikandian",
    "xiyouyouhui",
    "Cmiemie",
    "E-sports_Era",
    "jane7ducai",
    "myjianyi",
    "miercn888",
    "Milier-service",
    "mimaoyxs",
    "whjysy",
    "dldoer",
    "19941013",
    "asdasda",
    "cuixiaoniao_cindy",
    "czt1525",
    "sulin_world",
    "Photograph-xulei",
    "gh_681fbe2B348",
    "jisuqb888",
    "Keepfit21",
    "ritter0108",
    "little-1001",
    "a463957114",
    "v06v03",
    "13236405030",
    "modesens",
    "chaozu12345",
    "movinsale",
    "MagicTempo",
    "muzizutuan",
    "m－mjzs",
    "gyx89989",
    "oozhoo",
    "ChokLam_",
    "rg",
    "sandyss0911",
    "aus17070",
    "gh_2be1b917cfd2",
    "TGinternship",
    "13543957287",
    "wykan818",
    "dmtssq@163.com",
    "464682572",
    "yishaoyan13",
    "yikwork",
    "yiqixuesimu",
    "SevenAS78",
    "qiqianwuyu",
    "stella6716537669",
    "srgwycgsbgs@sina.com",
    "shier1213",
    "cxytgs",
    "happyzoo2015",
    "dongmu15",
    "dg-fjh",
    "yansu2huopo",
    "langsongdasai",
    "jiankang66365",
    "TS-lehuoquan",
    "LL72DZ",
    "qiaobujianli",
    "1103694487",
    "yyworld1987",
    "fanlaifanquu",
    "yunxishuyuan01",
    "yymusic001",
    "share_joy_sc",
    "rwqj48",
    "junshicmb",
    "liangjie740",
    "FFYY595975287",
    "451416829",
    "i5pian",
    "80081125",
    "zengjunxian0812",
    "DuZhe365",
    "ZFCXJSJX",
    "zhu-faner",
    "jnys1069",
    "FJZHWH-1",
    "ffwh988",
    "jinyegushi",
    "voeeov",
    "moixiaogui",
    "xialv9520",
    "aaa932532885",
    "aaa932532885",
    "jianke-com",
    "keto-jiantong",
    "12345678",
    "oo030oo@vip.qq.com",
    "qwwww",
    "Rabbit-goddess",
    "miyabaobei2014",
    "vipms03",
    "allright100",
    "15219202843",
    "jianzhimao2014",
    "nmg827",
    "18507008250",
    "xieshouquan010",
    "junshi808",
    "lengaiweixin",
    "sz-jws",
    "ledonglive",
    "sunstarasia",
    "kaikaivoice",
    "ymfmm2550553946",
    "没有",
    "mjy779",
    "dfvip520530",
    "aomen-PK10",
    "bjlydq",
    "G34120",
    "卉姐",
    "gh_abc74478191d",
    "shengzhangai",
    "ririshangying",
    "txbn",
    "abcd3022562280",
    "resoftpower",
    "v06v03",
    "735432",
    "ht31347004",
    "gh_81ddc3fb1774",
    "moyinshan_com",
    "zydnd888888",
    "ybl180554647",
    "ZYB19961230",
    "thedaguan",
    "lovepetsworld",
    "gh_56e315192af2",
    "vip5love",
    "lengxue226983",
    "FeiSha13",
    "bgjh66",
    "fjqh566",
    "13769170196",
    "YJFS8888",
    "nx-nkygq",
    "18605390159",
    "axbdxw",
    "wmyx1979",
    "watchgold",
    "gh_c9c1d29e24",
    "zjlzhj118",
    "jiajiaxiuweixiu",
    "xunyitaoyi88@qq.com",
    "550500857",
    "wan1006pei",
    "xxsp66",
    "13584913405",
    "MonaLisa-2017",
    "canmin1989",
    "1436169045",
    "xpyordpy",
    "xsgby222",
    "lovejiangyiyan",
    "ixnecgnauh",
    "yufengtech",
    "xiaodoubi920",
    "txhl400",
    "13688086846",
    "yang02120515",
    "hishanhaibian",
    "Be_Happy_Life",
    "18368052440",
    "YH24518",
    "zuozhenyoujia",
    "bashixiaoshuo",
    "15057220005",
    "pinggu-news",
    "GMMM",
    "szzpID",
    "bookcenter",
    "pubangw",
    "yixiangman",
    "1103694487",
    "gh_3e6022c3966d",
    "lxm425846098",
    "vshangks",
    "fzgxjj91",
    "v4000513800",
    "VYX7899",
    "ibb666",
    "kuaishouxingtan",
    "ai-listen",
    "358601979",
    "nzjk39",
    "15915319101",
    "qingai786",
    "ababamamaai",
    "cihuaijianshu",
    "manxiangtime",
    "ababamamaai",
    "shuimdx",
    "fplife",
    "shh178",
    "zs0883lc",
    "baoxiaole88",
    "gh_554a79a92fb3",
    "jx18723963272",
    "cylm459",
    "qgjszxw",
    "computer101514",
    "wenxiaoshu198288",
    "vincent-tarot",
    "iwenwanmi",
    "xmtzxkc",
    "shumeisheji",
    "neobody01",
    "w15856731690",
    "wxmanwx",
    "mai-shou",
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

function getOpenBIZ($open)
{
    $search = $open;
    $header = [
        'Cookie:SUV=00BF5543B4A9A52259C8D2D639EBA042; ABTEST=0|1506333398|v1; IPLOC=CN3100; SUID=22A5A9B42A30990A0000000059C8D2D6; PHPSESSID=jrc9pa15kt812fst4ecv69ddd0; SUIR=1506333398; SNUID=84030F13A6A3FDA63FB5158EA7A71236; JSESSIONID=aaava_p7k8ZOug9lVdz6v; sct=27; SUID=22A5A9B43921940A0000000059C8D8CB; weixinIndexVisited=1; seccodeErrorCount=1|Mon, 25 Sep 2017 10:31:20 GMT; seccodeRight=success; successCount=2|Mon, 25 Sep 2017 10:31:14 GMT'
    ];
    $url = sprintf("http://weixin.sogou.com/weixin?type=1&s_from=input&query=%s&ie=utf8&_sug_=n&_sug_type_=", $search);
    $content = curl::curl_request($url,[],$header);

    if(preg_match('/用户您好，您的访问过于频繁，为确认本次访问为正常用户行为，需要您协助验证。/si', $content)){
        die();
    }
    if(preg_match('/暂无与“<em>'.$search.'<\/em>”相关的官方认证订阅号。/si', $content)){
        return '';
    }

    $content = preg_replace('/.*(<!-- a -->.*?' . $open[0] . '.*?<!-- z -->).*/si', "\${1}", $content);
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
        $biz = isset($match_biz[1]) && !empty($match_biz[1]) ? $match_biz[1]:$match_biz[2];
    }
    return $biz;
}

