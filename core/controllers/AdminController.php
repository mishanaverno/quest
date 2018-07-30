<?php
require CLASSES_PATH.'AdminPanel.class.php';
USER::checkAuthorized();
View::display('admin');