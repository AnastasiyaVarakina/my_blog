<?php
// setcookie(
//     'lang', 
//     'ru', 
//     ['expires' => time() + 3600*24*30,//время на которое сохраняем этот кукис
//     'path' => '/',//путь проходит через все файлы
//     'secure' => true,//передача только по защищенному запросы
//     'httponly' => true,
//     'samesite' => 'Lax'//Защита от кросс-доменных запросов
////+переход к защите с внешнего сайта
//     ]);


// передача настроек кукисов
session_set_cookie_params([
    'lifetime' => 0,//время жизни
    'path' => '/',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'//запрещены доменные запросы
]);

//айдишники которые были только созданы с php 
//настройки сессии
ini_set('session.use_strict_mode', 1);
ini_set('session.use_only_cookies', 1);

session_start();
// dump(session_id());

require_once(dirname(__DIR__).'/config/config.php');

require_once MODELS.'/helpers.php';

$db_config = require_once CONFIG.'/db.php';
// сохраняем данные о ббд

require_once MODELS.'/DB.php';

// $db = new DB($db_config);

$db = DB::getInstance()->getConnection($db_config);
// первый вызов он создает объект, дальше он уже будет просто возвращать существующий объект
require_once MODELS."/router.php";
// роутер должен стоять всегда в конце

