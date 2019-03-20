<?php 
function vd($var)
{
	echo '<pre>';
	var_dump($var);
	echo '</pre>';
}
function stringGen($length = 5)
{
	$chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
	$size = strlen($chars) - 1;
	$string = '';
	while ($length--){
		$string .= $chars[rand(0,$size)];
	}
	return $string;
}
function request(){
	$url = $_SERVER['REQUEST_URI'];
	$q = strpos($url, '?');
	if($q){
		$url = substr($url, 0, $q);
	}
	return $url;
}
