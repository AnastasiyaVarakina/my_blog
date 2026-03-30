<?

// это паттерн, который гарантирует что у класса есть всего один экземпляр, 
// и предоставляет к экземпляру глобальную точку доступа 
// Например подключение к БД, достаточно одного подключения.


class DB
{
    private $conn;

    // подготовленный запрос к бд
    private PDOStatement $stmt;

    public static $instance = NULL;//хранилище единственного экземпляра

    private function __construct() {}//делаем приватный, чтобы никто не мог создать
    // экземпляр через New

    // запрет клонирования
    // private function __clone()
    // {
    // }

    // запрет десериализации(восстановления из сериализованной строки)
    // private function __wakeup() {

    // }


    // подлкючение к
    public function getConnection($db_config) {
                try {
            // DSN строка которая описывает к какой бд мы подключаемся
            $dsn = "mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset={$db_config['charset']}";
            //создаем экземплряр класса PDO , устанавливает соединение с бд
            $this->conn = new PDO(
                $dsn,
                $db_config['username'],
                $db_config['pass'],
                $db_config['options']
            );
            // echo "Подключение к {$db_config['dbname']} прошло успешно<br>";
            return $this;
        } catch (PDOException $e) {
            abort(500);
        };
    }

    // если хранилище пустое, то создаем экземпляр, второй раз обратиться не сможем
    // тк хранилище уже не нулевое
    public static function getInstance() {
        if(self::$instance === NULL) {
            self::$instance = new self();
        }

        return self::$instance;
    }



    public function query($sql, $params = []) : DB {
        $this->stmt = $this->conn->prepare($sql);
        $this->stmt->execute($params);
        return $this;
    }

    public function findAll() {
        return $this->stmt->fetchAll();
    }

    public function find() {
        return $this->stmt->fetch();
    }

    public function findOrAbort() {
        $result =  $this->find();
        if (!$result) {
            abort();
        };
        return $result;
    }

}
