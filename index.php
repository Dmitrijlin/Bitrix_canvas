<?php
// подключаем файлы ядра
include 'cfg/connectConfig.php';
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';

// подключаем маршрутизатор и запускаем
require_once 'core/route.php';
Route::start();