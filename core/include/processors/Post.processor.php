<?php 
abstract class POST 
{
	public static isAction(){
		if(isset($_POST['action'])){
			return true;
		}else{
			return false;
		}
	}
}