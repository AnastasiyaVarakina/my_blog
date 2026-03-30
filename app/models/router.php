<?

require_once CONFIG.'/routes.php';

$uri = trim(parse_url($_SERVER['REQUEST_URI'] )['path'] , '/');
// извлекает только путь без query параметров и удаляет нач и конеч слеши


// array_key_exists - проверяет есть ли ключ по названию uri(страница) в массиве routes(странички)
// file_exists - существует ли файл по указанному ключу
if(array_key_exists($uri, $routes) && file_exists($routes[$uri])) {
    require_once $routes[$uri];//если все выполняется то выводим страницу
} else abort();//если нет то аборт