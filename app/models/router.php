<?

require_once CONFIG.'/routes.php';

$uri = trim(parse_url($_SERVER['REQUEST_URI'] )['path'] , '/');

if(array_key_exists($uri, $routes) && file_exists($routes[$uri])) {
    require_once $routes[$uri];
} else abort();