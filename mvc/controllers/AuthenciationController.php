<?
require_once "../TEST_3/mvc/controllers/BaseController.php";
class AuthenciationController extends BaseController {
    private $userModel;
    private $companyModel;
    public function __construct()
    {
        $this->loadModel('UserModel');
        $this->loadModel("CompanyModel");
        $this->userModel = new UserModel;
        $this->companyModel = new CompanyModel;
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
            // kiểm tra login
            $data = $this->userModel->login($username, $password);
            if($data->isSuccess)
            { 
                // thiết lập session
                $sessionUserInfo = [
                    "id" => $data->data["id"],
                    "username" =>  $data->data["username"],
                    "role_id" => $data->data["role_id"],
                    "company_id" => $data->data["company_id"]
                ];
                $_SESSION["user"] = $sessionUserInfo;
                // thiết lập cookie
                $cookie_user_id = $data->data["id"];
                setcookie("user_id", $cookie_user_id, time() + (86400 * 30), "/");
                // redirect
                header("Location: http://localhost/Project/TEST_3/User/home"); 
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
                $checkCompanyExist = $this->companyModel->getCompanyInfo($company_id);
                if(!$checkCompanyExist->isSuccess) {
                    $_SESSION["error_register"] = $checkCompanyExist->message;
                }
                else {
                    $checkRegister =  $this->userModel->registerUser($username, $password, $fullname, $company_id);
                        // Kiểm tra kết quả đăng ký
                        if ($checkRegister->isSuccess) {
                            header("Location: login");
                            unset($_SESSION["error_register"]);
                            exit;
                        } else {
                            if(!$checkRegister->isSuccess) {
                                $_SESSION["error_register"] = $checkRegister->message;
                            }
                        }
                    }
                }
            }
            $this->loadView('frontend.authenciation.register');
        }


        public function registerCompany() {
            if(isset($_POST["btnSubmit"])) {
                $username = $_POST['username'];
                $password = $_POST['password']; 
                $fullname = $_POST['fullname'];  
                $company_name = $_POST['company_name']; 
                // lưu dữ liệu khi error
                $sessionRegister = [
                    "username" => $username,
                    "password" => $password,
                    "fullname" => $fullname,
                    "company_name" => $company_name
                ];
                $_SESSION["session_registerCompany"] = $sessionRegister;
                // Kiểm tra rỗng
                if(empty($username) || empty($password) || empty($fullname) || empty($company_name)) {
                    $_SESSION["error_registerCompany"] = "Hãy điền đầy đủ thông tin";
                }
                else {
                    // Sử dụng hàm registerUser từ class User để đăng ký người dùng mới
                    $checkUsernameExist =  $this->userModel->getUserByUsername($username);
                    if($checkUsernameExist->isSuccess) {
                        $_SESSION["error_registerCompany"] = $checkUsernameExist->message;
                    }
                    else {            
                        // Kiểm tra kết quả đăng ký công ty
                        $checkCompanyExist = $this->companyModel->registerCompany($company_name);
                        if ($checkCompanyExist->isSuccess) {
                            // đăng kí user mới là lấy id user mới cập nhật master id cho công ty mới tạo
                            $masterUserId = $this->userModel->registerUser($username, $password, $fullname, $checkCompanyExist->data, 1);
                            $this->companyModel->save("company", [
                                "id" => $checkCompanyExist->data,
                                "master_user_id" => $masterUserId->data
                            ]);
                            // dãn qua login
                            header("Location: login/{$masterUserId->message}");
                            unset($_SESSION["error_registerCompany"]);
                            exit;
                        } else {
                            $_SESSION["error_registerCompany"] = $checkCompanyExist->message;
                        }
                    }
                }
            }
            $this->loadView('frontend.authenciation.companyRegister');
        }
}