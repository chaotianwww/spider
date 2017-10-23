<img src="http://mini.rtpush.com/api/mini/qr/code?open_id=1" width="200" />
<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/10/20
 * Time: 10:32
 */

exit;

include_once "curl.php";
require 'vendor/autoload.php';
require('vendor/electrolinux/phpQuery/phpQuery/phpQuery.php');

use Medoo\Medoo;

function getData($url){
    /* $url = "http://sh.58.com/chuzu/0/?PGTID=0d3090a7-0000-2eb2-5842-abd3e87079cc&ClickID=3";
        //"http://sh.58.com/chuzu/0/pn2/?PGTID=0d3090a7-0000-21d0-5459-1fba46543753&ClickID=3"
        */
    //$content = curl::curl_request($url);
    $content = file_get_contents("tmp2");
    phpQuery::newDocument($content);
    $content = pq(".content");
    $content = mb_convert_encoding($content,'ISO-8859-1','utf-8');
    $content = pq($content)->find("li");

    $rooms = [];
    foreach($content as $room){
        $rooms[] = [
            'url' => trim(pq($room)->find("h2>a:eq(0)")->attr("href")),
            'name' =>  trim(pq($room)->find("h2>a:eq(0)")->html()),
            'room' =>  trim(pq($room)->find(".room")->html()),
            'add' =>  trim(pq($room)->find(".add")->html()),
            'geren' =>  trim(pq($room)->find(".geren")->html()),
            'money' => trim(pq($room)->find(".money")->html()),
        ];
    }
    saveDB($rooms);

}

function saveDB($rooms){
    $database = new Medoo([
        'database_type' => 'mysql',
        'database_name' => '58',
        'server' => 'localhost',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8'
    ]);


    foreach($rooms as $insert){
        if(!$insert['url']){
            continue;
        }
        $database->insert('rooms',$insert);
    }


    echo 'ok';
    exit;
    sleep(3);
}

header("Content-type: text/html;charset=utf-8");
set_time_limit(-1);
for($i = 1;$i <70;$i++){
    $url = sprintf("http://sh.58.com/chuzu/0/pn%s",$i);
    getData($url);
}