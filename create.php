<?php
include 'get_price.php';

$result=nowapi_call($nowapi_parm);

switch($_POST[gold_type])
{
	case "gold_short":
	print_r("buy price:{$result[buy_price]}");
	echo "<pre>";
	file_put_contents("short.txt","user_short_price:{$_POST[profit_taking]}");
	print_r("获利价格:{$_POST[profit_taking]}已经添加");
	break;

	case "gold_long":
	file_put_contents("long.txt","user_long_price:{$_POST[profit_taking]}");
	print_r("获利价格:{$_POST[profit_taking]}已经添加");
	echo "<pre>";
	break;
}

?>
