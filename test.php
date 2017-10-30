<?php

$url = 'algID=nxKPympHBt&hashCode=oxQjF8ULxFTnX64zWL4SXQByHD6sJbUUmVAv2kcsNlI&FMQw=0&q4f3=zh-CN&VPIf=1&custID=160&VEek=unknown&dzuS=27.0 r0&yD16=0&EOQP=49a9fbfe2beb0490836324ceb234fef4&jp76=bb5032aedcaa9cca45f29e44506d1288&hAqN=Win32&platform=WEB&ks0Q=93b5994b1daea02ec4a30a4f9c1a569c&TeRS=1040x1920&tOHY=24xx1080x1920&Fvje=i1l1o1s1&q5aJ=-8&wNLf=99115dfb07133750ba677d055874de87&0aew=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36&E3gR=b9359e69f9e91d2af5a6ebe49d7062c7';
$url = explode('&',$url);
$urls = [];
foreach($url as $key=>$u){
    $u = explode("=",$u);
    $urls[$u[0]] = $u[1];
}
print_r($urls);