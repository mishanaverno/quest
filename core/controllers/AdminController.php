<?php
require_once CLASSES_PATH.'AdminPanel.class.php';
USER::checkAuthorized();
$result = AdminPanel::listenGET();
$widget = View::constructWidget($result);
View::constructWidgetOnPosition('right', $result);
View::display('admin', ['widget' => $widget, 'pos' => View::$positions]);