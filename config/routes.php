<? 

// связывает именно страницы приложения

$routes = [
    // это прсото ключи и названия мы им сами задаем
    '' => C_POSTS.'/index.php',
    'contacts.php' => CONTROLLERS.'/contacts.php',
    // 'contacts' => CONTROLLERS.'/contacts.php' можно и так
    'posts/create' => C_POSTS.'/create.php',
    'posts/show' => C_POSTS.'/show.php'
];