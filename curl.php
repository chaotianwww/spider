<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/9/25
 * Time: 12:25
 */

class Curl{

    function curl_get($url)
    {
        //初始化
        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        //释放curl句柄
        curl_close($ch);
        //打印获得的数据
        return $output;
    }

    function curl_post($url,$post_data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // post数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // post的变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $output = curl_exec($ch);
        curl_close($ch);
        //打印获得的数据
        return $output;
    }
}