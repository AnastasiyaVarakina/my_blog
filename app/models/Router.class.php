<?

class Router {

// сюда складываются все маршруты
    private $routes = [];
    private $uri;

    // метод которым мы собиаремся переходить(пост гет пут)
    private $method;

    // каждый раз когда пользователь собирается проходить по какому то 
    // маршруту, будет создавать экземпляр класса
    public function __construct()
    {
        // извлекает только путь без query параметров и удаляет нач и конеч слеши
        $this->uri = trim(parse_url($_SERVER['REQUEST_URI'] )['path'] , '/');
        // метод чтобы привести к верхнему регистру
        $this->method = strtoupper($_POST['_method'] ?? $_SERVER['REQUEST_METHOD']);
    }


    // проходит по карте маршрутов и проверяет есть ли такой маршрут
    // есть ли такой контроллер и метод
    public function match() {
        // флаг нашли мы совпадение или нет
        // если к концу метода не нашли совпадение, то ошибка 404
        // страница не найдена
        $matches = false;

        foreach($this->routes as $route) {
            // сравниваем с переменные из конструктора, которые мы уже заполнили
            if($route['uri'] === $this->uri && $route['method'] === $this->method) {
                if(!file_exists(CONTROLLERS.$route['controller'])) {
                    // не найдем нужный контроллер по такому uri
                    break;
                }
                else {
                    $matches = true;
                    require_once CONTROLLERS.$route['controller'];
                    break;  
                }
            }
        }
        if(!$matches) {
            abort();
        }
    }

    // скрытый метод который будет добавлять маршруты в карту маршрутов
    private function add($uri, $controller, $method) {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
        ];
    }



    // запросы сначала идут сюда, чтобы определиться они гет или пост
    public function get($uri, $controller) {
        $this->add($uri, $controller, 'GET');
    }

    public function post($uri, $controller) {
        $this->add($uri, $controller, 'POST');
    }


    public function delete($uri, $controller) {
        $this->add($uri, $controller, 'DELETE');
    }

    public function put($uri, $controller) {
        $this->add($uri, $controller, 'PUT');
    }
}

