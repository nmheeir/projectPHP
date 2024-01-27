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
            $data = $this->userModel->checkLogin($username, $password);
            if($data->isSuccess)
            { 
                $_SESSION["user_id"] = $data->data["id"];
                $_SESSION["user_username"] = $data->data["username"];
                $_SESSION["user_role"] = $data->data["role_id"];
                $_SESSION['last_regeneration'] = time();
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

    }

}