<?
    class User
    {
        public $id;
        public $username;
        public $password;
        /*
            authenciation
        */

        public static function authencicate($conn, $username, $password)
        {
            $sql = "select * from users where username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $stmt->execute();
            $user = $stmt->fetch();
            return $user;
        }

        public static function showAllUsers($conn) 
        {
            $sql = "select * from users";
            $users = $conn->query($sql);
            return $users;
        }
    }
?>