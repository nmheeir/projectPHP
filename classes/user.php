<?
    include("C:\Program Files\Ampps\www\Project\TEST\classes\dataview.php");
?>

<?
    class User
    {
        public $id;
        public $username;
        public $password;
        /*
            authenciation
        */
        public static function getUserByUserName($conn, $username) {
            $sql = "select * from users where username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $stmt->execute();
            $user = $stmt->fetch();
            if($user) {
                return new DataView(true, $user, "Ok");
            }
            else {
                return new DataView(false, $user, "CANNOT FOUND USER");
            }
        }
        public static function authencicate($conn, $username, $password)
        {
            $user = self::getUserByUserName($conn, $username);
            if($user->isSuccess) {
                if(password_verify($password, $user->data->hash_password)) {
                    return new DataView(true, $user->data, "login ok");
                }
                else {
                    return new DataView(false, null, "WRONG PASSWORD");
                }
            }
            else {
                return new DataView(false, null, $user->message);
            }
        }


        public static function showAllUsers($conn) 
        {
            $sql = "select * from users";
            $users = $conn->query($sql);
            return $users;
        }
        // đăng kí người dung mới
        public static function registerUser($conn, $username, $password, $fullname, $company_id)
        {
            $user = self::getUserByUserName($conn, $username);
            if($user->isSuccess) {
                return new DataView(false, null, "USERNAME đã tồn tại");
            }
            // Hash mật khẩu trước khi lưu vào cơ sở dữ liệu
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Tạo SQL query để chèn dữ liệu mới
            $sql = "INSERT INTO users (username, password, fullname, company_id, hash_password, active) 
                    VALUES (:username, :password, :fullname, :company_id, :hash_password, 1)";

            // Sử dụng prepared statement để tránh SQL injection
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->bindValue(':password', $password, PDO::PARAM_STR);
            $stmt->bindValue(':fullname', $fullname, PDO::PARAM_STR);
            $stmt->bindValue(':company_id', $company_id, PDO::PARAM_INT);
            $stmt->bindValue(':hash_password', $hashedPassword, PDO::PARAM_STR);

            // Thực hiện truy vấn
            try {
                $stmt->execute();
                return new DataView(true, null, "Registration successful");
            } catch (PDOException $e) {
                return new DataView(false, null, "Registration failed: " . $e->getMessage());
            }
        }

        public static function getOrderById($conn) {
            $shipperId = $_SESSION["user_id"];
            $sql = "SELECT 
                        orders.id AS order_id,
                        orders.company_id,
                        company.company_name,
                        users.fullname AS shipper_name,
                        orders.description,
                        orders.latitude,
                        orders.longtitdue,
                        orders.address
                    FROM 
                        orders
                    JOIN 
                        users ON orders.shipper_id = users.id
                    JOIN 
                        company ON orders.company_id = company.id
                    WHERE 
                        orders.shipper_id = :shipper_id";
    
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':shipper_id', $shipperId, PDO::PARAM_INT);
            $stmt->execute();
    
            // Lấy tất cả các hàng kết quả dưới dạng mảng
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $orders;
        }
    }
?>