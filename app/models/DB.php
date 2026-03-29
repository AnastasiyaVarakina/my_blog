<?

class DB
{
    private $conn;
    private PDOStatement $stmt;

    public static $instance = NULL;

    private function __construct() {}

    // private function __clone()
    // {
    // }


    // private function __wakeup() {

    // }


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
