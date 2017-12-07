<?php
/*
$url = 'algID=nxKPympHBt&hashCode=oxQjF8ULxFTnX64zWL4SXQByHD6sJbUUmVAv2kcsNlI&FMQw=0&q4f3=zh-CN&VPIf=1&custID=160&VEek=unknown&dzuS=27.0 r0&yD16=0&EOQP=49a9fbfe2beb0490836324ceb234fef4&jp76=bb5032aedcaa9cca45f29e44506d1288&hAqN=Win32&platform=WEB&ks0Q=93b5994b1daea02ec4a30a4f9c1a569c&TeRS=1040x1920&tOHY=24xx1080x1920&Fvje=i1l1o1s1&q5aJ=-8&wNLf=99115dfb07133750ba677d055874de87&0aew=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36&E3gR=b9359e69f9e91d2af5a6ebe49d7062c7';
$url = explode('&',$url);
$urls = [];
foreach($url as $key=>$u){
    $u = explode("=",$u);
    $urls[$u[0]] = $u[1];
}
print_r($urls);*/

$url = 'billing_first_name=123123&billing_last_name=213123&billing_company=123&billing_country=US&billing_address_1=abcdewgew&billing_address_2=adcsdfdsfsd&billing_city=11&billing_state=AK&billing_postcode=32423-4234&billing_phone=323213123&billing_email=uncle.cyan@gmail.com&shipping_first_name=123123&shipping_last_name=213123&shipping_company=123&shipping_country=US&shipping_address_1=abcdewgew&shipping_address_2=adcsdfdsfsd&shipping_city=11&shipping_state=AK&shipping_postcode=32423-4234&order_comments=&shipping_method[0]=flat_rate:1&terms-field=1&_wpnonce=26c4b77154&_wp_http_referer=/checkout/';
print_r(explode("&",$url));exit;


$url = 'https://spade.cool/product/2-in-1-adjustable-cable/?item_id=2719&order_id=2939&user_id=10';

$sha1 = substr(md5(sha1($url)),-6);
echo $sha1;
exit;
echo md5('43075eab597eea693238e603d74caaa3');


//header('Content-Type: image/png');
// header('Content-Type: image/png');
\PHPQRCode\QRcode::png('http://weixin.qq.com/q/02w_MJplEbfb312sOWhq1O',"d:/cyan/a.png",'L',6);
$image_1 = imagecreatefromjpeg("http://rtpush.oss-cn-shanghai.aliyuncs.com/20171107182756_89166.png");
$image_2 = imagecreatefromstring(file_get_contents('d:/cyan/a.png'));
$image_3 = imageCreatetruecolor(imagesx($image_1),imagesy($image_1));
// 复制图片一到真彩画布中（重新取样-获取透明图片）
imagecopyresampled($image_3, $image_1, 0, 0, 0, 0, imagesx($image_1), imagesy($image_1), imagesx($image_1), imagesy($image_1));
// 与图片二合成
imagecopymerge($image_3, $image_2, 770, 500, 0, 0, imagesx($image_2), imagesy($image_2), 100);
// 输出合成图片
//header('Content-Type: image/png');
$img = imagepng($image_3);
print_r($img);

//var_dump(imagepng($image_3, 'D:/cyan/merge.png'));

exit;

if(isset($_GET['type'])  && $_GET['type'] == 'time'){
    $result = DB::table("course_page_list")->select('book_id')->groupBy("book_id")->get()->toArray();
    //$result = DB::table("course_page_list")->whereIn('id',[9627,9640,25129,25133,25136,25138,25140,17429,17432,17442,17443,17447,25330,25337,25339,25426,25459,18028,18108,29028,5228,5234,25585,25586,25589,25590,25593,25595,25597,25598,25599,25602,18178,29127,29132,29135,29137,6440,24920,29330,29337,18627,24969,15028,1291,29416,20115,19776,19853,20041,20065,20073,22729,22738,22754,15126,22796,26287,10001,18812,1301,1304,5961,35877,2461,2484,36173,971,6100,9651,9662,9664,29512,29524,19061,6982,6989,32549,32724,33028,33166,33380,33418,7053,7054,617,1201,9727,9734,9781,29727,20552,14872,14883,19224,5909,1023,29236,29629,1036,29763,29766,19309,30098,19406,27078,5424,30180,19493,19499,30688,27294,30931,30984,31016,12012,12026,1594,2207,2210,2213,2259,2416,10559,10560,1741,2516,1765,2550,2565,31333,31381,2792,31536,32172,32304,32331,2677,9860,6715,6724,3503,20715,5610,2812,7109,33061,33065,7215,36412,25686,10807,25760,25897,15511,15700,15709,15715,37777,21889,37924,23014,38004,15860,22142,22154,15936,3113,3119,16041,16066,16072,16081,16087,16303,38453,21430,38509,38751,23707,16604,6848,16662,9031,9050,2853,9069,9097,9115,9124,5677,9165,3581,33432,33436,1901,1903,20835,20840,20841,20852,20855,20858,1923,2906,33576,9349,9357,33718,33719,9448,9451,9455,9461,19554,20952,19617,12788,10655,2130,2141,21263,20079,21715,20092,21822,21827,20247,289,35072,35079,344,422,447,14551,484,14617,546,556,39094,39272,39282,22099,6881,16760,26448,26512,26530,26542,26554,26565,39514,26600,26606,39652,39698,23868,13681,39782,24010,24021,39926,39960,39966,3768,3771,3781,3787,24072,9619,13767,26726,26743,26757,26762,40051,40076,9951,35000,41033,4981,40986,13098,4245,9567,13265,4228,24265,12951,20920,10378,20975,4007,5089,21202,21343,4166,10135,21989,21992,10893,10915,13790,12453,12459,12462,21456,21462,12479,12480,4136,17254,12544,21737,21741,21746,12553,21685,10170,34568,13275,13301,13362,13373,13380,13385,13399,13452,13465,13473,13495,13500,13529,13842,13889,34793,34806,14069,22413,24359,24424,4392,14123,14301,10031,10046,3859,3865,3870,11272,11284,14577,14585,4497,4504,4513,4515,4529,4548,4549,4559,14664,14721,24480,34947,4640,4676,24543,15054,15231,15233,15243,15392,15542,15545,15687,15691,15739,15787,15810,11293,813,16138,11040,11108,15967,15972,15921,15923,16380,16384,16387,7006,16727,16620,16936,16938,16939,16948,16881,16891,17006,16964,17455,5003,17517,28021,17613,17635,17859,17933,6243,18228,18237,40845,18485,18528,18530,18547,28109,28120,28121,17150,17365,17368,17370,19077,19187,19199,870,35103,35110,19343,7670,7674,14683,14697,7720,7819,19525,13640,5174,28229,24863,8373,8452,8470,8546,8552,8653,8928,11348,8860,8793,11410,11459,40754,5065,11526,11588,11606,11672,11744,11763,11783,11865,11989,11256,11259,36002,36010,28736,28739,28746,12249,12286,12289,12350,12377,24702])->get()->toArray();
    $ids = [];
    array_walk($result,function($row)use(&$ids){
        /* $tmp_result = DB::table("course_page_list")->where(['id' => $row->id+1])->first();
         if(!count($tmp_result)){
             return;
         }
         if($tmp_result->sound_end == 0 || $tmp_result->sound_begin ==0){
             return;
         }
         $before_end = explode(":", $tmp_result->sound_end);
         $after_begin = explode(":", $row->sound_begin);
         if ($before_end[0] < $after_begin[0] && $after_begin[1] < $before_end[1]) {
             $ids[] = $row->id;
             $ids[] = $tmp_result->id;
         }*/
        $tmp_result = DB::table("course_page_list")->where(['book_id' => $row->book_id])->get()->toArray();
        for($i = 0,$len = count($tmp_result);$i<$len;$i++){
            if(!$tmp_result[$i]->sound_end || $tmp_result[$i]->sound_end == 0  || !isset($tmp_result[$i+1]) || !$tmp_result[$i+1]->sound_begin || $tmp_result[$i+1]->sound_begin == 0){
                continue;
            }

            $before_end = explode(":", $tmp_result[$i]->sound_end);
            $after_begin = explode(":", $tmp_result[$i+1]->sound_begin);
            try{
                if ($before_end[0] > $after_begin[0] || ($before_end[0] == $after_begin[0] && $after_begin[1] < $before_end[1])) {
                    $ids[] =$tmp_result[$i]->id;
                    $ids[] = $tmp_result[$i+1]->id;
                }
            }catch (\Exception $ex){
                echo $tmp_result[$i]->id,'---',$tmp_result[$i+1]->id,'<br/>';
            }
        }
    });
    echo json_encode($ids);
    exit;
}

if(isset($_GET['type']) && $_GET['type'] == 'question'){

    echo 1;
    exit;
}

if(isset($_GET['type']) && $_GET['type'] == 'swf'){
    $address = 'http://www.iqiyi.com/common/flashplayer/20171101/15261a7ff0f5.swf?vid=fde485d73fb46087caa79c9115199a24&pageURL=v_19rrlgub5o.swf&albumId=204051301&tvId=487776400&isPurchase=2&cnId=12&share_sTime=0&share_eTime=0&source=&purl=';

    $data = $this->uploadUrl($address,'swf',$fileStorage);
    print_r($data);
    exit;
}
if(isset($_GET['type']) && $_GET['type'] == 'video'){

    $url = $_GET['url'].'&t='.$_GET['t'];
    $preg_url = '#/vid/(.*)/#iU';
    preg_match($preg_url, $url, $vid);
    $vid = $vid[1];

    $key = "aaaaaaaaaaaaaaaaaaaaaaa";
    $vids = Redis::get($key);
    if($vids){
        $vids = json_decode($vids,true);
        if(in_array($vid,$vids)){
            echo 'has exits';
            return;
        }
    }
    $data = CurlTool::get($url);
    $address = $data['data']['address'];
    echo $address,'   <br/>';
    $data = $this->uploadUrl($address,'mp4',$fileStorage);
    if(isset($data['data']['image_src']) && $data['data']['image_src']){
        $tmp_v_id[] = $vid;
        $question_img = $data['data']['image_src'];
        DB::table("course_video_list")->where(['video_youku_vid' => $vid])->update(['address' => $question_img]);
        $vids[] = $vid;
        Redis::set($key,json_encode($vids));
        echo $vid.'   ok  ';
    }else{
        echo $vid,'   failed  ';
    }
    /*
      foreach($content_url as $tmp_url){

          $preg_url = '#/vid/(.*)/#iU';
          preg_match($preg_url, $tmp_url, $vid);
          $vid = $vid[1];
          if(in_array($vid,$tmp_v_id)){
              continue;
          }

          $data = file_get_contents($tmp_url);
          $data = json_decode($data,true);
          $address = $data['data']['address'];
          $data = $this->uploadUrl($address,'mp4',$fileStorage);
          if(isset($data['data']['image_src']) && $data['data']['image_src']){
              $tmp_v_id[] = $vid;
              $question_img = $data['data']['image_src'];
              DB::table("course_video_list")->where(['video_youku_vid' => $vid])->update(['address' => $question_img]);
              echo $vid.'   ok  ';
          }else{
              echo $vid,'   failed  ';
          }


      }*/
    /* $result = DB::table("course_video_list")->get()->toArray();
     array_walk($result,function($row)use($fileStorage){
         $question_img = $row->address;
         if(strpos($question_img,'rtpush.oss-cn-shanghai.aliyuncs.com')>-1){
             return;
         }
         if($question_img){

             //$data = CurlTool::postRawJSON("http://main.dev.rtpush.com/api/v1/upload-url",['url' => $question_img,'ext'=>'mp3']);
             $data = $this->uploadUrl($question_img,'mp4',$fileStorage);
             if(isset($data['data']['image_src']) && $data['data']['image_src']){
                 $question_img = $data['data']['image_src'];
                 DB::table("course_video_list")->where(['id' => $row->id])->update(['address' => $question_img]);
                 echo $row->id.'  ok  <br/>';
             }else{
                 echo $row->id.'  failed  <br/>';
             }
         }
     });
     echo 'ok!';*/

    exit;
}

exit;
if(isset($_GET['page'])){
    $id = $_GET['page'];
    $result = DB::table("course_game_list")->offset($id*1000)->limit(1000)->get()->toArray();
}else{
    $result = DB::table("course_game_list")->get()->toArray();
}


array_walk($result,function($row)use($fileStorage){
    $question_img = $row->game_coverurl;
    if(strpos($question_img,'rtpush.oss-cn-shanghai.aliyuncs.com')>-1){
        return;
    }
    if($question_img){
        //$data = CurlTool::postRawJSON("http://main.dev.rtpush.com/api/v1/upload-url",['url' => $question_img]);
        $data = $this->uploadUrl($question_img,'png',$fileStorage);
        if(isset($data['data']['image_src']) && $data['data']['image_src']){
            $question_img = $data['data']['image_src'];
            DB::table("course_game_list")->where(['id' => $row->id])->update(['game_coverurl' => $question_img]);
            echo $row->id.'  ok  ';
        }
    }

    /* $answer_list = $row->bg_pics;
     $answer_list = json_decode($answer_list,true);
     array_walk($answer_list,function(&$sub_row)use($fileStorage){
         if(strpos($sub_row,'qiniucdn.com')>-1){
             $data = $this->uploadUrl($sub_row,'png',$fileStorage);
             //$data = CurlTool::postRawJSON("http://main.dev.rtpush.com/api/v1/upload-url",['url' => $sub_row['content']]);
             if(isset($data['data']['image_src']) && $data['data']['image_src']){
                 $sub_row = $data['data']['image_src'];
             }
         }
     });
     $answer_list = json_encode($answer_list);

    DB::table("course_video_category")->where(['id' => $row->id])->update(['bg_pics' => $answer_list,'series_picurl' => $question_img]);*/

});
echo 'over';