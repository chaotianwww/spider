<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/10/23
 * Time: 12:30
 */


include_once "curl.php";

$url = "http://api.hxw.gov.cn/redstar-http/api/integral/addMemberIntegral";
$member_id = '637374';
$types = [
    'mryd' => [
        'header' => [
                    "Host: api.hxw.gov.cn",
                    "Content-Type: application/json",
                    "User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 11_0_2 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Mobile/15A421 MicroMessenger/6.5.18 NetType/WIFI Language/zh_CN",
                    "Referer: http://weixin.hxw.gov.cn/redStar/pages/fingerPartySchool/dayReading/readingDetailB.html?contentId=1331421&canshare=1"
        ],
        'data' => '{"memberId":'.$member_id.',"orgCode":"43000134272","resourceId":"1331421","configName":"mryd","resourceType":"mryd"}',
        'id'   => 1331421,
        'num'  => 25,
        'success_num' => 0,
        'is_failed' => false
    ],
    'hxyt' => [
        'header' => [
                        "Host: api.hxw.gov.cn",
                        "Content-Type: application/json",
                        "User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 11_0_2 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Mobile/15A421 MicroMessenger/6.5.18 NetType/WIFI Language/zh_CN",
                        "Referer: http://weixin.hxw.gov.cn/redStar/pages/fingerPartySchool/listen/listenDetail.html?contentId=1242448&canshare=1"
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
                        "Referer: http://weixin.hxw.gov.cn/redStar/pages/fingerPartySchool/video/videoDetail.html?contentId=1002235&canshare=1"
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
    global $url;
    global $types;
    foreach($types as $type_name => &$type){
        $data = json_decode($type['data'],true);
        $data['resourceId'] = $type['id'];
        if($type['num'] < 1 || $type['is_failed']){
            continue;
        }
        $content = curl::curl_post($url,json_encode($data),$type['header']);
        if($content == "success"){
            $type['success_num']++;
            $type['num']--;
        }else if($content == "failure"){
            $type['is_failed'] = true;
        }
        $type['id'] -= rand(1,3);
        echo $type_name.'---'.$data['resourceId'].'---'.$type['num'].'----'.$type['success_num'].'---'.$content.'<br/>';
        run();
    }
}
run();
echo 'ok';