<?php
//инициализация констант
define('ASSETS_PATH', ROOT_PATH.'assets'.DS);
define('INCLUDE_PATH', CORE_PATH.'include'.DS);
define('CONFIG_PATH', CORE_PATH.'config'.DS);
define('CLASSES_PATH', INCLUDE_PATH.'classes'.DS);
define('HELPERS_PATH', INCLUDE_PATH.'helpers'.DS);
define('CONTROLLERS_PATH', CORE_PATH.'controllers'.DS);
define('PROCESSORS_PATH', INCLUDE_PATH.'processors'.DS);
define('VIEW_PATH', CORE_PATH.'view'.DS);
define('MODEL_PATH', CORE_PATH.'model'.DS);
//подключение основных классов
require_once CLASSES_PATH.'DB.class.php';
require_once CLASSES_PATH.'Router.class.php';
require_once CLASSES_PATH.'View.class.php';
require_once CLASSES_PATH.'User.class.php';
require_once CLASSES_PATH.'DataProvider.class.php';
require_once CLASSES_PATH.'Widget.class.php';
//подключение обработчиков данных
require_once PROCESSORS_PATH.'Post.processor.php';
require_once PROCESSORS_PATH.'Get.processor.php';
//подключение хелперов
require_once HELPERS_PATH.'PHP.helper.php';
require_once HELPERS_PATH.'Constructor.helper.php';
session_start();
DB::init();
Router::start();
