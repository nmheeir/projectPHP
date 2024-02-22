<?
require_once "../TEST_3/mvc/controllers/BaseController.php";
require_once '../TEST_3/mvc/inc/send_mail.php';

class AuthenciationController extends BaseController
{
    private $userModel;
    public function __construct()
    {
        $this->loadModel('UserModel');
        $this->userModel = new UserModel;
    }

    public function login()
    {
        $this->loadView('frontend.authenciation.login');
        if (isset($_POST['btnSubmit'])) {
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
            if ($data->isSuccess) {
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
            } else {
                $_SESSION["error_login"] = $data->message;
                header("Location: login");
                exit;
            }
        }
    }

    public function logout()
    {
        if (isset($_COOKIE['user_id'])) {
            unset($_COOKIE['user_id']);
            setcookie('user_id', '', -1, '/');
        }
        if (isset($_SESSION["user"])) {
            unset($_SESSION["user"]);
        }
        header("Location: login");
    }

    public function register()
    {
        if (isset($_POST['btnSubmit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $fullname = $_POST['fullname'];
            $company_id = $_POST['company_id'];
            // lưu dữ liệu khi error
            $sessionRegister = [
                "username" => $username,
                "password" => $password,
                "email" => $email,
                "fullname" => $fullname,
                "company_id" => $company_id
            ];
            $_SESSION["session_register"] = $sessionRegister;
            // Kiểm tra rỗng
            if (empty($username) || empty($password) || empty($fullname) || empty($company_id) || empty($email)) {
                $_SESSION["error_register"] = "Hãy điền đầy đủ thông tin";
            } else {
                // Sử dụng hàm registerUser từ class User để đăng ký người dùng mới
                $checkRegister =  $this->userModel->checkUser($username, $email);

                // Kiểm tra kết quả đăng ký
                if ($checkRegister->isSuccess) {

                    $mail = $_SESSION['session_register']['email'];
                    
                    $verifyCode = rand(100000, 999999);

                    $subject = "Verify your email";
                    $message = 'Your verification code is: ' . $verifyCode;
                    
                    $sql = "INSERT INTO verify (code, expires, email) 
                            VALUES ({$verifyCode}, DATE_ADD(NOW(), INTERVAL 60 MINUTE), '{$mail}');";

                    $this->userModel->custom($sql);
                    
                    sendMail($mail, $subject, $message);

                    header("Location: verifyemail");
                    unset($_SESSION["error_register"]);
                    exit;
                } else {
                    $_SESSION["error_register"] = $checkRegister->message;
                }
            }
        }
        $this->loadView('frontend.authenciation.register');
    }

    public function verifyemail()
    {
        if (isset($_POST['btnVerify'])) {
            $verifyCode = $_POST['verifyCode'];
            
            //lấy code trong bảng verify dựa vào email
            $checkCode = $this->userModel->get('verify', [
                'select' => '*',
                'where' => "code = '{$verifyCode}' AND email = '{$_SESSION['session_register']['email']}'",
                'limit' => '1'
            ]);

            
            if (!empty($checkCode)) {
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $time = strtotime(date('Y-m-d H:i:s'));
                $expiresTime = strtotime($checkCode[0]['expires']);
                if ($verifyCode == $checkCode[0]['code'] && $time < $expiresTime) {
                    $username = $_SESSION['session_register']['username'];
                    $password = $_SESSION['session_register']['password'];
                    $email = $_SESSION['session_register']['email'];
                    $fullname = $_SESSION['session_register']['fullname'];
                    $company_id = $_SESSION['session_register']['company_id'];
                    $this->userModel->registerUser($username, $password, $fullname, $company_id, $email);
                    // unset($_SESSION['session_register']);
                    header("Location: login");
                }
                else if ($time > $expiresTime) {
                    echo "Mã quá hạn, vui lòng thử lại mã khác";
                }
            }
            else {
                echo "Sai mã xác thực, vui lòng nhập lại";
            }
        }
        $this->loadView('frontend.authenciation.verifyemail');
    }
    public function checkLogin()
    {
        if (isset($_SESSION["user"])) {
            return true;
        } else {
            if (!isset($_COOKIE["user_id"])) {
                return false;
            } else {
                echo $_COOKIE["user_id"];
                $data = $this->userModel->getUser([
                    'where' => "id = '{$_COOKIE["user_id"]}'"
                ]);
                if ($data->isSuccess) {
                    // thiết lập session
                    $sessionUserInfo = [
                        "id" => $data->data[0]["id"],
                        "username" =>  $data->data[0]["username"],
                        "role_id" => $data->data[0]["role_id"],
                        "company_id" => $data->data[0]["company_id"]
                    ];
                    $_SESSION["user"] = $sessionUserInfo;
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
}
