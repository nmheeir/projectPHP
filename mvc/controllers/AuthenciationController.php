<?
require_once "../TEST_3/mvc/controllers/BaseController.php";
class AuthenciationController extends BaseController {
    private $userModel;
    public function __construct()
    {
        $this->loadModel('UserModel');
        $this->userModel = new UserModel;
    }

    public function login() {
        $this->loadView('frontend.authenciation.login');
        if(isset($_POST['btnSubmit'])) 
        { 
            $username = $_POST['username'];
            $password = $_POST['password']; 
            // lưu dữ liệu khi error
            $sessionLogin = [
                "username" => $username,
                "password" => $password
            ];
            $_SESSION["session_login"] = $sessionLogin;
            // kiểm tra
            $data = $this->userModel->login($username, $password);
            if($data->isSuccess)
            { 
                // thiết lập session
                $sessionUserInfo = [
                    "id" => $data->data["id"],
                    "username" =>  $data->data["username"],
                    "role_id" => $data->data["role_id"]
                ];
                $_SESSION["user"] = $sessionUserInfo;
                // thiết lập cookie
                $cookie_user_id = $data->data["id"];
                setcookie("user_id", $cookie_user_id, time() + (86400 * 30), "/");

                // redirect
                header("Location: http://localhost/Project/TEST_3/User/order"); 
                exit; 
            } 
            else {
                $_SESSION["error_login"] = $data->message;
                header("Location: login"); 
                exit;
            }
        }
    }

    public function logout() {
        if (isset($_COOKIE['user_id'])) {
            unset($_COOKIE['user_id']); 
            setcookie('user_id', '', -1, '/'); 
        }
        if(isset($_SESSION["user"])) {
            unset($_SESSION["user"]);
        }
        header("Location: login"); 
    }

    public function register() {
        if(isset($_POST['btnSubmit'])) 
        { 
            $username = $_POST['username'];
            $password = $_POST['password']; 
            $fullname = $_POST['fullname'];  
            $company_id = $_POST['company_id']; 
            // lưu dữ liệu khi error
            $sessionRegister = [
                "username" => $username,
                "password" => $password,
                "fullname" => $fullname,
                "company_id" => $company_id
            ];
            $_SESSION["session_register"] = $sessionRegister;
            // Kiểm tra rỗng
            if(empty($username) || empty($password) || empty($fullname) || empty($company_id)) {
                $_SESSION["error_register"] = "Hãy điền đầy đủ thông tin";
            }
            else {
                // Sử dụng hàm registerUser từ class User để đăng ký người dùng mới
                $checkRegister =  $this->userModel->registerUser($username, $password, $fullname, $company_id);
                
                    // Kiểm tra kết quả đăng ký
                    if ($checkRegister->isSuccess) {
                        header("Location: login");
                        unset($_SESSION["error_register"]);
                        exit;
                    } else {
                        $_SESSION["error_register"] = $checkRegister->message;
                    }
                }
            }
            $this->loadView('frontend.authenciation.register');
        }
        
    public function checkLogin() {
        if(isset($_SESSION["user"])) {
            return true;
        }
        else {
            if(!isset($_COOKIE["user_id"])) {
                return false;
            }
            else {
                echo $_COOKIE["user_id"];
                $data = $this->userModel->getUser([
                    'where' => "id = '{$_COOKIE["user_id"]}'"
                ]);
                if($data->isSuccess)
                { 
                    // thiết lập session
                    $sessionUserInfo = [
                        "id" => $data->data[0]["id"],
                        "username" =>  $data->data[0]["username"],
                        "role_id" => $data->data[0]["role_id"]
                    ];
                    $_SESSION["user"] = $sessionUserInfo;
                    return true;
                }
                else {
                    return false;
                }
            }
        }
    }

}