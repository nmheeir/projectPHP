<?
    require_once "../config.php";
    require_once "../classes/database.php";
    function dbconn() {
        $db = new Databbase(DB_HOST, DB_NAME, DB_USER, DB_PASS);
        return $db->getConn();
    }
?>