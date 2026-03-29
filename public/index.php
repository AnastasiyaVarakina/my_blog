<?php

require_once(dirname(__DIR__).'/config/config.php');

require_once MODELS.'/helpers.php';

$db_config = require_once CONFIG.'/db.php';

require_once MODELS.'/DB.php';

// $db = new DB($db_config);

$db = DB::getInstance()->getConnection($db_config);
require_once MODELS."/router.php";
// роутер должен стоять всегда в конце


