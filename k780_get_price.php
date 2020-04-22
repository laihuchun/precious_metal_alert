<?php
header("Content-Type:text/html;charset=UTF-8");
function nowapi_call($a_parm){
    if(!is_array($a_parm)){
        return false;
    }
    //combinations
    $a_parm['format']=empty($a_parm['format'])?'json':$a_parm['format'];
    $apiurl=empty($a_parm['apiurl'])?'http://api.k780.com/?':$a_parm['apiurl'].'/?';
    unset($a_parm['apiurl']);
    foreach($a_parm as $k=>$v){
        $apiurl.=$k.'='.$v.'&';
    }
    $apiurl=substr($apiurl,0,-1);
    if(!$callapi=file_get_contents($apiurl)){
        return false;
    }
    //format
    if($a_parm['format']=='base64'){
        $a_cdata=unserialize(base64_decode($callapi));
    }elseif($a_parm['format']=='json'){
        if(!$a_cdata=json_decode($callapi,true)){
            return false;
        }
    }else{
        return false;
    }
    //array
    if($a_cdata['success']!='1'){
        echo $a_cdata['msgid'].' '.$a_cdata['msg'];
        return false;
    }
    return $a_cdata['result'];
}

$nowapi_parm['app']='finance.gzgold';
$nowapi_parm['goldid']='1152';
$nowapi_parm['version']='2';
$nowapi_parm['appkey']='44252';
$nowapi_parm['sign']='56cea8bbfb9627226eb7f85aa6d307eb';
$nowapi_parm['format']='json';

$aa=file_get_contents("php://input");
if($aa=="price"){
	$result=nowapi_call($nowapi_parm);
	$txt1='当前买入价:';
	$txt2='当前卖出价:';
	echo $txt1 . "" . $result['buy_price'] . "" . "<br>";
	echo $txt2 . "" . $result['sell_price'];
}
#$result=nowapi_call($nowapi_parm);
#var_dump($result);

?>
