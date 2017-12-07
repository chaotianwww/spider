<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/11/16
 * Time: 9:24
 */


include_once "curl.php";
require 'vendor/autoload.php';
require('vendor/electrolinux/phpQuery/phpQuery/phpQuery.php');
use voku\db\DB;

header("Content-type: text/html; charset=utf-8");
set_time_limit(-1);

$db = DB::getInstance('localhost', 'root', '', 'test');

$question_url = 'https://www.33iq.com/quiz/quizload?q_id=%s';
$question_id = [331 => 9 ];
$header_arr = [
    'Host: www.33iq.com',
    'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36',
    'Referer: https://www.33iq.com/quiz/question/%s.html',
    'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
    'Accept-Language: zh-CN,zh;q=0.8',
    'X-Requested-With: XMLHttpRequest',
    'Origin: https://www.33iq.com',
    'Cookie: quiz_deadtime[543]=1542211200; PHPSESSID=b3gpqfri7gbl2ld9poqfq736j1; quiz_answer[8482]=undefined; quiz_deadtime[213]=1510802256; quiz_answer[2771]=1; quiz_answer[2772]=2; quiz_answer[2773]=1; quiz_answer[2774]=2; quiz_answer[2775]=2; quiz_answer[2776]=4; quiz_answer[2777]=3; quiz_answer[2778]=2; quiz_deadtime[58]=1542297600; quiz_deadtime[38]=1510803903; quiz_deadtime[583]=1510804205; quiz_deadtime[582]=1510803687; __utmt=1; quiz_deadtime[578]=1510804575; quiz_deadtime[528]=1510805239; quiz_deadtime[331]=1510805380; quiz_deadtime[388]=1510805178; return_URL=https%3A//www.33iq.com/quiz/question/331.html; __utma=215980488.1801202842.1510742412.1510799533.1510802706.4; __utmb=215980488.16.10.1510802706; __utmc=215980488; __utmz=215980488.1510742412.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)'
];
run();
function run()
{
    global $question_url;
    global $question_id;
    global $header_arr;

    foreach($question_id as $id => $num){
        $url = sprintf($question_url,$id);
        $header_arr[2] = sprintf($header_arr[2],$id);
        echo $url;
        echo '<pre>';
        print_r($header_arr);
        echo '</pre>';
        for($i = 1;$i <= $num; $i++){
            $post = array(
                'question' => $i
            );
            echo '<pre>';
            print_r($post);
            echo '</pre>';
            $result = Curl::curl_post($url,$post,$header_arr);
            $result=mb_convert_encoding($result, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5');
           saveContent($result,$id);
        }
        exit;
    }
}
function saveContent($result,$question_id)
{
    global $db;
    phpQuery::newDocument($result);
    $question_type = trim(pq("h4")->contents());
    $question_type = preg_replace('[\s]',' ',$question_type);
    $question_type = preg_replace ( "/\s(?=\s)/","\\1", $question_type );


    if(pq("#form_subanswer")->find(".controls.word-wrap")->find("p")->count() > 1){
        $question = trim(pq("#form_subanswer")->find(".controls.word-wrap")->find("p:eq(0)")->contents());
        $img_src = trim(pq("#form_subanswer")->find(".controls.word-wrap")->find("p:eq(1)")->find("img")->attr("src"));
    }else{
        $img_src = trim(pq("#form_subanswer")->find(".controls.word-wrap")->find("p:eq(0)")->find("img")->attr("src"));
        $question = '';
    }

    $answer = trim(pq("#form_subanswer")->find(".control-group.margin-bottom0")->find("div")->find("label")->find("div")->contents());
    $answer = preg_replace('[\s]',' ',$answer);
    $answer = preg_replace ( "/\s(?=\s)/","\\1", $answer );
    $answer = str_replace(". ",'.',$answer);
    $answer = json_encode(explode(' ',$answer));

    $arr = [
        'question_id' => $question_id,
        'question_type' => $question_type,
        'question_name' => $question,
        'question_img' => $img_src,
        'answer' => $answer
    ];

    print_r($arr);
    $id = $db->insert('question_33iq', $arr);
}