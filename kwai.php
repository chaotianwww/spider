<?php
	/**
	 * Created by PhpStorm.
	 * User: admin
	 * Date: 2017/12/25
	 * Time: 15:31
	 */

	include_once "curl.php";

	function run()
	{
		$url = 'http://api.ksapisrv.com/rest/n/feed/hot?appver=5.4.7.330&did=5C423B9C-3030-4CF6-87A4-50595FE6AFAD&c=a&ver=5.4&sys=ios11.1.2&mod=iPhone7%2C2&net=_5';

		$header = [

			'Content-Type: application/x-www-form-urlencoded',
		    'X-REQUESTID: 10620149',
		    'Accept: application/json',
		    'User-Agent: kwai-ios',
		];
		$post_data ='client_key=56c3713c&count=20&country_code=cn&id=3&language=en-CN%3Bq%3D1%2C%20zh-Hans-CN%3Bq%3D0.9&pcursor=1&pv=false&refreshTimes=1&sig=318fafbd3023af99cc146c22aadd2c9e&type=7';
		$data = Curl::curl_post($url,$post_data,$header);
		$data = json_decode($data,true);
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}

	run();