<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/10/12
 * Time: 11:16
 */


include_once "curl.php";


$kw = "维小维生素";
$alias = 'gh_ef1bd71ae399';
$data = getUserData($kw,$alias);

print_r($data);exit;


function getUserData($kw,$alias){

    $url = 'http://top.aiweibang.com/user/getsearch';
    $post = [
        'Kw'          =>$kw,
        'PageIndex' => 1,
        'PageSize' => 10
    ];

    $content = curl::curl_request($url,$post);

    $content = json_decode($content,true);

    $id = '';
    if(count($content['data']['data'])){
        if(count($content['data']['data']) > 1 && $alias != ""){
            foreach($content['data']['data'] as $open){
                if($open['Alias'] == $alias){
                    $id = $open['Id'];
                }
            }
        }else{
            $id = $content['data']['data'][0]['Id'];
        }
    }
    if($id){
        $url = 'http://top.aiweibang.com/statistics/readnum';
        $post = [
            'id' => $id
        ];
        $content = curl::curl_request($url,$post);

        $content = json_decode($content,true);

        $data['avg'] = $content['data'];

        $url = 'http://top.aiweibang.com/statistics/tendency';
        $post = [
            'id' => $id
        ];
        $content = curl::curl_request($url,$post);

        $content = json_decode($content,true);

        $data['line'] = $content['data'];
        return $data;
    }
    return false;


}