<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/11/16
 * Time: 14:24
 */


include_once "curl.php";
require 'vendor/autoload.php';
require('vendor/electrolinux/phpQuery/phpQuery/phpQuery.php');
use voku\db\DB;


header("Content-type: text/html; charset=utf-8");
set_time_limit(-1);

$db = DB::getInstance('localhost', 'root', '', 'test');


run();
function run()
{
    //$url = 'http://m.amttcc.cn/cp/1.asp?sex=1&age=1&wd=0&i=%s&z=5&iz=1';
    //$url = 'http://m.amttcc.cn/cp/GT/1.asp?sex=Male&age=1&i=%s&z=1&iz=1';
    $url ='http://www.amttcc.cn/cp/sj/1.asp?sex=1&age=1&i=%s&z=0&tx=1&iz=1';
    for($i = 0;$i < 10;$i++){
        $tmp_url = sprintf($url,$i);
        $result = Curl::curl_get($tmp_url);
        $result=mb_convert_encoding($result, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5');
        explain_result($result);
    }
}

function explain_result($result)
{
    global $db;
    $preg_url = '/<p class="jieshao1">(.*)/';
    preg_match($preg_url, $result, $question);
    $question = $question[1];

    $preg_url = '/<span class="STYLE2">(.*?)<\/span>/';
    preg_match_all ($preg_url, $result, $answer);
    $answer = json_encode($answer[1]);

    $arr = [
        'question_id' => 9997,
        'question_type' => '',
        'question_name' => $question,
        'question_img' => '',
        'answer' => $answer
    ];

    print_r($arr);
    $db->insert('question_33iq', $arr);
}