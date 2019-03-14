<?php
namespace app\controllers;
use app\controllers\Controller;

class IndexController extends Controller
{
	protected static $instance = '';
	function __construct(){
		parent::__construct();
	}
}
//View::display('index');