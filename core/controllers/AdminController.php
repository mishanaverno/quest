<?php
require_once CLASSES_PATH.'AdminPanel.class.php';
USER::checkAuthorized();
$data = AdminPanel::listenGET();
View::constructWidgetOnPosition('right', $data);
View::display('admin');