<? 

// базовый url проекта, для формирования ссылок в браузере
define("PATH", 'https://blog.loc');
// магическая константа - содержит полный путь к каталогу, где находится исполняемый файл
define("ROOT", dirname(__DIR__));

define("APP", ROOT.'/app');
define("CONTROLLERS", APP.'/controllers');
define("MODELS", APP.'/models');
define("C_POSTS", CONTROLLERS.'/posts');

define("CONFIG", ROOT.'/config');
define("PUBLIC", ROOT.'/public');
define("VIEWS", ROOT.'/views');
define("COMPONENTS", VIEWS.'/components');

define("V_POSTS", VIEWS.'/posts');

define("C_USER", CONTROLLERS.'/users');
define("V_USER", VIEWS.'/users');