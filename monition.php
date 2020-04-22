<?php
include 'send_sms.php';
include 'get_price.php';


function  check_price($cid)
{
if($cid=="short")
{
	$filename="short.txt";
}
else if($cid=='long')
{
	$filename="long.txt";
}

$txt=file("$filename");
preg_match_all('/[a-z_]*/',$txt[0],$type);
preg_match_all('/\d{3}.*/',$txt[0],$price);
$type=$type[0][0];
$price=$price[0][0];

$type_array=array(
'type' => "$type",
'price' => "$price",
'filename' => "$filename"
);


send_confirm($type_array);
}

$result=nowapi_call($nowapi_parm);

function send_confirm($type_array)
{
global $result;
switch($type_array[type])
{
//这里的买入价相当于我平仓的价格，所以是反的
//user_short_price=空单获利   online_buy_price > short.txt
	case "user_short_price":
		if($result[buy_price]<$type_array[price])
			{
			   sendnow($type_array[type]);
			   file_put_contents("$type_array[filename]","user_short_price:0");
			}
	break;
//user_long_price=多单获利   online_sell_price > long.txt
	case "user_long_price":
		if($result[sell_price]>$type_array[price])
			{
			  sendnow($type_array[type]);
			   file_put_contents("$type_array[filename]","user_long_price:1000");
			}
	break;
}
}
check_price(short);
check_price(long);

?>
