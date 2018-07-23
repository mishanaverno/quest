<?php
//инициализация констант
define('ASSETS_PATH', ROOT_PATH.DS.'assets'.DS);
define('INCLUDE_PATH', CORE_PATH.'include'.DS);
define('CONFIG_PATH', CORE_PATH.'config'.DS);
define('CLASSES_PATH', INCLUDE_PATH.'classes'.DS);
define('HELPERS_PATH', INCLUDE_PATH.'helpers'.DS);
define('CONTROLLERS_PATH', CORE_PATH.'controllers'.DS);
define('PROCESSORS_PATH', INCLUDE_PATH.'processors'.DS);
define('VIEW_PATH', CORE_PATH.'view'.DS);
//подключение основных слассов
require CLASSES_PATH.'DB.class.php';
require CLASSES_PATH.'Router.class.php';
require CLASSES_PATH.'View.class.php';
require CLASSES_PATH.'User.class.php';
//подключение обработчиков данных
require PROCESSORS_PATH.'Post.processor.php';
session_start();
DB::init();
Router::start();
