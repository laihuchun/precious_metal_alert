<?php
header("Content-Type:text/html;charset=UTF-8");

function sendnow($money)
{
	$nowapi_parm['account']='zufangbao';
	$nowapi_parm['password']='6CB86E084A033F506FE37F3C75324849';
	$nowapi_parm['mobile']='18668241861';
	$nowapi_parm['content']="${money},今天您值班，如无法响应请直接联系备角【随地付】";
	smsapi_call($nowapi_parm);	
}

function smsapi_call($a_parm){

$options['http'] = array(
     'timeout'=>60,
     'method' => 'POST',
     'header' => 'Content-type:application/x-www-form-urlencoded'
    );

$context = stream_context_create($options);


$apiurl=empty($a_parm['apiurl'])?'http://api.chanzor.com/send?':$a_parm['apiurl'].'/?';
    unset($a_parm['apiurl']);
    foreach($a_parm as $k=>$v){
        $apiurl.=$k.'='.$v.'&';
    }
    $apiurl=substr($apiurl,0,-1);
    if(!$callapi=file_get_contents($apiurl,false,$context)){
        return false;
    }
}




?>
