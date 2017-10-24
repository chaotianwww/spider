<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/10/23
 * Time: 12:30
 */


include_once "curl.php";

$url = "http://api.hxw.gov.cn/redstar-http/api/integral/addMemberIntegral";
$member_id = '637374'; //me
//$member_id = '1349199'; //耀  {"id":74841,"userName":null,"realName":"杨耀","idNumber":null,"phoneNum":"136****7190","orgCode":"43000189704","sex":"1","education":null,"status":"1","password":null,"lastUpdateTime":null,"isActivate":null,"isAdmin":"0","isSecretary":"0","userImg":"http://wx.qlogo.cn/mmopen/IlCeibINrgYlpwRVic0qySm6biaiaIJ2zq1ONmUOkzarYZFUy6XO7DTeiaRhDVYzA6K6T0AMuT0NXvxVMaqRcdZWicLoCiaPjQFluVq/132","userId":1349199,"organization":{"id":17674,"orgCode":"43000189704","parentOrgCode":"43000140388","orgName":"中共鼎城区尧天坪镇花园岗村第一支部委员会","orgCategory":null,"orgSecretary":"王建文","orgLevel":null,"orgType":null,"status":"1","duesSecrecy":null}}
$types = [
    'mryd' => [
        'header' => [
                    "Host: api.hxw.gov.cn",
                    "Content-Type: application/json",
                    "User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 11_0_2 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Mobile/15A421 MicroMessenger/6.5.18 NetType/WIFI Language/zh_CN",
                    "Referer: http://weixin.hxw.gov.cn/redStar/pages/fingerPartySchool/dayReading/readingDetailB.html?contentId=%s&canshare=1"
        ],
        'data' => '{"memberId":'.$member_id.',"orgCode":"43000134272","resourceId":"1331421","configName":"mryd","resourceType":"mryd"}',
        'id'   => 1331422,
        'num'  => 25,
        'success_num' => 0,
        'is_failed' => false
    ],
    'hxyt' => [
        'header' => [
                        "Host: api.hxw.gov.cn",
                        "Content-Type: application/json",
                        "User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 11_0_2 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Mobile/15A421 MicroMessenger/6.5.18 NetType/WIFI Language/zh_CN",
                        "Referer: http://weixin.hxw.gov.cn/redStar/pages/fingerPartySchool/listen/listenDetail.html?contentId=%s&canshare=1"
                    ],
        'data' => '{"memberId":'.$member_id.',"orgCode":"43000134272","resourceId":"1242437","configName":"hxyt","resourceType":"hxyt"}',
        'id'   => 1242437,
        'num'  => 12,
        'success_num' => 0,
        'is_failed' => false
    ],
    'wsp' => [
        'header' => [
                        "Host: api.hxw.gov.cn",
                        "Content-Type: application/json",
                        "User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 11_0_2 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Mobile/15A421 MicroMessenger/6.5.18 NetType/WIFI Language/zh_CN",
                        "Referer: http://weixin.hxw.gov.cn/redStar/pages/fingerPartySchool/video/videoDetail.html?contentId=%s&canshare=1"
                    ],
        'data' => '{"memberId":'.$member_id.',"orgCode":"43000134272","resourceId":"1002230","configName":"wsp","resourceType":"wsp"}',
        'id'   => 1002230,
        'num'  => 13,
        'success_num' => 0,
        'is_failed' => false
    ]

];
function run()
{
    set_time_limit(-1);
    global $url;
    global $types;
    foreach($types as $type_name => &$type){
        $data = json_decode($type['data'],true);
        $data['resourceId'] = $type['id'];
        if($type['num'] < 1 || $type['is_failed']){
            continue;
        }
        $type['header'][3] = sprintf($type['header'][3],$data['resourceId']);
        $content = curl::curl_post($url,json_encode($data),$type['header']);
        if($content == "success"){
            $type['success_num']++;
            $type['num']--;
        }else if($content == "failure"){
            $type['is_failed'] = true;
        }
        $type['id'] -= rand(2,5);
        echo $type_name.'---'.$data['resourceId'].'---'.$type['num'].'----'.$type['success_num'].'---'.$content.'<br/>';
        sleep(rand(2,4));
        run();

    }
}
run();
echo 'ok';