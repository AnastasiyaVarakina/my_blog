<? 

// связывает именно страницы приложения

// $routes = [
//     // это прсото ключи и названия мы им сами задаем
//     '' => C_POSTS.'/index.php',
//     '/' => C_POSTS.'/index.php',
//     'contacts.php' => CONTROLLERS.'/contacts.php',
//     // 'contacts' => CONTROLLERS.'/contacts.php' можно и так
//     'posts/create' => C_POSTS.'/create.php',
//     'posts/show' => C_POSTS.'/show.php',
//     'login' => C_USER.'/login.php',
//     'registr' => C_USER.'/registr.php',
//     'update' => C_POSTS.'/update.php',
// ];

//ПОСТЫ
$router->get('', '/posts/index.php');
$router->get('/', '/posts/index.php');
$router->get('posts/create', '/posts/create.php');
$router->post('posts/create', '/posts/create.php');
$router->get('update', '/posts/update.php');
$router->post('update', '/posts/update.php');

$router->get('posts/show', '/posts/show.php');

$router->delete('posts', '/posts/destroy.php');

// юзер
$router->get('login', '/users/login.php');
$router->post('login', '/users/login.php');

$router->get('registr', '/users/registr.php');
$router->post('registr', '/users/registr.php');

$router->get('contacts', '/contacts.php');

