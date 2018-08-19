<?php 
abstract class PHP
{
	public static function vd($var)
	{
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}
	public static function stringGen($length = 5)
	{
		$chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
		$size = strlen($chars) - 1;
		$string = '';
		while ($length--){
			$string .= $chars[rand(0,$size)];
		}
		return $string;
	}
}