<?

class Database {
    private $DB_HOST = "localhost";
    private $DB_NAME = "db_ct07";
    private $DB_USER = "admin_db_ct07";
    private $DB_PASS = "1";

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