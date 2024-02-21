<?

class Database {
    private $DB_HOST = "localhost";
    private $DB_NAME = "projectphp";
    private $DB_USER = "root";
    private $DB_PASS = "mysql";

    public function __construct() {

    }

    public function getConnect() {
        $dsn = "mysql:host={$this->DB_HOST};dbname={$this->DB_NAME};charset=utf8";
        try {
            $conn = new PDO($dsn, $this->DB_USER, $this->DB_PASS);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $ex) {
            echo "Error" . $ex->getMessage();
        }
    }
}
