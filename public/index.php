<?php
setcookie(
    'lang', 
    'ru', 
    ['expires' => time() + 3600*24*30,//время на которое сохраняем этот кукис
    'path' => '/',//путь проходит через все файлы
    'secure' => true,//передача только по защищенному запросы
    'httponly' => true,
    'samesite' => 'Lax'
    ]);


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

